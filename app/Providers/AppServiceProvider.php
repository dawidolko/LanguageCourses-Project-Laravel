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
         * Adresy assetow budujemy z APP_URL, nie z naglowka zadania.
         *
         * W kontenerze nginx slucha na porcie 80, a 8000/8001 to dopiero
         * mapowanie Dockera — PHP widzi wiec "localhost" bez portu i `asset()`
         * generowal linki do http://localhost/css/..., czyli w pustke. Efekt:
         * strona ladowala sie bez zadnych styli.
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
         * Lista dla nawigacji idzie pod wlasna nazwa `navCourses`.
         *
         * Wczesniej ten kompozytor wstrzykiwal `$courses` do KAZDEGO widoku i
         * robil to PO kontrolerze, wiec podmienial paginator z
         * `CoursesController@index` na zwykla kolekcje. Widok wolal potem
         * `->total()`, ktorego kolekcja nie ma — strona `/courses` konczyla sie
         * bledem 500.
         */
        ViewFacade::composer('*', function ($view) {
            $view->with('navCourses', Course::query()->orderBy('name')->get());
        });
    }
}
