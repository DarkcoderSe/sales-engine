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

Route::prefix('lead')->middleware(['auth'])->name('lead.')->group(function() {
    Route::get('/', 'LeadController@index')->name('index');
    Route::get('create', 'LeadController@create')->name('create');
    Route::post('submit', 'LeadController@submit')->name('submit');
});

Route::get('test', function () {
    return view('bd.create');
});
Route::get('testnew', function () {
    return view('reports.report');
});
Route::get('testsearch', function () {
    return view('search.search');
});
Route::get('testsearchdata', function () {
    return view('searchdata.searchdata');
});

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
