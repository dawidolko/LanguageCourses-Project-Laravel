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
         * The shared list goes under its own name, not `$courses`.
         *
         * `view()->share()` overrides variables passed by the controller, so the
         * paginator from `CoursesController@index` was replaced by a plain collection,
         * which has no `total()`, `firstItem()` or `links()` methods. The `/courses`
         * page crashed with a 500 error because of that.
         */
        view()->share('navCourses', Course::query()->orderBy('name')->get());
        return $next($request);
    }
}
