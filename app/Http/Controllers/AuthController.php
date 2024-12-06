<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);
            return redirect()->intended('/' . $user->roles->first()->url_name . '/dashboard'); // İlk role göre yönlendirme

        }


        return back()->withErrors(['email' => 'Email ya da şifre hatalı.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
