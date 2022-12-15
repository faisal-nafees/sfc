<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::whereBaseEnc('email', '=',$request->email)->first();

			if ($user && Hash::check($request->password, $user->password)) {
						return $user;

			}

        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
			$user = User::whereBaseEnc('email', '=',$request->email)->first();

            if ($user) {
				if($user->status == "Disabled"){
					//Check if its been more than 1hr since ban
					$banPeriodOver = $user->updated_at < Carbon::now()->subSeconds(1*3600+30*60);

					//If so then active the user acc
					if($banPeriodOver){
						$user->status = "Active";
						$user->save();

					}else{
						return redirect()->back()
							->withInput()
							->withErrors(['message' =>
										  'Your account has been DISABLED due to more than four failed login attempts. Please try after ONE HOUR!']);

					}

				}elseif($user->status == "Locked"){
					return redirect()->back() ->withInput()->withErrors(['message' => 'Your account is LOCKED']);

				}elseif(!Hash::check($request->password, $user->password)){

						if($user->failed_attempts > 4){
							$user->status = "Disabled";
							$user->save();
							return redirect()->back() ->withInput()->withErrors(['message' => 'Your account has been DISABLED due to more than four failed login attempts. Please try after ONE HOUR!']);

						}else{
							$user->failed_attempts = $user->failed_attempts+1;
							$user->save();

						}
				}else{

					$user->failed_attempts = null;
					$user->save();
				}
            }
            return Limit::perMinute(100)->by($request->email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
