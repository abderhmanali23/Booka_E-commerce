<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(Request $request){
        return view('auth.register');
    }
    public function store(Request $request){
        $request->validate([
            'username' => 'required|min:4|max:20|unique:Users,name',
            'email' => 'required|email|unique:Users,email',
            'password' => 'required|min:8',
            'confirm_pwd' => 'required_with:password|same:password'
        ],
        ['confirm_pwd.required_with' => "Password confirmation doesn't match password",
            'confirm_pwd.same' => "Password confirmation doesn't match password"]
        );

        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        if (Auth::id()){
            return redirect()->route('dashboard');
        }
        return redirect()->route('auth.login');
    }

        
    public function authenticate(Request $request){
        $info = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($info)){
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin'){
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors([
            'error' => 'email or password is not correct'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
        
    }
    
    public function outregister(Request $request){
        AuthController::logout($request);
        return redirect()->route('auth.register');
    }
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
};