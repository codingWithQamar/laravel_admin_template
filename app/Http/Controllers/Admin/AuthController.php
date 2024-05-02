<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Session;

class AuthController extends Controller
{
    public function login()
    {
        // echo "<pre>";print_r(session()->get('error'));echo "</pre>";exit;
        if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return redirect()->route('home');
            }
            return redirect()->route('admin.dashboard');
        }
        $viewData = [
            'pageName' => 'Login',
        ];
        return view('admin.auth.login')->with($viewData);
    }
    public function login_submit(Request $request)
    {
        $postData = $request->all();
        // echo "<pre>";print_r($postData);echo "</pre>";exit;

        if (!empty($postData)) {
            $email = $postData['email'];
            $password = $postData['password'];
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->regenerate();
                if (Auth()->user()->usertype == 'Admin') {
                    return redirect()->route('home');
                }
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid Credentials!');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials!');
        }
    }
    public function logout()
    {
        // Session::flush();
        Auth::logout();
        $viewData = [
            'pageName' => 'Login',
        ];
        return view('admin.auth.login')->with($viewData);
    }
}
