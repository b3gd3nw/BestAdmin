<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Country;
use App\Models\EmployeeSkill;
use App\Models\Skill;
use App\Models\Token;
use App\Events\MyEvent;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table_data = [];
        $employes = Employee::where('status', 'pending')->get();
        foreach ($employes as $employee) {
            $skills = $employee->employeeskill;
            $table_data [] = [
                "user_id" => $employee->id,
                "user_name" => $employee->firstname . ' ' . $employee->lastname,
                "user_position" => $employee->position,
                "user_email" => $employee->email,
                // "user_skills" => $skills,
                "user_status" => $employee->status
            ];
        }

        return response()->json($table_data);
    }

    public function getEmployes()
    {
        $table_data = [];
        $employes = Employee::all();
        foreach ($employes as $employee) {
            $skills = $employee->employeeskill;
            $table_data [] = [
                "user_id" => $employee->id,
                "user_name" => $employee->firstname . ' ' . $employee->lastname,
                "user_birthdate" => $employee->birthdate,
                "user_country" => $employee->country->name,
                "user_phone" => $employee->phone,
                "user_salary" => $employee->salary,
                "user_position" => $employee->position,
                "user_email" => $employee->email,
                "user_skills" => $skills,
                "user_status" => $employee->status
            ];
        }

        return response()->json($table_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Employee::where('email', '=' , $request->get('email'))->first())
        {
            return response()->json(['exists' => true]);
        }
        $employee = new Employee();
        $request->request->add(['status' => 'pending']);
        $skill = new Skill();
        $skills = $skill->skillFilter($request->skills);

        $request->merge(['birthdate' => Carbon::create($request->birthdate)]);
        $request->merge(['salary' => str_replace(['$', '.', ','], ['','', '.'], $request->salary)]);
        $employeeId = $employee->fill($request->all());
        $employee->save();
        $employeeId = $employeeId->id;

        foreach ($skills as $skillId) {
            EmployeeSkill::create(compact('employeeId', 'skillId'));
        }

        if (isset($_COOKIE['token']))
        {
            $token = Token::where('token', '=', $_COOKIE['token'])->first();
            $token->delete();
            unset($_COOKIE['token']);
            setcookie('token', null, -1, '/');

            return redirect('/main')->withSuccess('Employee was successfully added!');
        } else {
            event(new MyEvent('New user ' . $request->firstname . ' ' . $request->lastname . ' was registered'));
            return response()->json(['exists' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        foreach (EmployeeSkill::where('employeeId', '=', $employee->id)->get() as $skill_id)
        {
            foreach (Skill::all() as $skill_name)
            {
                if ($skill_id['skillId'] === $skill_name['id'])
                {
                    $skills [] = $skill_name['name'];
                }
            }
        }
        $countries = Country::all();
        $data = [
            'view' => View::make('modals.editemployee')
                ->with('skills', $skills)
                ->with('employee', $employee)
                ->with('today', Carbon::now()->toDateString())
                ->with('countries', $countries)
                ->render()
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        if (DB::table('employees')->where('email', $request->email)->first() && $request->email != $employee->email) {
            return redirect()->back()->withError('Email already in use');
        } else {
            $skill = new Skill();
            $skills = $skill->skillFilter($request->skills);
            $employee_skills = EmployeeSkill::where('employeeId', '=', $employee->id)->get('skillId');
            $skills_id = [];
            foreach ($employee_skills as $skill) {
                $skills_id [] = $skill->skillId;
            }
            // Checking which skills need to be removed or add
            if ($to_remove = array_diff($skills_id, $skills))
            {
                foreach ($to_remove as $item) {
                    EmployeeSkill::where([
                        ['employeeId', '=', $employee->id],
                        ['skillId', '=', $item]
                    ])->delete();
                }
            }
            if ($to_add = array_diff($skills, $skills_id))
            {
                foreach ($to_add as $item) {
                    EmployeeSkill::create([
                        'employeeId' => $employee->id,
                        'skillId' => $item
                    ]);

                }
            }
            if ($employee->status === 'inactive')
            {
                if ($request->status === 'active' or $request->status === 'pending')
                {
                    $employee->restore();
                }
            }else
            {
                if ($request->status === 'inactive')
                {
                    $employee->delete();
                }
            }
            $request->merge(['status' => mb_strtolower($request->status)]);
            $request->merge(['salary' => str_replace(['$', '.', ','], ['', '', '.'], $request->salary)]);
            $data = $request->except('_method');
            $employee->update($data);

            return redirect()->back()->withSuccess('Employee edit successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::withTrashed()
            ->where('id', $id)
            ->firstOrFail();
        $employee->status = 'inactive';
        $employee->save();
        $employee->delete();
        return redirect()->back()->withSuccess('Delete Success!');
    }

    /**
     * Makes modal view and return them in json.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showSendForm()
    {
        $data = [
            'view' => View::make('modals.sendform')
                ->render()
        ];

        return response()->json($data);
    }

    /**
     * Gets status and make table view by parameter;
     *
     * @param  String  $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterBy($status)
    {
        $skills = Skill::all();
        $employee_skills = EmployeeSkill::all();
        $employes = DB::table('employees')->where('status', $status)->paginate(3);

        $data = [
            'view' => View::make('Admin.tables.filtered-table')
                ->with('employes', $employes)
                ->with('employee_skills', $employee_skills)
                ->with('skills', $skills)
                ->render()
        ];
        return response()->json($data);
    }

    /**
     * Checks email, generate token and sand mail into email
     *
     * @return mixed
     */
    public function sendMail(Request $request)
    {

        // Check email in db
        $email = DB::table('employees')->where('email', $request->email)->first();
        if ($email) {
            return response()
                ->json([
                    'email' => $request->email,
                    'exist' => true
                    ]);
        } else {
            // Generate token
            $token = sha1(uniqid($request->email, true));
            // Assemble url
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/register/?token=' . $token;
            // create an instance of our job    
            $job = (new SendMailJob($request->email, $url, $token))->onConnection('redis')->onQueue('email_sendler');
            dispatch($job); // add a job to the queue
            return response()
                ->json([
                    'email' => $request->email,
                    'exist' => false
                ]);
        }
    }

    public function uniqMail(Request $request)
    {
        if (Employee::where('email', '=' , $request->get('value'))->first())
        {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}