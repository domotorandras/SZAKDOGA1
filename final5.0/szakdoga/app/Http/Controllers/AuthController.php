<?php

namespace App\Http\Controllers;


use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Player;

class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }

    public function showLogin(){
        return view('login');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:players',
            'password' => 'required|string|min:8|confirmed'
        ], [
            'name.required'      => 'A név megadása kötelező.',
            'email.required'     => 'Az email megadása kötelező.',
            'email.email'        => 'Kérlek, érvényes email címet adj meg.',
            'email.unique'       => 'Ez az email cím már foglalt.',
            'password.required'  => 'A jelszó megadása kötelező.',
            'password.min'       => 'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'password.confirmed' => 'A jelszók nem egyeznek.'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = Player::create($validated);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string'
        ], [
            'email.required'     => 'Az email megadása kötelező.',
            'email.email'        => 'Kérlek, érvényes email címet adj meg.',
            'password.required'  => 'A jelszó megadása kötelező.',
        ]);


        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'adatok' => 'Helytelen adatok',
        ]);

    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
