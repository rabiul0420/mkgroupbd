<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm() {
        return view('admin.admin_login');
    }

    public function adminLogin(Request $request) {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email, 
            'password' => $request->password, 
            'status' => 1,
            'login_permission' => true
        ];
        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();
            $user->last_login_time = now();
            $user->online_status = true;
            $user->save();
            if(Auth::user()->role === "admin") {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('admin.home'));
            }
        } else {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->with('message','Email or Password not matched!');
        }
    }
}
