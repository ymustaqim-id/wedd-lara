<?php

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
    // return view('welcome');
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/coba', 'HomeController@coba')->name('coba');

Route::get('user/load-data','UserController@loadData');
Route::get('user/json','UserController@json');
Route::get('user/cek-username','UserController@checkUsername');
Route::get('user/cek-email','UserController@checkEmail');
Route::get('user/get-role','UserController@getRole');
Route::resource('user','UserController');
Route::delete('user/{id}/restore','UserController@restore');

Route::get('autocomplete/{method}','AutocompleteController@search');

Route::get('role/load-data','RoleController@loadData');
Route::resource('role','RoleController');
Route::delete('role/{id}/restore','RoleController@restore');

Route::get('menu/load-data','MenuController@loadData');
Route::resource('menu','MenuController');
Route::delete('menu/{id}/restore','MenuController@restore');

Route::get('permission/load-data','PermissionController@loadData');
Route::resource('permission','PermissionController');
Route::delete('permission/{id}/restore','PermissionController@restore');

Route::post('role/createpermissionrole', ['as' => 'role.createpermissionrole', 'uses' => 'RoleController@createpermissionrole']);
Route::get('role/load-data', 'RoleController@loadData');
Route::get('permission-role/get/{id}/menu', 'RoleController@hakmenus');
Route::get('role/permission-role/get/{id}/menu', 'RoleController@hakmenus');
Route::resource('role', 'RoleController');
Route::delete('role/{id}/restore', 'RoleController@restore');
