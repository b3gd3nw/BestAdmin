<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Transaction extends Model
{
    use Sortable;

    protected $fillable = [
        'categoryId',
        'amount',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function getTransactionsByMonth($range) {
       $trans = [];
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
        foreach ($transactions as $transaction) {
            $trans [] = [
                'id' => $transaction->id,
                'type' => $transaction->type,
                't_amount' => $transaction->amount,
                't_category' => $transaction->category->name,
                'date' => $transaction->created_at->toDateTimeString()
            ];
        }
        // dd($transactions);
        return collect($trans);
    }
}
