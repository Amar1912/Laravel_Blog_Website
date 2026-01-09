<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminsecController extends Controller
{
    public function add_post()
    {
        return view('admin.add_post');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('posts'), $filename);
            $data['image'] = 'posts/'.$filename;
        }

        $data['user_id'] = Auth::id();
        $data['name'] = Auth::user()->name ?? null;
        $data['usertype'] = Auth::user()->usertype ?? null;
        $data['post_status'] = $request->post_status ?? 'draft';

        Post::create($data);

        return redirect()->route('admin.add_post')
            ->with('status', 'Post added successfully.');
    }

    public function show_post()
    {
        $posts = Post::latest()->get();
        return view('admin.show_post', compact('posts'));
    }

    public function delete_post($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image && File::exists(public_path($post->image))) {
            File::delete(public_path($post->image));
        }

        $post->delete();

        return redirect()->route('admin.show_post')
            ->with('status', 'Post deleted successfully.');
    }

    public function edit_post($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.edit_post', compact('post'));
    }

    public function update_post(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($post->image && File::exists(public_path($post->image))) {
                File::delete(public_path($post->image));
            }

            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('posts'), $filename);
            $data['image'] = 'posts/'.$filename;
        }

        $post->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'] ?? $post->image,
            'post_status' => $request->post_status ?? $post->post_status,
        ]);

        return redirect()->route('admin.show_post')
            ->with('status', 'Post updated successfully.');
    }

    public function approve_post($id)
    {
        $post = Post::findOrFail($id);
        $post->post_status = 'approved';
        $post->save();

        return back()->with('status', 'Post approved successfully');
    }

    public function reject_post($id)
    {
        $post = Post::findOrFail($id);
        $post->post_status = 'rejected';
        $post->save();

        return back()->with('status', 'Post rejected successfully');
    }
}
