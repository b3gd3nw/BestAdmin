<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Employee extends Model
{
    use SoftDeletes, Sortable;

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

    public $sortable = [
        'id',
        'firstname',
        'position',
        'email',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }

    public function employeeskill()
    {
        return $this->belongsToMany(Skill::class, 'employee_skills', 'skillId', 'employeeId');
    }
}
