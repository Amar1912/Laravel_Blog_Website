<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Http\Request;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toResponse($request)
    {
        // After logout, redirect to the public homepage (named route 'home.homepage')
        // Using the named route keeps behaviour consistent even if the root path changes.
        return redirect()->route('home.homepage');
    }
}
