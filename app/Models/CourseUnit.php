<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseUnit extends Model
{
    protected $guarded = [];
    public function course(): HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function module(): HasOne
    {
        return $this->hasOne(CourseModule::class, 'id', 'module_id');
    }
}
