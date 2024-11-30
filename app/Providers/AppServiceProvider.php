<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
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
        // Force HTTPS in environments where it's necessary (e.g., production or Azure)
        if (request()->isSecure() || env('FORCE_HTTPS', true)) {
            URL::forceScheme('https');
        }
        
        $router = $this->app['router'];

        // Register middleware globally
        $router->aliasMiddleware('auth.admin', AdminMiddleware::class);
        $router->aliasMiddleware('auth.user', UserMiddleware::class);

        
            View::composer('admin.includes.header', function($view) {
                $view->with('user', Auth::user());
            });
        
        
            View::composer('user.includes.header', function($view) {
                $view->with('user', Auth::user());
            });
        
    }

    private function IsAdmin()
    {
        $user = Auth::user();

        return $user && $user->is_admin;
    }
}
