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
        $request->merge(['amount' => str_replace(['$',','], ['','.'], $request->amount)]);
        Transaction::create(
            array_merge($request->all(), ['type' => 'income'])
        );
        $balance = Bank::firstOrFail();
        $balance->amount = $balance->amount + $request->amount;
        $balance->save();
        return redirect()->back()->withSuccess('Income was successfully added!');
    }

    public function store_consumption(Request $request)
    {
        $request->merge(['amount' => str_replace(['$',','], ['','.'], $request->amount)]);
        Transaction::create(
            array_merge($request->all(), ['type' => 'consumption'])
        );
        $balance = Bank::firstOrFail();
        $balance->amount = $balance->amount - $request->amount;
        $balance->save();
        return redirect()->back()->withSuccess('Consumption was successfully added!');
    }

    /**
     * Get request and make new table view
     *
     * @param  Request  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function getCategoriesByMonth(Request $request)
    {

        $bank = new Bank();
        $data = [
            'view' => View::make('Admin.tables.accounting-general-table')
                ->with('categories', $bank->getCategoriesConsumByMonth($request->date))
                ->render()
        ];
        return response()->json($data);

    }

    /**
     * @return int|mixed
     */
    public function getConsumptionByMonth()
    {
      $consumptions = DB::table('transactions')
                          ->where('type', 'consumption')
                          ->sum('amount');
      return $consumptions;
    }
}
