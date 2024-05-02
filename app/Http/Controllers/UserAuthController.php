<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        echo '';
        exit();
    }
    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        $viewData = [
            'pageName' => 'Login',
        ];
        return view('user.Auth.login')->with($viewData);
    }
    public function login_process(Request $request)
    {
        $postData = $request->all();
        // echo "<pre>";print_r($postData);echo "</pre>";exit;
        if (!empty($postData)) {
            $username = $postData['username'];
            $password = $postData['password'];
            if (Auth::attempt(['email' => $username, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect()->route('home');
            } else {
                return redirect()->back()->with('error', 'Invalid Credentials!');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials!');
        }
    }

    public function register()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        $viewData = [
            'pageName' => 'Register',
        ];
        // dd($viewData);
        return view('user.Auth.register')->with($viewData);
    }
    public function register_process(Request $request)
    {
        $postData = $request->all();
        // echo "<pre>";print_r($postData);echo "</pre>";exit;
        if (!empty($postData)) {
            $ifExists = User::where('email', $postData['username'])->count();
            if ($ifExists == 0) {
                $insert_array = [
                    'first_name' => $postData['first_name'],
                    'last_name' => $postData['last_name'],
                    'name' => $postData['first_name'] . ' ' . $postData['last_name'],
                    // 'phone_no' => $postData['phone_no'],
                    'email' => $postData['username'],
                    'password' => bcrypt($postData['password']),
                    'usertype' => 'User',
                ];
                if (User::insert($insert_array)) {
                    if (Auth::attempt(['email' => $postData['username'], 'password' => $postData['password']])) {
                        $request->session()->regenerate();
                        return redirect()->route('home')->with('success', 'Registered successfully!');
                    } else {
                        return redirect()->back()->with('error', 'Invalid Credentials!');
                    }
                    // return redirect()->route('userlogin')->with('success','Registered successfully! \n Please login to view your dashboard.');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong!');
                }
            } else {
                return redirect()->back()->with('error', 'Email already in use.');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
    public function logout()
    {
        // Session::flush();
        Auth::logout();
        $viewData = [
            'pageName' => 'Login',
        ];
        return view('user.Auth.login')->with($viewData);
    }
}
