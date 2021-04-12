<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $countries = Country::all();
        $data = [
            'view' => View::make('modals.addemployee')
                ->with('countries', $countries)
                ->with('tomorrow', Carbon::now()->toDateString())
                ->render()
        ];

        return response()->json($data);
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
        $email = DB::table('employees')->where('email', $request->email)->first();
        $request->request->add(['status' => 'pending']);
        if ($email) {
            return response()->json(['exists' => true]);
        } else {
            $employee = Employee::create(
                $request->all()
            );
            setcookie('userid', $employee->id, 0, '/');
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
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->status = 'inactive';
        $employee->save();
        $employee->delete();
        return redirect()->back()->withSuccess('Delete Success!');
    }

    public function showSendForm()
    {

        $data = [
            'view' => View::make('modals.sendform')

                ->render()
        ];

        return response()->json($data);
    }

    public function filterBy($status)
    {
        $employes = DB::table('employees')->where('status', $status)->get();

        $data = [
            'view' => View::make('Admin.tables.filtered-table')
                ->with('employes', $employes)
                ->render()
        ];
        return response()->json($data);
    }
}
