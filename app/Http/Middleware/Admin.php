<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (Auth::user()->role !== "A") {
            $redirect_url = '/Dashboard';
            if (@session()->get('url')['intended']) {
                if (@session()->get('url')['intended'] != request()->getHttpHost() . "/login") {
                    $redirect_url = @session()->get('url')['intended'];
                }
            }
            return redirect($redirect_url);
        }
        return $next($request);
    }
}
