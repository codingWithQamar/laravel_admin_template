<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth()->user()->usertype != 'Admin') {
                return back();
            }
        }
        $viewData = [
            'pageName' => 'PageTitle',
            'breadCrumbs' => [
                (object) [
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => route('admin.dashbobard'),
                ],
                (object) [
                    'name' => 'PageName',
                    'class' => 'active',
                    'url' => 'javascript:;',
                ],
            ],
        ];
        return view('admin.PageName')->with($viewData);
    }
    public function dashboard(Request $request)
    {
        if (Auth::check()) {
            if (Auth()->user()->usertype != 'Admin') {
                return redirect()->route('home');
            }
        }
        $user = $request->user();
        // print_r($user);exit;
        $viewData = [
            'pageName' => 'Dashboard',
            'breadCrumbs' => [
                (object) [
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => 'javascript:;',
                ],
            ],
            'userData' => $user,
        ];
        return view('admin.dashboard')->with($viewData);
    }
    public function datatable(Request $request)
    {
        if (Auth::check()) {
            if (Auth()->user()->usertype != 'Admin') {
                return redirect()->route('home');
            }
        }
        $user = $request->user();
        $viewData = [
            'pageName' => 'Datatable',
            'breadCrumbs' => [
                (object) [
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => route('admin.dashboard'),
                ],
                (object) [
                    'name' => 'Datatable',
                    'class' => 'active',
                    'url' => 'javascript:;',
                ],
            ],
            'userData' => $user,
        ];
        return view('admin.datatable')->with($viewData);
    }
    public function form(Request $request)
    {
        if (Auth::check()) {
            if (Auth()->user()->usertype != 'Admin') {
                return redirect()->route('home');
            }
        }
        $user = $request->user();
        $viewData = [
            'pageName' => 'Form',
            'breadCrumbs' => [
                (object) [
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => route('admin.dashboard'),
                ],
                (object) [
                    'name' => 'Form',
                    'class' => 'active',
                    'url' => 'javascript:;',
                ],
            ],
            'userData' => $user,
        ];
        return view('admin.form')->with($viewData);
    }

    public function register(Request $request)
    {
        // return $_POST;exit;
        $email = $request->email;
        $password = $request->password;
        $user = new User();
        $user->name = 'Administrator';
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->usertype = 'Admin';
        $user->save();
    }
    public function login(Request $request)
    {
        // return $_POST;exit;

        $in = $request->email;
        $password = $request->password;

        // return $validator->errors();
        // exit;

        // $user = Auth::user();

        if (Auth::attempt(['email' => $in, 'password' => $password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            // $email = $request->email;

            $response = [
                'success' => true,
                'token' => $token,
                'user' => $user,
                'message' => 'user login successfully',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Sorry, we cannot find an account with those credentials. Please check your credentials and try again',
            ];
            return response()->json($response, 400);
        }
    }
}
