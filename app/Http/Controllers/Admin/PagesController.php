<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
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

  public function register() {
      return view('Public.register');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $bank = Bank::firstOrFail();

      $consumptions = Transaction::whereMonth('created_at', Carbon::now()->month)->where('type', 'consumption')->sum('amount');
      $budget = Category::whereMonth('created_at', Carbon::now()->month)->sum('budget');

      $bank_amount = $bank->amount;

      return view('Admin.general.home', compact('consumptions', 'budget', 'bank_amount'));
  }

  // Show employee page
  public function employee()
  {
      $employes = Employee::orderBy('created_at', 'desc')->withTrashed()->get();
      return view('Admin.general.employee', compact('employes'));
  }

  // Show accounting>general page
  public function accounting_general()
  {
    $categories = new Bank();
    $categories = $categories->getCategoriesConsumByMonth(null);
    $bank = Bank::firstOrFail();
    $bank_amount = $bank->amount;
    return view('Admin.accounting.general', compact('categories', 'bank_amount'));
  }

  // Show accounting>categories page
  public function accounting_categories()
  {
    $categories = Category::orderBy('created_at', 'desc')->get();
    return view('Admin.accounting.categories', compact('categories'));
  }


}
