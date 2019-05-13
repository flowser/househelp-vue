<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\PublicController;

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



Route::get('/B', function () {
    return view('layouts/backend');
});

Route::get('/B/{any?}', function () {
    return view('layouts/backend');
})->where('any', '^(?!api\/)[\/\w\.-]*');

Route::get('/', function () {
    return view('layouts/frontend');
});

Route::get('/{any?}', function () {
    return view('layouts/frontend');
})->where('any', '^(?!api\/)[\/\w\.-]*');



