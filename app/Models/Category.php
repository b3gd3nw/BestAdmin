<?php

namespace App\Models;

use App\Consumption;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'type',
        'budget',
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function expenses_by_category() {
        $categories = Category::all();
        $transactions = Transaction::all();
        $categories_stat = [];
        foreach ($categories as $category) {
            if ($category->type === 'consumption') {
                $spent = $transactions->where('type', '=', 'consumption')
                            ->where('categoryId', '=', $category->id)
                            ->sum('amount');
                $diff = round(($spent / $category->budget) * 100);
                $categories_stat [] = [
                    'category' => $category->name,
                    'budget' => $category->budget,
                    'consumption' => $spent,
                    'difference' => $diff,
                ];
            }
        }
        return $categories_stat;
    }
}
