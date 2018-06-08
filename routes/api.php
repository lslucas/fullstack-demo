<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    [
        'prefix' => 'github',
        'middleware' => 'auth:api'
    ], function () {

        Route::get('users', 'GithubController@index')->name('github.index');
        Route::get('users/{name}/detail', 'GithubController@show')->name('github.show');
        Route::get('users/{name}/repos', 'GithubController@repos')->name('github.repos');

});