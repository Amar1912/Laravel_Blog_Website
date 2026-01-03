<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // Purpose: control where Fortify sends users immediately after successful login.
        // Behavior: Redirects admin users to the admin dashboard and regular users to the
        // public homepage named 'home.homepage'.
        // Rationale: Admins should land in the admin area (admin.index) while normal users
        // arrive at the public homepage where header logic shows Logout and hides Login/Register.
        if ($user && $user->usertype === 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('home.homepage');
    }
}
