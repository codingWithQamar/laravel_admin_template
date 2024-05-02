<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
// use Session;

class AuthController extends Controller {
	
	public function register(Request $request){
		// echo "<pre>";print_r($postData);echo "</pre>";exit;
		$email = $request->email;
		$password = $request->password;
		$user = new User();
		$user->name = 'Administrator';
		$user->email = $email;
		$user->password =Hash::make($password);
		$user->save();
			
	}
	
	public function login(Request $request){
		// echo "<pre>";print_r($postData);echo "</pre>";exit;
		$email = $request->email;
		$password = $request->password;
		if (Auth::attempt(['email' => $email, 'password' => $password])) {
			$user = Auth::user();
			$token = $user->createToken('auth_token')->plainTextToken;
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
