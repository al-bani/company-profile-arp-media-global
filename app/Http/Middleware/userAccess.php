<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class userAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {

         if (empty(auth('admin')->user()->role)) {
            return redirect()->intended('/login');
        }

        $loggedRole = auth('admin')->user()->role;
        foreach ($roles as $role) {
            if ($loggedRole === $role) {
                return $next($request);
            }
        }

        switch ($loggedRole) {
            case 'admin':
                return redirect()->intended('/admin');
            case 'superAdmin':
                return redirect()->intended('/superAdmin');
            default:
                return back()->with('access', 'Anda Tidak Punya Akses');
        }


    }
}
