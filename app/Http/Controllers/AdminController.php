<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function users() {
        $users = User::paginate(10);
        return view('admin.editUsers', compact('users'));
    }

    public function updateUser(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $id,
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        if ($request->has('admin')) {
            $user->role_id = 1; 
        } else {
            $user->role_id = 2;
        }
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Dane użytkownika zostały zaktualizowane.');
    }

    public function deleteUser($id) {
        try {
            User::destroy($id);
            return redirect()->route('admin.users')->with('success', 'Użytkownik został usunięty.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Nie udało się usunąć użytkownika.');
        }
    }

    public function courses() {
        $courses = Course::with('teacher')->paginate(10);
        $teachers = Teacher::all();
        return view('admin.editCourses', compact('courses', 'teachers'));
    }

    public function addCourse(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imageName = 'courses/' . time() . '.' . $request->image->extension();
        $request->file('image')->storeAs('img', $imageName, 'public');
        $validatedData['path'] = $imageName;
    
        Course::create($validatedData);
    
        return redirect()->route('admin.courses')->with('success', 'Kurs został dodany.');
    }       

    public function updateCourse(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $course = Course::findOrFail($id);
    
        if ($request->hasFile('image')) {
            $imageName = 'courses/' . time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('img', $imageName, 'public');
            $validatedData['path'] = $imageName;

            if ($course->path) {
                Storage::disk('public')->delete('img/' . $course->path);
            }
        } else {
            $validatedData['path'] = $course->path;
        }
    
        $course->update($validatedData);
    
        return redirect()->route('admin.courses')->with('success', 'Kurs został zaktualizowany.');
    }

    public function deleteCourse($id) {
        try {
            $course = Course::findOrFail($id);
            if ($course->path) {
                Storage::disk('public')->delete('img/' . $course->path);
            }
            $course->delete();
            return redirect()->route('admin.courses')->with('success', 'Kurs został usunięty.');
        } catch (\Exception $e) {
            return redirect()->route('admin.courses')->with('error', 'Nie udało się usunąć kursu.');
        }
    }

    public function addLesson(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        Lesson::create($validatedData);

        return redirect()->route('admin.courses')->with('success', 'Lekcja została dodana.');
    }

    public function addTeacher(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers,email',
            'phone' => 'required|string|max:15',
        ]);

        Teacher::create($validatedData);

        return redirect()->route('admin.courses')->with('success', 'Nauczyciel został dodany.');
    }

    public function enrollments() {
        $enrollments = Enrollment::with(['user', 'lessons.course'])->paginate(10);
        return view('admin.enrollments', compact('enrollments'));
    }

    public function editEnrollment($id) {
        $enrollment = Enrollment::with('user', 'lessons.course')->findOrFail($id);
        $statuses = Enrollment::STATUSES;
        return view('admin.editEnrollment', compact('enrollment', 'statuses'));
    }

    public function updateEnrollment(Request $request, $id) {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = $request->input('status');
        $enrollment->save();

        return redirect()->route('admin.enrollment')->with('success', 'Status zapisu został zaktualizowany.');
    }

    public function deleteEnrollment($id) {
        DB::beginTransaction();
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->lessons()->detach();
            $enrollment->delete();
            DB::commit();
            return redirect()->route('admin.enrollment')->with('success', 'Zapis został usunięty.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.enrollment')->with('error', 'Nie udało się usunąć zapisu.');
        }
    }
}
