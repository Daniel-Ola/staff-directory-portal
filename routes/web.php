<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    // return redirect() //view('welcome');
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

Route::get('/auth-login/with-phone', function(){ return 'hello phone'; })->name('auth.phone');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'profile'], function () {
    Route::get('view', 'HomeController@profileView')->name('profile.view');
    Route::get('edit', 'HomeController@profileEdit')->name('profile.edit');
    Route::post('edit', 'HomeController@profileDoEdit')->name('profile.doedit');
});
Route::group(['prefix' => 'staffs'], function () {
    Route::get('view', 'HomeController@staffView')->name('staffs.view');
    Route::get('edit', 'HomeController@staffEdit')->name('staffs.edit');
});

Route::post('getProfile', 'HomeController@getProfile')->name('get.profile');

Route::post('updateProfile', 'HomeController@updateProfile')->name('up.profile');

Route::post('deleteProfile', 'HomeController@deleteProfile')->name('del.profile');

Route::get('pdf', 'HomeController@pdfhtml')->name('pdf.html');