<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::get(
    '/test',
    'App\Http\Controllers\Api\TestController'
);

Route::post('/user', function (Request $request) {

    return rescue(function () use ($request) {

        // validate the data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // create a new user
        return tap(
            (new \App\Models\User())->create($request->all()),
            function ($user) {
                // create an access token
                $user->token = $user->createToken('api-token')->plainTextToken;
            });


    }, function (\Exception $e) {
        return response()
            ->json([
                'status' => false,
                'payload' => [
                    'message' => $e->getMessage(),
                ],
                '_time' => time(),
            ]);
    });
});


Route::get('product', function(){
    return response()->json([
        'status' => true,
        'payload' => \App\Models\Product::first(),
        '_time' => time(),
    ]);
});
