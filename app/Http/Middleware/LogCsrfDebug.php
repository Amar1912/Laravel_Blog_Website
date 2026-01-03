<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogCsrfDebug
{
    public function handle(Request $request, Closure $next)
    {
        // Only log POST requests to login (and two-factor) to avoid excessive noise
        if ($request->isMethod('post') && in_array($request->path(), ['login', 'two-factor-challenge'])) {
            try {
                \Log::info('CSRF Debug - Incoming POST to ' . $request->path(), [
                    'session_id' => $request->session()->getId(),
                    'session_token' => $request->session()->get('_token'),
                    'input_token' => $request->input('_token'),
                    'header_x_csrf_token' => $request->header('X-CSRF-TOKEN'),
                    'header_x_xsrf_token' => $request->header('X-XSRF-TOKEN'),
                    'cookie_xsrf' => $request->cookie('XSRF-TOKEN'),
                    'cookies' => $request->cookies->all(),
                    'method' => $request->method(),
                    'path' => $request->path(),
                ]);
            } catch (\Exception $e) {
                // Don't interrupt request flow for logging errors
                \Log::warning('CSRF Debug logging failed', ['error' => $e->getMessage()]);
            }
        }

        return $next($request);
    }
}
