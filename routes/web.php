<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
+
Auth::routes([
    'register' => false
  ]
);

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('companies/{company}/employees-json', [CompaniesController::class, 'employeesJson'])->name('employees-json');

Route::resource('companies', CompaniesController::class);
Route::resource('employees', EmployeesController::class);

