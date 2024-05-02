<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RetsController;
use App\Http\Controllers\UserAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect()->route('admin.login');
// });

Route::get('/logout', function () {
    // Session::flush();
    Auth::logout();
    return redirect()->route('home');
});
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login_submit', [AuthController::class, 'login_submit'])->name('admin.login.submit');


Route::get('/user/login', [UserAuthController::class, 'login'])->name('user.login');
// Route::get('/user/login',function (){
//     return ('Hello');
// });
Route::post('/user/login', [UserAuthController::class, 'login_process'])->name('user.login.submit');
Route::get('/user/register', [UserAuthController::class, 'register'])->name('register');
Route::post('/user/register', [UserAuthController::class, 'register_process'])->name('register.submit');



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/datatable', [DashboardController::class, 'datatable'])->name('admin.datatable');
    Route::get('/form', [DashboardController::class, 'form'])->name('admin.form');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home1');
Route::get('/home1', [HomeController::class, 'home1'])->name('mapSearch');
Route::get('/property/{Ml_num?}', [HomeController::class, 'property_detail'])->name('property.detail');




Route::get('/rets', [RetsController ::class, 'index']);
Route::get('/rets/get_properties', [RetsController::class, 'get_properties']);
Route::get('/rets/get_properties_values', [RetsController::class, 'properties_value']);
Route::get('/rets/get_property_images', [RetsController::class, 'property_images']);

Route::group(['namespace' => '', 'prefix' => '', 'middleware' => 'auth'], function() {
	Route::post('/save-watch-area', [LocationController::class, 'saveCoordinates'])->name('saveCoordinates');
	Route::get('/my-watch-area', [LocationController::class, 'watched_area_summary'])->name('myWatchArea');
});


Route::get('/user/watched/areas-summary/{id}', [LocationController::class, 'watched_area_summary_detail'])->name('watched_area_summary_detail');
