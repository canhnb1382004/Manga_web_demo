<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
           
            Auth::login($user);
            return redirect()->route('admin'); 
        }

        return redirect()->route('login')->withErrors([
            'login_error' => 'Email hoặc mật khẩu không đúng.',
        ]);
    }

   
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
