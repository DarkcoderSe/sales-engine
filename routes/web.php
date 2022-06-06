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
    return view('index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::prefix('lead')->middleware(['auth', 'role:agent'])->name('lead.')->group(function() {
    Route::get('/', 'LeadController@index')->name('index');
    Route::get('create', 'LeadController@create')->name('create');
    Route::post('submit', 'LeadController@submit')->name('submit');

});

Route::post('job-source/submit', 'IndexController@jobSourceSubmit')->name('job-source.submit');
Route::post('profile/submit', 'IndexController@profileSubmit')->name('profile.submit');
Route::post('technology/submit', 'IndexController@technologySubmit')->name('technology.submit');

Route::prefix('sales-engine')->middleware(['auth', 'role:bdm'])->name('sales-engine.')->group(function() {
    Route::get('create', 'SalesEngineController@create')->name('create');
    Route::get('search', 'SalesEngineController@search')->name('search');
    Route::get('edit/{id}', 'SalesEngineController@edit')->name('edit');
    Route::get('get-job-source', 'SalesEngineController@getJobSource')->name('get-job-source');
    Route::get('get-profile', 'SalesEngineController@getProfile')->name('get-profile');
    Route::get('get-technology', 'SalesEngineController@getTechnology')->name('get-technology');
    Route::post('report-search', 'SalesEngineController@searchReport')->name('report-search');
    Route::get('reports', 'SalesEngineController@report')->name('reports');

    // invitation email routes
    Route::get('send-invite/{id}', 'SalesEngineController@sendEmailInvite')->name('send.invite');
    Route::post('send-invite', 'SalesEngineController@submitEmailInvite')->name('submit.invite');

    Route::post('search', 'SalesEngineController@result')->name('result');
    Route::post('submit', 'SalesEngineController@submit')->name('submit');
    Route::post('update', 'SalesEngineController@update')->name('update');

});

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
