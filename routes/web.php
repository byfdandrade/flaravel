<?php

use Illuminate\Support\Facades\Route;


//Rotas do Admin
Route::prefix('admin')->namespace('Admin')->group(function () {
    /**
     *
     * Rotas do Plano
     *
     */
   // Route::get('plans/create', 'PlanController@create')->name('plans.create');
    //Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    //Route::any('plans/search', 'PlanController@search')->name('plans.search');
    //Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::get('plans', 'PlanController@index')->name('plans.index');

    //Route::post('plans', 'PlanController@store')->name('plans.store');
    //Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    //Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');

    /**
     *
     * Rotas da Dashboard
     *
     */

    Route::get('/', 'PlanController@index')->name('admin.index');

});
