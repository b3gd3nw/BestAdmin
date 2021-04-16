<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    protected $fillable = [
        'employeeId',
        'skillId'
    ];

    public $timestamps = false;

    public function skills()
    {
        return $this->morphedByMany(Skill::class, 'taggable');
    }

    public function employes()
    {
        return $this->morphedByMany(Employee::class, 'taggable');
    }
}
