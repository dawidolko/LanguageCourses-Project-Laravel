<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function showSettings()
    {
        return view('user.settings');
    }

    public function showProfile()
    {
        $user = Auth::user();
        $enrollments = Enrollment::where('user_id', $user->id)->with('lessons.course.teacher')->get();

        return view('user.profile', compact('user', 'enrollments'));
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
        ], [
            'name.required' => 'Imię i nazwisko jest wymagane.',
            'name.regex' => 'Imię i nazwisko może zawierać tylko litery i spacje.',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Imię i nazwisko zostało zaktualizowane.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ], [
            'new_password.min' => 'Hasło musi zawierać co najmniej 8 znaków.',
            'new_password.confirmed' => 'Potwierdzenie hasła nie zgadza się.',
            'new_password.regex' => 'Hasło musi zawierać co najmniej jedną wielką literę, jedną małą literę, jedną cyfrę i jeden znak specjalny.',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Obecne hasło jest nieprawidłowe']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Hasło zostało zmienione.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'avatar.required' => 'Musisz wybrać plik.',
            'avatar.image' => 'Plik musi być obrazem.',
            'avatar.mimes' => 'Dopuszczalne są tylko pliki w formatach: jpeg, png, jpg, gif, svg.',
            'avatar.max' => 'Maksymalny rozmiar pliku to 2048 kB.',
        ]);

        $user = Auth::user();
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = 'storage/' . $avatarPath;
        $user->save();

        return back()->with('success', 'Awatar został zaktualizowany.');
    }
}
