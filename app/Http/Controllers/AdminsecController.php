<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AdminsecController extends Controller
{
    public function add_post()
    {
        return view('admin.add_post');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        \Log::info('AdminsecController@store called', ['input' => $request->except('image')]);

        // Validate input
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            // Handle image upload if present
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('posts'), $filename);
                $data['image'] = 'posts/' . $filename;
            }

            // Add authenticated user info
            $data['user_id'] = Auth::id();
            $data['name'] = Auth::check() ? Auth::user()->name : null;
            $data['usertype'] = Auth::check() ? (Auth::user()->usertype ?? null) : null;
            $data['post_status'] = $request->input('post_status', 'draft');

            // Create post
            $post = Post::create($data);

            \Log::info('Post created', ['id' => $post->id]);

            return redirect()->route('admin.add_post')->with('status', 'Post added successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to create post', ['error' => $e->getMessage()]);

            return redirect()->route('admin.add_post')->withErrors('Unable to save post, check logs for details.');
        }
    }

    public function show_post()
    {
        $posts = Post::all();
        return view('admin.show_post', compact('posts'));
    } 
}
