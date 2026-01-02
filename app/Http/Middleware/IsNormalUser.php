<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsNormalUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If user is admin, redirect to admin dashboard
        if (Auth::user()->usertype === 'admin') {
            return redirect()->route('admin.index');
        }

        return $next($request);
    }
}
