<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseModule extends Model
{
    protected $guarded = [];
    public function course(): HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
