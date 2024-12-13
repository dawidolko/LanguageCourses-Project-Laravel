<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    const STATUSES = ['pending', 'approved', 'completed'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'status',
        'lesson_date',
        'user_id',
    ];

    /**
     * Get the user that owns the enrollment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The lessons that belong to the enrollment.
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'enrollment_lesson')
            ->using(EnrollmentLesson::class);
    }
}
