<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    private string $prefix = 'admin.pages.auth.';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Jetstream::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configurePermissions();
        $this->configureRoutes();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(
            function (Request $request) {
                $user = User::where('email', $request->email)->first();

                if ($user && Hash::check($request->password, $user->password) && $user->isActive()) {
                    return $user;
                }
            }
        );

        Fortify::loginView(fn() => view($this->prefix . 'user-login'));
        Fortify::twoFactorChallengeView(fn() => view($this->prefix . 'two-factor-challenge'));
        Fortify::registerView(
            function () {
                if (!session('plan')) {
                    return redirect()->route('site.home');
                }

                return view($this->prefix . 'user-register');
            }
        );
        Fortify::requestPasswordResetLinkView(fn() => view($this->prefix . 'forgot-password'));
        Fortify::resetPasswordView(
            fn(Request $request) => view('admin.pages.auth.reset-password')->with(
                ['token' => $request->route()->parameter('token'), 'email' => $request->email]
            )
        );
        Fortify::verifyEmailView(fn() => view($this->prefix . 'verify-email'));
        Fortify::confirmPasswordView(fn() => view($this->prefix . 'confirm-password'));
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }

    /**
     * Configure the routes offered by the application.
     *
     * @return void
     */
    protected function configureRoutes(): void
    {
        Route::group(
            [
                'namespace' => 'Laravel\Jetstream\Http\Controllers',
                'domain' => config('jetstream.domain', null),
                'prefix' => config('jetstream.prefix', config('jetstream.path')),
            ],
            function () {
                $this->loadRoutesFrom(base_path('routes/jetstream.php'));
            }
        );
    }
}
