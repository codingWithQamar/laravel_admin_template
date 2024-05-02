<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class DashboardController extends Controller {
	
    public function index(){
        $viewData = array(
            'pageName' => 'PageTitle',
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => route('admin.dashbobard')
                ),
                (object)array(
                    'name' => 'PageName',
                    'class' => 'active',
                    'url' => 'javascript:;'
                )
            )
        );
        return view('admin.PageName')->with($viewData);
    }
    public function dashboard(Request $request){
		$user = $request->user();
		// print_r($user);exit;
        $viewData = array(
            'pageName' => 'Dashboard',
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => 'javascript:;'
                )
            ),
			'userData' => $user
        );
        return view('admin.dashboard')->with($viewData);
    }
    public function datatable(Request $request){
		$user = $request->user();
        $viewData = array(
            'pageName' => 'Datatable',
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => route('admin.dashboard')
                ),
                (object)array(
                    'name' => 'Datatable',
                    'class' => 'active',
                    'url' => 'javascript:;'
                )
            ),
			'userData' => $user
        );
        return view('admin.datatable')->with($viewData);
    }
    public function form(Request $request){
		$user = $request->user();
        $viewData = array(
            'pageName' => 'Form',
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => route('admin.dashboard')
                ),
                (object)array(
                    'name' => 'Form',
                    'class' => 'active',
                    'url' => 'javascript:;'
                )
            ),
			'userData' => $user
        );
        return view('admin.form')->with($viewData);
    }
}
