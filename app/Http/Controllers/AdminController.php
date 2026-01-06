<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
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
=======
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('home.homepage');
    }

    public function homepage()
    {
        $posts = Post::all();
        return view('home.homepage', compact('posts'));
    }

    public function create_post()
    {
        return view('home.create_post');
    }

    public function store_post(Request $request)
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

    public function my_posts()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        return view('home.my_posts', compact('posts'));
    }

    public function delete_post($id)
    {
        $post = Post::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$post) {
            return back()->withErrors('Unauthorized action');
        }

        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        $post->delete();

        return back()->with('status', 'Post deleted successfully');
    }

    public function postDetails($id)
    {
        $post = Post::findOrFail($id);
        return view('home.postDetails', compact('post'));
    }
    public function edit_post($id)
{
    $post = Post::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

    return view('home.edit_post', compact('post'));
}
  public function update_post(Request $request, $id)
{
    $post = Post::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

    if (!$post) {
        return back()->withErrors('Unauthorized action');
    }

    // ✅ Validate
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ✅ Image update (optional)
    if ($request->hasFile('image')) {

        // delete old image
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path('posts'), $filename);
        $data['image'] = 'posts/'.$filename;
    }

    // reset status after update
    $data['post_status'] = 'pending';

    $post->update($data);

    return redirect()->route('user.my_posts')
                     ->with('status', 'Post updated successfully');
}

>>>>>>> today-broken-backup
}
