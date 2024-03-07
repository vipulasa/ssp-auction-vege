<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Administration routes
 */
Route::group(['prefix' => 'admin'], function () {

    Route::get('/', function (Request $request) {
        return 'Yo Admin.';
    });

});

/**
 * Vendor routes
 */
Route::group(['prefix' => 'vendor'], function () {

    Route::get('/', function (Request $request) {
        return 'Yo Vendor.';
    });
});




Route::get('/dev', function (Request $request) {

    // get all the users from the users table
    $users = DB::table('users')->get();

});

Route::get('/', function (Request $request) {
    return view('home');
});

Route::post('/post-test', function (Request $request) {
    dd(request()->get('name'), request()->get('email'));
});

Route::get('hello', function () {
    return view('hello', [
        'name' => 'Taylor',
        'age' => 30,
        'address' => 'Hà Nội'
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource(
        'product-category',
        \App\Http\Controllers\ProductCategoryController::class
    );

    Route::resource(
        'user',
        \App\Http\Controllers\UserController::class
    );
});
