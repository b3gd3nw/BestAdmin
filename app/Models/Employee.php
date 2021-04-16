<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'countryId',
        'birthdate',
        'phone',
        'email',
        'position',
        'salary',
        'status',

    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }

    public function employeeskill()
    {
        return $this->morphToMany(EmployeeSkill::class, 'taggable');
    }
}
