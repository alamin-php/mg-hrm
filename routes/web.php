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
    return view('auth.login');
});

// Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/users', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('users.index');
// Route::delete('/users', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('users.index');

Route::group(['namespace'=>'App\Http\Controllers\Backend', 'middleware'=>'auth'], function(){
Route::group(['prefix'=>'user'], function(){
    Route::get('/', 'UserController@index')->name('user.index');
    Route::post('/store', 'UserController@store')->name('user.store');
    Route::get('/edit/{id}', 'UserController@edit');
    Route::post('/update', 'UserController@update')->name('user.update');
    Route::delete('/destroy/{id}', 'UserController@destroy')->name('user.destroy');
    Route::get('/role', 'UserController@role')->name('user.role');
    Route::get('/location', 'UserController@userLocation')->name('user.location');
  });
  Route::group(['prefix'=>'unit'], function(){
    Route::get('/', 'UnitController@index')->name('unit.index');
    Route::post('/store', 'UnitController@store')->name('unit.store');
    Route::get('/edit/{id}', 'UnitController@edit');
    Route::post('/update', 'UnitController@update')->name('unit.update');
    Route::delete('/destroy/{id}', 'UnitController@destroy')->name('unit.destroy');
  });
  Route::group(['prefix'=>'section'], function(){
    Route::get('/', 'SectionController@index')->name('section.index');
    Route::post('/store', 'SectionController@store')->name('section.store');
    Route::get('/edit/{id}', 'SectionController@edit');
    Route::post('/update', 'SectionController@update')->name('section.update');
    Route::delete('/destroy/{id}', 'SectionController@destroy')->name('section.destroy');
  });
  Route::group(['prefix'=>'desig'], function(){
    Route::get('/', 'DesignationController@index')->name('desig.index');
    Route::post('/store', 'DesignationController@store')->name('desig.store');
    Route::get('/edit/{id}', 'DesignationController@edit');
    Route::post('/update', 'DesignationController@update')->name('desig.update');
    Route::delete('/destroy/{id}', 'DesignationController@destroy')->name('desig.destroy');
  });
  Route::group(['prefix'=>'employee'], function(){
    Route::get('/', 'EmployeeController@index')->name('employee.index');
    Route::post('/store', 'EmployeeController@store')->name('employee.store');
    Route::get('/edit/{id}', 'EmployeeController@edit');
    Route::get('/status_update/{id}', 'EmployeeController@activeAndDeactive');
    Route::post('/update', 'EmployeeController@update')->name('employee.update');
    Route::delete('/destroy/{id}', 'EmployeeController@destroy')->name('employee.destroy');
  });
  Route::group(['prefix'=>'allotmant'], function(){
    Route::get('/', 'AllotmantController@index')->name('allotmant.index');
    Route::post('/store', 'AllotmantController@store')->name('allotmant.store');
    Route::get('/edit/{id}', 'AllotmantController@edit');
    Route::get('/status_update/{id}', 'AllotmantController@activeAndDeactive');
    Route::post('/update', 'AllotmantController@update')->name('allotmant.update');
    Route::delete('/destroy/{id}', 'AllotmantController@destroy')->name('allotmant.destroy');
  });
  Route::group(['prefix'=>'kpi'], function(){
    Route::get('/', 'KpiController@index')->name('kpi.index');
    Route::get('/create', 'KpiController@create')->name('kpi.create');
    Route::post('/store', 'KpiController@store')->name('kpi.store');
    Route::get('/edit/{id}', 'KpiController@edit');
    Route::get('/status_update/{id}', 'KpiController@activeAndDeactive');
    Route::post('/update', 'KpiController@update')->name('kpi.update');
    Route::delete('/destroy/{id}', 'KpiController@destroy')->name('kpi.destroy');
  });
  Route::group(['prefix'=>'attendance'], function(){
    Route::get('/', 'AttendanceController@index')->name('attendance.index');
    Route::get('/import', 'AttendanceController@attImport')->name('attn.import');
    Route::get('/jobcard', 'AttendanceController@searchJobcard')->name('attn.jobcard');
    Route::post('/jobcard', 'AttendanceController@getJobcard')->name('search.jobcard');
    Route::post('/excel', 'AttendanceController@importExcel')->name('excel.import');
    Route::get('/today-present', 'AttendanceController@todayPresent')->name('attendance.today');
    // Route::post('/store', 'AttendanceController@store')->name('attendance.store');
    // Route::get('/edit/{id}', 'AttendanceController@edit');
    // Route::get('/status_update/{id}', 'AttendanceController@activeAndDeactive');
    // Route::post('/update', 'AttendanceController@update')->name('attendance.update');
    // Route::delete('/destroy/{id}', 'AttendanceController@destroy')->name('attendance.destroy');
  });
});
