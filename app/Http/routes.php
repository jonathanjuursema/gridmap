<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);

    Route::post('start', ['as' => 'start', 'uses' => 'StartController@start']);

    Route::get('password/pick', ['as' => 'pickpassword', 'uses' => 'PasswordController@pick']);

    Route::post('password/save', ['as' => 'savepassword', 'uses' => 'PasswordController@save']);

    Route::get('survey', ['as' => 'startsurvey', 'uses' => 'SurveyController@start']);

    Route::post('survey/submit', ['as' => 'submitsurvey', 'uses' => 'SurveyController@submit']);

    Route::get('recall/{id}/{secret}', ['as' => 'recall', 'uses' => 'RecallController@start']);

    Route::get('recall', ['as' => 'recallpassword', 'uses' => 'RecallController@recall']);

    Route::post('recall', ['as' => 'recallpassword', 'uses' => 'RecallController@submit']);

    Route::get('survey/recall', ['as' => 'recallsurvey', 'uses' => 'SurveyController@startrecall']);

    Route::post('survey/recall', ['as' => 'submitrecallsurvey', 'uses' => 'SurveyController@submitrecall']);

});
