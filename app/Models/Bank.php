<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    /**
     * Return consumptions for a certain period
     *
     * @param  string  $date
     * @return array
     */
    public function getCategoriesConsumByMonth($date)
    {
        if ($date) {
           $dates = explode('-', $date);
           $transactions = Transaction::whereBetween('created_at', [Carbon::parse($dates[0]), Carbon::parse($dates[1])])->get();
        } else {
            $transactions = Transaction::whereMonth('created_at', Carbon::now()->month)->get();
        }
        $consumptions = [];
        $amount = 0;
        $categories = Category::all();
        foreach ($categories as $category)
        {
            $concrete_trans = $transactions->where('categoryId', '=', $category->id);

            foreach ($concrete_trans as $transaction)
            {
                if ($transaction->type == 'consumption') {
                    $amount = $amount + $transaction->amount;
                }
            }
            $consumptions [] = compact('category', 'amount');
        }

        return $consumptions;
    }


}
