<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
      $bank = new BankController();
      $consumptions = $bank->getConsumptionByMonth();
      $budget = $bank->getBudgetByMonth();
      $bank = Bank::firstOrFail();
      $bank_amount = $bank->amount;
      return view('Admin.general.home', compact('consumptions', 'budget', 'bank_amount'));
  }

  // Show employee page
  public function employee()
  {
    return view('Admin.general.employee');
  }

  // Show accounting>general page
  public function accounting_general()
  {
    $categories = new BankController();
    $categories = $categories->getCategoriesConsumByMonth();
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
