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

    /**
     * Checks if the skill exists, if not, adds it to the database
     *
     * @param  $skills
     * @return array
     */
    public function skillFilter($skills)
    {
        $skills_id = [];
        foreach (explode(',', $skills) as $skill) {
            if ($tmp = Skill::where('name', '=', $skill)->first()) {
                $skills_id [] = $tmp->id;
            } else {
                $skills_id [] = Skill::create(['name' => $skill])->id;
            }
        }
        return $skills_id;
    }

    public function editSkills($skills, $avalible)
    {
        $skills_id = [];
        foreach (explode(',', $skills) as $skill) {
            if ($tmp = Skill::where('name', '=', $skill)->first()) {
                $skills_id [] = $tmp->id;
            } else {
                $skills_id [] = Skill::create(['name' => $skill])->id;
            }
        }
        foreach ($avalible as $a_skill) {
            if ($skill != $a_skill['name'])
            {
                EmployeeSkill::where('id', '=', $a_skill['id'])->delete();
            }
        }
    }

    public function employeeskill()
    {
        return $this->morphToMany(EmployeeSkill::class, 'taggable');
    }
}