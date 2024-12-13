<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        $courses = $query->paginate(10);

        $languages = Course::select('language')->distinct()->get();

        return view('courses.index', compact('courses', 'languages'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        $lessons = $course->lessons;
        $teacher = $course->teacher; 
        return view('courses.show', compact('course', 'lessons', 'teacher'));
    }
}
