<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Course;

class ShareDataToViews
{
    public function handle(Request $request, Closure $next)
    {
        /*
         * Wspoldzielona lista idzie pod wlasna nazwa, nie jako `$courses`.
         *
         * `view()->share()` nadpisuje zmienne przekazane przez kontroler, wiec
         * paginator z `CoursesController@index` byl podmieniany na zwykla
         * kolekcje — a ta nie ma metod `total()`, `firstItem()` czy `links()`.
         * Strona `/courses` wywalala sie przez to bledem 500.
         */
        view()->share('navCourses', Course::query()->orderBy('name')->get());
        return $next($request);
    }
}
