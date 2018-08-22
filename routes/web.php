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
    //return view('welcome');
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('demographics','HomeController@step_one_registration');
Route::post('store-demographics','HomeController@store_demographics');
Route::get('pneumonia-factors','HomeController@step_two_registration');
Route::post('store-factors','HomeController@store_pneumonia_factors');
Route::post('process_template','HomeController@process_template');
Route::get('show_factors','HomeController@show_records');

/*Prediction*/
Route::resource('predictions','PredictionController');

/*sample graph*/
Route::get('sample_graph','PredictionController@general_graph');
Route::get('multi_factor_graph','PredictionController@multi_factor_graph');

/* questionnaire */
Route::resource('data_collection','DataCollectionController');


