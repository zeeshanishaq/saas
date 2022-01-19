<?php

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
    return view('auth.register');
});

Route::group(['middleware' => ['auth']], function (){

    Route::get('dashboard', 'App\Http\Controllers\Contact\ContactListController@get')->name('dashboard');
    Route::get('dashboard/edit/{id}', 'App\Http\Controllers\Contact\ContactListController@edit')->name('contact-edit');
    Route::patch('dashboard/update/{id}', 'App\Http\Controllers\Contact\ContactListController@update')->name('contact-update');
});


require __DIR__.'/auth.php';
