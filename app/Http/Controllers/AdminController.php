<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    // Login redirect handler
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return redirect()->route('home.homepage');
    }

    // Public homepage (blog list)
    public function homepage()
    {
        $posts = Post::latest()->get();
        return view('home.homepage', compact('posts'));
    }

    // Public blog details page
    public function post_details($id)
    {
        $post = Post::findOrFail($id);
        return view('home.post_details', compact('post'));
    }

    // Admin creates new user
    public function showRegister()
    {
        return view('auth.register', [
            'action' => route('admin.register.store')
        ]);
    }

    public function register(Request $request)
    {
        $creator = new CreateNewUser();
        $user = $creator->create($request->all());

        if ($request->has('usertype')) {
            $user->usertype = $request->usertype;
            $user->save();
        }

        return redirect()->route('admin.index')
            ->with('status', 'User created successfully.');
    }

    public function create_post()
    {
        return view('home.create_post');
    }

    public function user_post(Request $request)
    {
        $post = new Post();

        $post->title = $request->title;
        $post->description = $request->description;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image = move('posts', $imagename);
            $post->image = $imagename;
        }

        $post->save();

        return redirect()->back();
    }
}
