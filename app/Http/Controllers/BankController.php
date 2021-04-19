<?php

namespace App\Http\Controllers;

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
    /**
     * Returns the balance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAmount()
    {
        $bank = Bank::firstOrFail();
        return response()->json(compact($bank->amount));
    }

    /**
     * Returns json with a prepared view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Returns json with a prepared view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Store income to the database.
     *
     * @param  Request  $request
     * @return  mixed
     */
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

    /**
     * Store consumption to the database.
     *
     * @param  Request  $request
     * @return  mixed
     */
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
     * Get request and make new table view.
     *
     * @param  Request  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function getCategoriesByMonth(Request $request)
    {
        $bank = new Bank();
        $data = [
            'view' => View::make('Admin.tables.accounting-general-table')
                ->with('categories', $bank->getCategoriesConsumByMonth($request->birthdate))
                ->render()
        ];
        return response()->json($data);
    }

    /**
     * Returns costs for a month.
     *
     * @return  int|mixed
     */
    public function getConsumptionByMonth()
    {
        $consumptions = DB::table('transactions')
            ->where('type', 'consumption')
            ->sum('amount');
        return $consumptions;
    }
}