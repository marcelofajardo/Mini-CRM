<?php

use Illuminate\Support\Facades\App;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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


Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
  ]
);

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('companies/{company}/employees-json', [CompaniesController::class, 'employeesJson'])->name('employees-json');
Route::resource('companies', CompaniesController::class);
Route::resource('employees', EmployeesController::class);


Route::get('/locale', function () {
  return Session::get('locale');
});

Route::post('/{locale}', function($locale) {
    Session::put('locale', $locale);
    return back();
})->name('setLocale');

