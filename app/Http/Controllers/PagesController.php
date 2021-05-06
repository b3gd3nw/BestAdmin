<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Employee;
use App\Models\EmployeeSkill;
use App\Models\Skill;
use App\Models\Token;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    /**
     * Returns main page view.
     *
     * @return  \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main()
    {
        return view('Public.main');
    }

    /**
     * Check token and return error or register view.
     *
     * @param  String  $token
     * @return  \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        $today = Carbon::now()->toDateString();
        if ($token = Token::where('token', '=', $_GET['token'])->first()) {
            if ($token->created_at->diffInMinutes(Carbon::now()) > 15) {
                $token->delete();
                return view('Public.error');
            }
            $countries = Country::all();
            setcookie('token', $_GET['token'], 0, '/');
            return view('Public.register', compact('countries', 'today'));
        } else {
            return view('Public.error');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::firstOrFail();
        $skills = Skill::all();
        $employee_skills = EmployeeSkill::all();
        $employes = Employee::orderBy('id')->withTrashed()->get();
        $consumptions = Transaction::whereMonth('created_at', Carbon::now()->month)->where('type', 'consumption')->sum('amount');
        $budget = Category::whereMonth('created_at', Carbon::now()->month)->sum('budget');

        $bank_amount = $bank->amount;

        return view('Admin.general.home', compact('consumptions', 'budget', 'bank_amount', 'employes', 'skills', 'employee_skills'));
    }

    /**
     * Receives employes from database and return view with them.
     *
     * @return  \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employee()
    {
        $skills = Skill::all();
        $employee_skills = EmployeeSkill::all();
        $employes = Employee::orderBy('id')->withTrashed()->get();
        return view('Admin.general.employee', compact('employes', 'employee_skills', 'skills'));
    }

    /**
     * Receives consumptions, bank, transactions, categories from database and return view with them.
     *
     * @return  \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accounting_general()
    {
        $bank = new Bank();
        $consumptions = $bank->getCategoriesConsumByMonth(null);
        $categories = Category::all();
        $transactions = Transaction::orderBy('created_at')->get();
        $bank = Bank::firstOrFail();
        $bank_amount = $bank->amount;
        return view('Admin.accounting.general', compact('consumptions', 'bank_amount', 'transactions', 'categories'));
    }

    /**
     * Receives categories and return categories view.
     *
     * @return  \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accounting_categories()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('Admin.accounting.categories', compact('categories'));
    }

    public function orderBy(Request $request)
    {
        $skills = Skill::all();
        $employee_skills = EmployeeSkill::all();
        $employes = Employee::orderBy($request->get('order'), $request->get('by'))->withTrashed()->get();
        
        $data = [
            'view' => View::make('Admin.tables.sorted-' . $request->get('in'))
                ->with('employes', $employes)
                ->with('employee_skills', $employee_skills)
                ->with('skills', $skills)
                ->render()
        ];
        // dd($data);
        return response()->json($data);
    }
}