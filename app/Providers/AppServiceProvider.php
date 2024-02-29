<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
// use App\Providers\Paginator;
class AppServiceProvider extends ServiceProvider
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
        If (env('APP_ENV') !== 'local') {
            $this->app['request']->server->set('HTTPS', true);
        }

        // Schema::defaultStringLength(191);
        // Schema::defaultStringLength(191);
        // //Add this custom validation rule.
        // Validator::extend('alpha_spaces', function ($attribute, $value) {
        //     // This will only accept alpha and spaces.
        //     // If you want to accept hyphens use: /^[\pL\s-]+$/u.
        //     return preg_match('/^[\pL\s]+$/u', $value);
    
        //Add this custom validation rule.
        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[a-zA-Z0-9\s]+$/', $value);
        });

        //Add this custom validation rule.
        Validator::extend('alpha_num_underscore', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[a-zA-Z0-9_]*$/', $value);
        });

        Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            // Contain at least one uppercase/lowercase letters, one number and one special char
            return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/', (string)$value);
        }, 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.');

        //Add this custom validation rule.
        Validator::extend('new_email', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $value);
        });

        //Add this custom validation rule.
        Validator::extend('domain_url', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/', $value);
        });

        //Add this custom validation rule.
        Validator::extend('one_alpha_num_spaces', function ($attribute, $value) {
            // This will only accept atleast one alpha and with numbers and spaces.
            // If you want to accept hyphens use: /^[\d]*[a-zA-Z][a-zA-Z\d_." "]*$/.
            return preg_match('/^[\d]*[a-zA-Z][a-zA-Z\d_." "]*$/', $value);
        });

        view()->composer('*', function ($view) {
            // $view->with('global_setting_data', Setting::pluck('value', 'slug'));
            $view->with('global_setting_data', getJsonFile());
            $view->with('auth_user', Auth::user());
        });

        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        // Paginator::useBootstrap();
    }
}