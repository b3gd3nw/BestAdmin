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
use Illuminate\Support\Arr;

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
        $employes = Employee::withTrashed()->sortable()->paginate(6);
        $consumptions = Transaction::whereMonth('created_at', Carbon::now()->month)->where('type', 'consumption')->sum('amount');
        $budget = Category::whereMonth('created_at', Carbon::now()->month)->sum('budget');

        $bank_amount = $bank->amount;

        return view('Admin.general.home', compact('consumptions', 'budget', 'bank_amount', 'employes', 'skills', 'employee_skills'));
    }

    /**
     * Receives employes from database and return view with them.
     * 
     * 
     * @param  Request  $request
     *
     * @return  \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employee(Request $request)
    {
        $skills = Skill::all();
        $employee_skills = EmployeeSkill::all();
        if ($request->status) {
            $employes = Employee::where('status', $request->status)->withTrashed()->sortable()->paginate(6);
        } else {
            $employes = Employee::withTrashed()->sortable()->paginate(3);
        }
        
        return view('Admin.general.employee', compact('employes', 'employee_skills', 'skills'));
    }

    /**
     * Receives consumptions, bank, transactions, categories from database and return view with them.
     *
     * @return  \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accounting_general(Request $request)
    {
        $bank = new Bank();
        $transaction = new Transaction();

        if ($request->by === "asc") {
            $consumptions = $bank->getCategoriesConsumByMonth($request->filterby)
                ->sortBy($request->sort, $flag = $request->sort != 'category_name' ? SORT_NUMERIC : SORT_STRING)
                ->paginate(6, null, 'consumptions');
            $transactions = $transaction->getTransactionsByMonth($request->filterby)
                ->sortBy($request->sort)
                ->paginate(6, null, 'transactions');
        } else {
            $consumptions = $bank->getCategoriesConsumByMonth($request->filterby)
                ->sortByDesc($request->sort, $flag = $request->sort != 'category_name' ? SORT_NUMERIC : SORT_STRING)
                ->paginate(6, null, 'consumptions');
            $transactions = $transaction->getTransactionsByMonth($request->filterby)
                ->sortByDesc($request->sort)
                ->paginate(6, null, 'transactions');
        }
        $categories = Category::all();
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
        $employes = Employee::orderBy($request->get('order'), $request->get('by'))->withTrashed()->paginate(3);

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