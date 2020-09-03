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
    // return redirect() //view('welcome'); && Auth::user()->profile == 1
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

// Route::get('/auth-login/with-phone', function(){ return 'hello phone'; })->name('auth.phone');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('profile');

// personal profile
Route::group(['prefix' => 'profile'], function () {
    Route::get('view', 'HomeController@profileView')->name('profile.view')->middleware('profile');
    Route::get('edit', 'HomeController@profileEdit')->name('profile.edit');
    Route::post('edit', 'HomeController@profileDoEdit')->name('profile.doedit');
});

Route::post('getProfile', 'HomeController@getProfile')->name('get.profile')->middleware('profile');

// general view staff
Route::group([
        'prefix' => 'staffs',
        'middleware' => 'profile'
    ], function () {
    Route::get('view', 'HomeController@staffView')->name('staffs.view');

    // restricted to super admins
    Route::group(['middleware' => 'superadmin'], function () {
        // Route::get('edit', 'HomeController@staffEdit')->name('staffs.edit');
        Route::get('add', 'HomeController@staffAdd')->name('staffs.add');
        Route::post('add', 'HomeController@staffCreate')->name('staffs.add');
    });

});


Route::group(['middleware' => ['superadmin', 'profile']], function () {

    // admin management
    Route::group(['prefix' => 'admin'], function () {
            Route::get('add', 'HomeController@adminAdd')->name('admin.add');
        Route::post('add', 'HomeController@adminCreate')->name('admin.store');
        Route::get('manage', 'HomeController@adminManage')->name('admin.manage');
        Route::post('remove', 'HomeController@adminRemove')->name('admin.remove');
    });

    // profile
    Route::post('deleteProfile', 'HomeController@deleteProfile')->name('del.profile');
    Route::post('updateProfile', 'HomeController@updateProfile')->name('up.profile');

    Route::get('sub-desig', 'HomeController@subDesig')->name('subdesig');

    Route::post('sub-desig', 'HomeController@saveSubDesig')->name('subdesig');

    Route::post('edit-sub-desig', 'HomeController@editSubDesig')->name('editsubdesig');

});

// This section is for admins and super admins
Route::group(['prefix' => 'announcements', 'middleware' => ['admins', 'profile']], function () {
    Route::get('create', 'AnnouncementController@create')->name('ann.create');
    Route::post('create', 'AnnouncementController@store')->name('ann.store');
    Route::get('manage', 'AnnouncementController@index')->name('ann.manage');
    Route::post('delete', 'AnnouncementController@destroy')->name('ann.del');
    
    // policies
    Route::get('/policies', 'HomeController@policy')->name('pol.view');
    Route::post('/policies/add', 'HomeController@policyAdd')->name('pol.add');
    Route::post('/policies/delete', 'HomeController@policyDel')->name('pol.del');
});



// filemanager
Route::group(['middleware' => 'profile'], function () {
    Route::get('/filemanagement', 'FilemanagerController@index')->name('fmi');
    
    Route::post('/createfolder', 'FilemanagerController@createFolder')->name('folder.create');
    
    Route::post('/createfile', 'FilemanagerController@createFile')->name('file.create');
    
    Route::post('/gobackfolder', 'FilemanagerController@gobackfolder')->name('folder.goback');
    
    Route::post('/filedownload', 'FilemanagerController@download')->name('file.download');
    
    Route::post('/filedelete', 'FilemanagerController@delete')->name('file.delete');
    
    Route::post('/folderdelete', 'FilemanagerController@folderDelete')->name('folder.delete');
    
    Route::get('/myfolder/{slug}', 'FilemanagerController@getFolder')->name('folder.get');
});


Route::get('/birthday', function (){
    return view('pages.birthday');
})->name('bday');