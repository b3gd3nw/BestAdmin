<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BankController extends Controller
{
    public function getAmount()
    {
        $bank = Bank::firstOrFail();
        return response()->json(compact($bank->amount));
    }

    public function getIncomePage()
    {
        $categories = Category::all();
        $data = [
            'view' => View::make('modals.addincome')
                ->with('categories', $categories)
                ->render()
        ];

        return response()->json($data);
    }

    public function getConsumptionPage()
    {
        $categories = Category::all();
        $data = [
            'view' => View::make('modals.addconsumption')
                ->with('categories', $categories)
                ->render()
        ];

        return response()->json($data);
    }

    public function store_income(Request $request)
    {
        Transaction::create(
            array_merge($request->all(), ['type' => 'income'])
        );
        $balance = Bank::firstOrFail();
        $balance->amount = $balance->amount + $request->amount;
        $balance->save();
        return redirect()->back()->withSuccess('Member was successfully updated');
    }

    public function store_consumption(Request $request)
    {
        Transaction::create(
            array_merge($request->all(), ['type' => 'consumption'])
        );
        $balance = Bank::firstOrFail();
        $balance->amount = $balance->amount - $request->amount;
        $balance->save();
        return redirect()->back()->withSuccess('Member was successfully updated');
    }

    public function getCategoriesByMonth(Request $request)
    {
        $test = new Bank();
        $data = [
            'view' => View::make('Admin.tables.accounting-general-table')
                ->with('categories', $test->getCategoriesConsumByMonth($request->date))
                ->render()
        ];
        return response()->json($data);

    }
//    public function getCategoriesConsumByMonth(Request $request)
//    {
//        if ($request) {
//            dd($request);
//        }
//        $consumptions = [];
//        $amount = 0;
//        $transactions = Transaction::whereBetween('created_at', Carbon::now()->month)->get();
//        $categories = Category::all();
//        foreach ($categories as $category)
//        {
//            $concrete_trans = $transactions->where('categoryId', '=', $category->id);
//
//            foreach ($concrete_trans as $transaction)
//            {
//                if ($transaction->type == 'consumption') {
//                    $amount = $amount + $transaction->amount;
//                }
//            }
//            $consumptions [] = compact('category', 'amount');
//        }
//
//        return $consumptions;
//    }

    public function getConsumptionByMonth()
    {
      $consumptions = DB::table('transactions')
                          ->where('type', 'consumption')
                          ->sum('amount');
      return $consumptions;
    }

    public function getBudgetByMonth()
    {
      $budget = DB::table('categories')
                          ->sum('budget');
      return $budget;
    }
}
