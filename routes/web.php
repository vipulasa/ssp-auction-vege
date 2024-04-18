<?php

use App\Http\Controllers\BaseController;
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


Route::middleware([
//    'role:SuperAdministrator'
])
    ->get('dev', function (Request $request) {

       // create an auction
        $auction = \App\Models\Auction::create([
            'name' => 'Auction X',
            'description' => 'lorem ipsum',
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'status' => 1
        ]);


    return 'Yo Dev.';

});

/**
 * Administration routes
 */
Route::group(['prefix' => 'admin'], function () {

    /**
     * Authentication routes
     */
    Route::group(['prefix' => 'auth'], function () {
        // User resource route
        Route::resource('users', BaseController::class);

        // Farmer resource route
        Route::resource('farmers', BaseController::class);

        // Roles and permissions
        Route::resource('roles', BaseController::class);
        Route::resource('permissions', BaseController::class);

        // buyer management
        Route::resource('buyers', BaseController::class);
    });

    /**
     * Auction routes
     */
    Route::group(['prefix' => 'auction'], function () {
        // Bid management
        Route::resource('bids', BaseController::class);

        // Payment history
        Route::resource('payments', BaseController::class);

        // Payment gateways
        Route::resource('payment-gateways', BaseController::class);

        // Orders
        Route::resource('orders', BaseController::class);
    });

    /**
     * Analytic routes
     */
    Route::group(['prefix' => 'analytics'], function () {
       // @todo Add analytic routes
    });

    // Fertilisers & Pesticides
    Route::resource('fertilisers-pesticides', BaseController::class);

    // Categories
    Route::resource('categories', BaseController::class);

    // Support
    Route::resource('support-requests', BaseController::class);

    // Dashboard
    Route::get('/', function (Request $request) {
        return 'Yo Admin.';
    });

});

/**
 * Vendor routes
 */
Route::group(['prefix' => 'vendor'], function () {

    // Dashboard
    Route::get('/', function (Request $request) {
        return 'Yo Vendor.';
    });
});


/**
 * Product routes
 */
Route::get('/product/{product:slug}', [
    \App\Http\Controllers\ProductController::class,
    'show'
])->name('product.show');

Route::get('/category/{slug}', [
    \App\Http\Controllers\CategoryController::class,
    'show'
])->name('category.show');

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

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

//    Route::resource(
//        'user',
//        \App\Http\Controllers\UserController::class
//    );
});
