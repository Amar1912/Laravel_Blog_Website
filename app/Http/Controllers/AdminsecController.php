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
    public function delete_post($id)
    {
        \Log::info('delete_post called', ['id' => $id, 'user_id' => Auth::id()]);
        $post = Post::find($id);
        if ($post) {
            // Try to delete associated image from storage (if present)
            if ($post->image) {
                try {
                    // Try storage public disk first
                    if (Storage::disk('public')->exists($post->image)) {
                        Storage::disk('public')->delete($post->image);
                        \Log::info('Deleted post image (storage disk)', ['image' => $post->image]);
                    } elseif (File::exists(public_path($post->image))) {
                        // Fallback: file stored directly in public folder (e.g., public/posts/...)
                        File::delete(public_path($post->image));
                        \Log::info('Deleted post image (public path)', ['image' => $post->image]);
                    }
                } catch (\Exception $e) {
                    \Log::warning('Failed to delete post image', ['image' => $post->image, 'error' => $e->getMessage()]);
                }
            }
            $post->delete();
            \Log::info('Post deleted', ['id' => $id, 'user_id' => Auth::id()]);
            return redirect()->route('admin.show_post')->with('status', 'Post deleted successfully.');
        } else {
            \Log::warning('Post not found for deletion', ['id' => $id, 'user_id' => Auth::id()]);
            return redirect()->route('admin.show_post')->withErrors('Post not found.');
        }
    }

    public function edit_post($id)
    {
        $post = Post::find($id);

        return view('admin.edit_post', compact('post'));
    }

    public function update_post(Request $request, $id)
    {
        \Log::info('update_post called', ['id' => $id, 'user_id' => Auth::id(), 'input' => $request->except('image')]);

        $post = Post::find($id);
        if (!$post) {
            \Log::warning('Post not found for update', ['id' => $id, 'user_id' => Auth::id()]);
            return redirect()->route('admin.show_post')->withErrors('Post not found.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image replacement
        if ($request->hasFile('image')) {
            try {
                if ($post->image) {
                    $oldPath = $post->image;

                    // Build candidate paths to check and delete the old image reliably
                    $candidates = [];
                    $normalized = ltrim($oldPath, '/');

                    if (strpos($normalized, 'storage/') === 0) {
                        // If stored via storage: link, check both storage disk and public/storage
                        $candidates[] = substr($normalized, strlen('storage/'));
                        $candidates[] = public_path($normalized);
                    } else {
                        $candidates[] = $normalized; // for storage disk checks
                        $candidates[] = public_path($normalized); // public/posts/...
                        $candidates[] = public_path('storage/' . $normalized); // public/storage/posts/...
                    }

                    $deleted = false;
                    foreach ($candidates as $candidate) {
                        try {
                            // If candidate is an absolute path, use File methods
                            if (is_string($candidate) && File::exists($candidate)) {
                                File::delete($candidate);
                                \Log::info('Deleted old post image (public path normalized)', ['checked' => $candidate, 'original' => $oldPath]);
                                $deleted = true;
                                break;
                            }

                            // Otherwise check storage disk (expects relative path)
                            if (Storage::disk('public')->exists($candidate)) {
                                Storage::disk('public')->delete($candidate);
                                \Log::info('Deleted old post image (storage disk normalized)', ['checked' => $candidate, 'original' => $oldPath]);
                                $deleted = true;
                                break;
                            }
                        } catch (\Exception $e) {
                            \Log::warning('Error checking/deleting old image candidate', ['candidate' => $candidate, 'error' => $e->getMessage()]);
                        }
                    }

                    if (!$deleted) {
                        \Log::info('No old image file found to delete during update', ['original' => $oldPath, 'checks' => $candidates]);
                    }
                }
            } catch (\Exception $e) {
                \Log::warning('Failed deleting old image during update', ['image' => $post->image, 'error' => $e->getMessage()]);
            }

            $file = $request->file('image');
            try {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $moved = $file->move(public_path('posts'), $filename);

                if (!$moved || !File::exists(public_path('posts/' . $filename))) {
                    throw new \Exception('Failed to move uploaded image to public/posts');
                }

                $post->image = 'posts/' . $filename;
                \Log::info('Uploaded new post image', ['image' => $post->image]);
            } catch (\Exception $e) {
                \Log::error('Failed to upload new image during update', ['error' => $e->getMessage()]);
                // Do not interrupt the update process; image remains unchanged if upload fails
            }
        }

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->post_status = $request->input('post_status', $post->post_status);
        $post->save();

        \Log::info('Post updated', ['id' => $post->id, 'user_id' => Auth::id()]);

        return redirect()->route('admin.show_post')->with('status', 'Post updated successfully.');
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

        return back()->with('status', 'Post rejected');
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('posts'), $imageName);
            $post->image = 'posts/' . $imageName;
        }
        $post->save();
        return redirect()->route('admin.show_post')->with('status', 'Post updated successfully.');
    }
}
