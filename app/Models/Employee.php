<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'countryId',
        'birthdate',
        'phone',
        'email',
        'position',
        'salary',
        'skills',
        'status',

    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }
}
