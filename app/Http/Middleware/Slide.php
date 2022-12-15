<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Category;
use Illuminate\Http\Request;

class Slide
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // check if class purchased
        $x = in_array((int)explode('/', $_SERVER['REQUEST_URI'])[2], auth()->user()->categories->pluck('id')->toArray());
        if (explode('/', $_SERVER['REQUEST_URI'])[1] === "slideShow") {
            if ($x) {
                return $next($request);
            } else {
                // if not
                abort(403);
            }
        }
    }
}
