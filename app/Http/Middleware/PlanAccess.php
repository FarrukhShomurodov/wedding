<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PlanAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {

        if (Auth::check() && Auth::user()->can($permission)) {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden'], 403);

    }
}
