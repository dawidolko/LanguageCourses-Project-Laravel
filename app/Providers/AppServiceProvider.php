<?php

namespace App\Providers;

use App\Http\View\Composers\CategoryComposer;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View as ViewFacade;

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
        /*
         * Asset URLs are built from APP_URL, not from the request header.
         *
         * In the container nginx listens on port 80 and 8000/8001 are only Docker
         * mappings, so PHP sees "localhost" without a port and `asset()` generated
         * links to http://localhost/css/..., which lead nowhere. The result: the page
         * loaded without any styles.
         */
        if ($url = config('app.url')) {
            URL::forceRootUrl($url);

            if (str_starts_with($url, 'https://')) {
                URL::forceScheme('https');
            }
        }
        $this->app->afterResolving(EncryptCookies::class, function ($middleware) {
            $middleware->disableFor('laravel_session');
            $middleware->disableFor('XSRF-TOKEN');
        });

        Gate::define('is-admin', function ($user) {
            return $user->role_id == 1;
        });

        /*
         * The navigation list goes under its own name, `navCourses`.
         *
         * This composer used to inject `$courses` into EVERY view, AFTER the
         * controller, replacing the paginator from `CoursesController@index` with a
         * plain collection. The view then called `->total()`, which a collection does
         * not have, and `/courses` ended in a 500 error.
         */
        ViewFacade::composer('*', function ($view) {
            $view->with('navCourses', Course::query()->orderBy('name')->get());
        });
    }
}
