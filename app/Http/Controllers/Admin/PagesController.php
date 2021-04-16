<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Token;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Category;

class PagesController extends Controller
{

  public function main() {
      return view('Public.main');
  }

  public function register($token) {

      $today = Carbon::now()->toDateString();
      if ($token = Token::where('token', '=', $token)->first())
      {
          if ($token->created_at->diffInMinutes(Carbon::now()) > 1210)
          {
              return view('Public.error');
          }
          $countries = Country::all();
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

      $employes = Employee::orderBy('id')->withTrashed()->get();
      $consumptions = Transaction::whereMonth('created_at', Carbon::now()->month)->where('type', 'consumption')->sum('amount');
      $budget = Category::whereMonth('created_at', Carbon::now()->month)->sum('budget');

      $bank_amount = $bank->amount;

      return view('Admin.general.home', compact('consumptions', 'budget', 'bank_amount', 'employes'));
  }

  // Show employee page
  public function employee()
  {
      $employes = Employee::orderBy('id')->withTrashed()->get();
      return view('Admin.general.employee', compact('employes'));
  }

  // Show accounting>general page
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

  // Show accounting>categories page
  public function accounting_categories()
  {
    $categories = Category::orderBy('created_at', 'desc')->get();
    return view('Admin.accounting.categories', compact('categories'));
  }


}
