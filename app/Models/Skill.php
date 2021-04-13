<?php

namespace App\Models;

use App\Http\Controllers\Admin\PagesController;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function skillFilter($skills)
    {
        $skills_id = [];
        foreach (explode(',', $skills) as $skill)
        {
            if ($tmp = Skill::where('name', '=',$skill)->first())
            {
                $skills_id [] = $tmp->id;
            } else {
                $skills_id [] = Skill::create(['name' => $skill])->id;
            }
        }
        return $skills_id;
    }

    public function employeeskill()
    {
        return $this->morphToMany(EmployeeSkill::class, 'taggable');
    }
}
