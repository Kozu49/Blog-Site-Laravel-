<?php

use Illuminate\Support\Facades\Route;


Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{id}', 'PostController@show')->name('post');


Route::middleware('auth')->group(function(){
    
    Route::get('/admin', 'AdminsController@index')->name('admin.index');
 

    
    Route::get('/admin/posts/', 'PostController@index')->name('post.index');

    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    
    Route::post('/admin/posts/', 'PostController@store')->name('post.store');

    Route::delete('/admin/posts/{id}/destroy', 'PostController@destroy')->name('post.destroy');

    Route::get('/admin/posts/{id}/edit', 'PostController@edit')->name('post.edit');

    Route::put('/admin/posts/{id}/update', 'PostController@update')->name('post.update');



    Route::get('/admin/users/{id}/profile','UserController@show')->name('user.profile.show');

    Route::put('/admin/users/{id}/update','UserController@update')->name('user.profile.update');

    Route::get('/admin/users','UserController@index')->name('users.index');

    Route::delete('/admin/users/{id}/destroy', 'UserController@destroy')->name('user.destroy');

    Route::put ('/users/{id}/attach','UserController@attach')->name('user.role.attach');

    Route::put ('/users/{id}/detach','UserController@detach')->name('user.role.detach');

    

    Route::post('/roles','RoleController@store')->name('roles.store');

    Route::delete('/roles/{id}','RoleController@destroy')->name('roles.destroy');



    
    Route::get('/roles/{id}/edit','RoleController@edit')->name('roles.edit');
    
    Route::put('/roles/{id}/update','RoleController@update')->name('roles.update');

    Route::put ('/roles/{id}/attach','RoleController@attach')->name('role.permission.attach');

    Route::put ('/roles/{id}/detach','RoleController@detach')->name('role.permission.detach');

    
    Route::post('/permissions','PermissionController@store')->name('permissions.store');

    Route::delete('/permissions/{id}','PermissionController@destroy')->name('permissions.destroy');

    Route::get('/permissions/{id}/edit','PermissionController@edit')->name('permissions.edit');

    Route::put('/permissions/{id}/update','PermissionController@update')->name('permissions.update');






});

Route::middleware('role:Admin')->group(function(){

    Route::get('/admin/users','UserController@index')->name('users.index');
    Route::get('/roles','RoleController@index')->name('roles.index');
    Route::get('/permissions','PermissionController@index')->name('permissions.index');


    




});

