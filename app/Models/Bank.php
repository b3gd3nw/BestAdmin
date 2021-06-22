<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    /**
     * Return consumptions for a certain period
     *
     * @param  string  $range
     * @return array
     */
    public function getCategoriesConsumByMonth($range = NULL)
    {
        if ($range) {
            $dates = explode('-', $range);
            if (array_key_exists(1, $dates)) {
                $transactions = Transaction::whereBetween('created_at', [Carbon::parse($dates[0]), Carbon::parse($dates[1])])->get();
            } else {
                $transactions = Transaction::whereDate('created_at', '=', Carbon::parse($dates[0]))->get();
            }
        } else {
            $transactions = Transaction::whereMonth('created_at', Carbon::now()->month)->get();
        }
        $consumptions = [];
        $amount = 0;
        $id = 0;
        $categories = Category::all();
        foreach ($categories as $category) {
            $concrete_trans = $transactions->where('categoryId', '=', $category->id);

            foreach ($concrete_trans as $transaction) {
                if ($transaction->type == 'consumption') {
                    $amount = $amount + $transaction->amount;
                }
            }
            $id++;
            $category_name = $category->name;
            $consumptions [] = compact('category', 'amount', 'id', 'category_name');
            $amount = 0;
        }
        return collect($consumptions);
    }
}