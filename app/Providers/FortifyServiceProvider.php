<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


        $this
            ->app
            ->instance(LogoutResponse::class, new class implements LogoutResponse {
                public function toResponse($request)
                {
                    return redirect('/');
                }
            });

        $this
            ->app
            ->instance(RegisterResponse::class, new class implements RegisterResponse {
                public function toResponse($request)
                {
                    // check if a url exists in the session variable url.intended
                    if (session()->has('url.intended')) {

                        // if it does, redirect to the url
                        return redirect(session('url.intended'));

                    } else {

                        // if it doesn't, redirect to the home
                        return redirect('/');
                    }
                }
            });

        $this
            ->app
            ->instance(LoginResponse::class, new class implements LoginResponse {
                public function toResponse($request)
                {
                    // check if a url exists in the session variable url.intended
                    if (session()->has('url.intended')) {

                        // if it does, redirect to the url
                        return redirect(session('url.intended'));

                    } else {

                        // if it doesn't, redirect to the home
                        return redirect('/');
                    }
                }
            });
    }
}
