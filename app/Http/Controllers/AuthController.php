<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            logger('Użytkownik jest już zalogowany.');
            return redirect()->route('home'); 
        }
        return view('auth.login');
    }

    public function authenticate(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ]);

        $remember = $request->has('remember'); 

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        } else {
            return back()->withErrors(['email' => 'Nieprawidłowe dane logowania.'])->onlyInput('email');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
        ], [
            'name.required' => 'Imię i nazwisko jest wymagane.',
            'email.required' => 'Adres email jest wymagany.',
            'email.email' => 'Proszę podać prawidłowy adres email.',
            'email.unique' => 'Podany adres email jest już używany.',
            'password.required' => 'Hasło jest wymagane.',
            'password.confirmed' => 'Hasła nie są identyczne.',
            'password.min' => 'Hasło musi zawierać co najmniej 8 znaków.',
            'password.regex' => 'Hasło musi zawierać małe i duże litery, cyfry oraz znak specjalny.',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 2 // Przypisuje nowym użytkownikom rolę klienta, ponieważ rola nr.1 to admin.
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }
}
