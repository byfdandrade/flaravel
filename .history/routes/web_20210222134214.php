<?php

use Illuminate\Support\Facades\Route;


//Rotas do Admin
Route::prefix('admin')->namespace('Admin')->group(function () {

    /** Permissões x Perfis **/
    Route::get('permissions/{id}/profiles', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');


    /** Perfis x Permissões **/
    Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');


    /** Perfis **/
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /** Permissões **/
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');


    /** Detalhes do Plano **/
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show'); //View
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit'); //View
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');


    /** Planos **/
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::get('plans', 'PlanController@index')->name('plans.index');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');


    /** Rotas da Dashboard **/
    Route::get('/', 'PlanController@index')->name('admin.index');
});
