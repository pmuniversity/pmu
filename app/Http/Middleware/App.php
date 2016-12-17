<?php

namespace PMU\Http\Middleware;

use PMU\Events\UserAccess;
use Closure;
use Illuminate\Http\Request;

class App
{
    /**
     * Handle an incoming request.
     *
     * @param Illuminate\Http\Request $request
     * @param Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        event(new UserAccess());

        return $next ($request);
    }
}
