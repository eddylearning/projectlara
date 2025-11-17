<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (!auth()->check()){
    //         return redirect()->route('login');
    //     }
    //     // if (auth()->check() && auth()->user()->role === 'employee'){
    //     // return $next($request);
    //     // }

    //      if (!auth()->check() || !auth()->user()->is_admin) {
    //         abort(403, 'Unauthorized access.');
    //     }
    //     return $next ($request);
    //     // abort(403, 'unauthorized access');
    // }

//     public function handle(Request $request, Closure $next)
// {
//     if (!auth()->check()) {
//         return redirect()->route('login');
//     }

//     if (auth()->user()->role !== 'employee') {
//         abort(403, 'Unauthorized');
//     }

//     return $next($request);
// }

   public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'employee') {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
