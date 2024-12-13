<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Course;

class ShareDataToViews
{
    public function handle(Request $request, Closure $next)
    {
        view()->share('courses', Course::all());
        return $next($request);
    }
}
