<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;


class TestController extends Controller
{
    public function __invoke()
    {

        return rescue(function(){

            return response()
                ->json([
                    'status' => true,
                    'payload' => [
                        'message' => 'Hello World!',
                    ],
                    '_time' => time(),
                ]);

        }, function (Exception $e) {

            return response()
                ->json([
                    'status' => false,
                    'payload' => [
                        'message' => $e->getMessage(),
                    ],
                    '_time' => time(),
                ]);

        });






        try {

            abort(403, 'Unauthorized access');

            return response()
                ->json([
                    'status' => true,
                    'payload' => [
                        'message' => 'Hello World!',
                    ],
                    '_time' => time(),
                ]);

        } catch (\Exception $e) {
            return response()
                ->json([
                    'status' => false,
                    'payload' => [
                        'message' => $e->getMessage(),
                    ],
                    '_time' => time(),
                ]);
        }

    }
}
