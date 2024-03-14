<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleValidationMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ?string  $role = null
    )
    {
        // check if a role is passed and the role is a valid Role enum
        if (!$role || !\App\Enums\Role::fromKey($role)) {
            abort(400, 'Invalid role.');
        }

        // check if a user is logged in or send the request to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // check if the user has a role attribute
        if (!auth()->user()->role) {
            return redirect()->route('login');
        }

        // check if the users role id exists in tge Role enum
        if (!\App\Enums\Role::fromValue(auth()->user()->role->value)) {
            return redirect()->route('login');
        }

        // check if the user has the role passed
        if (auth()->user()->role->value !== \App\Enums\Role::fromKey($role)->value) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
