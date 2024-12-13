<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EnrollmentLesson extends Pivot
{
    protected $table = 'enrollment_lesson';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'enrollment_id',
        'lesson_id',
    ];
}
