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

Route::get('login', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// homepage of dashboard
Route::get('/home', 'HomeController@index')->name('home');

// oauth
Route::get('/oauth', function () {
    return view('oauth');
})->name('oauth');

// github
Route::group(['prefix' => 'github'], function () {
    Route::get('', function () { return view('github.index'); })->name('github');
    Route::get('{username}', function () { return view('github.show'); });
    Route::get('{username}/repos', function () { return view('github.repos'); });
});

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => env('PASSPORT_CLIENT_ID'),
        'redirect_uri' => config('app.url') . '/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect(config('app.url') . '/oauth/authorize?'.$query);
})->name('authorize');

Route::get('/callback', function (\Illuminate\Http\Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post(config('app.url') . '/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'redirect_uri' => config('app.url').'/callback',
            'code' => $request->code,
        ],
    ]);

    $body = (string) $response->getBody();

    $obj = json_decode($body);

    // store un session to be used later by the front
    $request->session()->put('token', $obj->access_token);

    return redirect()->route('home');
});