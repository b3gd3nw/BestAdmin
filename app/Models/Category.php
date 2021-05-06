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
}
