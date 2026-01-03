<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    // Redirect after login based on role
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // NOTE: This method is used as a login redirect handler.
        // Previous behavior differentiated admin vs normal users and redirected to different dashboards.
        // Current behavior: send authenticated users (both admin and normal) to the public homepage
        // ('home.homepage') so the header/menu logic can consistently show Logout and hide Login/Register.
        return redirect()->route('home.homepage');
    }

    // Public homepage (GitHub HTML template)
    public function homepage()
    {
        return view('home.homepage');
    }

    // Show admin registration form (reuses auth.register view)
    public function showRegister()
    {
        return view('auth.register', ['action' => route('admin.register.store')]);
    }

    // Handle admin creating a new user
    public function register(Request $request)
    {
        $data = $request->all();

        // Use the Fortify CreateNewUser action to validate and create
        $creator = new CreateNewUser();
        $user = $creator->create($data);

        // Optionally set default usertype if provided
        if (isset($data['usertype'])) {
            $user->usertype = $data['usertype'];
            $user->save();
        }

        return redirect()->route('admin.index')->with('status', 'User created successfully.');
    }
}
