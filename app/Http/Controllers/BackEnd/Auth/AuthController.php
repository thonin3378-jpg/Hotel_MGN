<?php

namespace App\Http\Controllers\BackEnd\Auth;

use App\Http\Controllers\Controller;
use App\Models\MyUsers;
use App\Models\staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function login(){
        return view('BackEnd.Auth.login');
    }

    public function loginAction(Request $request){

        // 1. find user with staff relationship
        $user = MyUsers::whereHas('staff', function ($q) use ($request) {
            $q->where('name', $request->name);
        })->first();

        if (!$user) {
            return back()->with('error', 'User not found!');
        }

        // 2. check password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password is incorrect!');
        }

        // 3. login
        Auth::login($user);
        $request->session()->regenerate();

        // 4. role redirect
        switch ($user->role) {
            case 'Admin':
                return redirect()->route('dashboard.index');
            case 'Leader':
                return redirect()->route('dashboard.index');
            case 'Staff':
                return redirect()->route('home.index');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Unauthorized role.');
        }
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout(); // Log out the user
        //Auth::guard('web')->logout();

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login'); // Redirect to login or any other route
    }
    
}
