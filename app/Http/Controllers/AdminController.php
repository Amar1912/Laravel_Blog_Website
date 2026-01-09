<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    // Login redirect
    public function index()
    {
        return redirect()->route('home.homepage');
    }

    // Public homepage
    public function homepage()
    {
        $posts = Post::latest()->get();
        return view('home.homepage', compact('posts'));
    }

    // Public post details
    public function post_details($id)
    {
        $post = Post::findOrFail($id);
        return view('home.post_details', compact('post'));
    }

    // Show register form (admin)
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
            ->with('status', 'User created successfully');
    }

    // Create post (user)
    public function create_post()
    {
        return view('home.create_post');
    }

    public function user_post(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('posts'), $filename);
            $data['image'] = 'posts/'.$filename;
        }

        $data['user_id'] = Auth::id();
        $data['name'] = Auth::user()->name;
        $data['usertype'] = Auth::user()->usertype ?? 'user';
        $data['post_status'] = 'pending';

        Post::create($data);

        return back()->with('status', 'Post submitted successfully');
    }

    // My posts
    public function my_posts()
    {
        $posts = Post::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('home.my_posts', compact('posts'));
    }

    // Delete post (user)
    public function delete_post($id)
    {
        $post = Post::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        $post->delete();

        return back()->with('status', 'Post deleted successfully');
    }

    // Edit post (user)
    public function edit_post($id)
    {
        $post = Post::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('home.edit_post', compact('post'));
    }

    // Update post (user)
    public function update_post(Request $request, $id)
    {
        $post = Post::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('posts'), $filename);
            $data['image'] = 'posts/'.$filename;
        }

        $data['post_status'] = 'pending';

        $post->update($data);

        // ✅ FIXED ROUTE NAME
        return redirect()->route('home.my_posts')
            ->with('status', 'Post updated successfully');
    }
}
