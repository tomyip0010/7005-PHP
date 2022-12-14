<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApprovedRestaurant
{
    /**
     * Handle an incoming request and check if the user is an approved restaurant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $user || $user->userType !== '2' || !($user -> approved)) {
            abort(403);
            return redirect('login');
        }
        return $next($request);
    }
}
