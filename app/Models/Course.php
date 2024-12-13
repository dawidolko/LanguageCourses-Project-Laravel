<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'language',
        'teacher_id',
        'path',
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
    
    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

}
