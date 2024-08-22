<?php

use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserCatalogueController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Backend\AuthenticateMiddleware;
use App\Http\Middleware\Backend\LoginMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ADMIN ROUTES
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('admin');
Route::get('admin/login', [AuthController::class, 'index'])->name('auth.login')->middleware(LoginMiddleware::class); 
Route::post('login', [AuthController::class, 'login'])->name('auth.logged');

//USER
Route::group(['prefix' => 'user'], function(){
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('admin');
    Route::get('edit/{id}', [UserController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('user.edit')->middleware('admin');
    Route::post('update/{id}', [UserController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.update')->middleware('admin');
    Route::get('delete/{id}', [UserController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.delete')->middleware('admin');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.destroy')->middleware('admin');
});

//USER CATALOGUE
Route::group(['prefix' => 'user/catalogue'], function(){
    Route::get('index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index')->middleware('admin');
    Route::get('create', [UserCatalogueController::class, 'create'])->name('user.catalogue.create')->middleware('admin');
    Route::post('store', [UserCatalogueController::class, 'store'])->name('user.catalogue.store')->middleware('admin');
    Route::get('edit/{id}', [UserCatalogueController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.edit')->middleware('admin');
    Route::post('update/{id}', [UserCatalogueController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.update')->middleware('admin');
    Route::get('delete/{id}', [UserCatalogueController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.delete')->middleware('admin');
    Route::delete('destroy/{id}', [UserCatalogueController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.destroy')->middleware('admin');
});
//AJAX
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.getLocation')->middleware('admin');;
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware('admin');;
Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware('admin');;

// LOGIN LOGOUT ADMIN ROUTES
Route::group(['prefix' => 'user'], function(){
    Route::get('login', [AuthController::class, 'index'])->name('auth.login')->middleware(LoginMiddleware::class);    
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});


