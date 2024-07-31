<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get ID user
        $userId = Auth::id();

        // Mengambil all post
        $posts = Post::where('id', $userId)->get();

        return view('blog.index', [
            'title' => 'My Blog Posts',
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create', ['title' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'title' => 'required|string|min:3',
            'category_id' => 'required',
            'body' => 'required|string|min:10'
        ]);

        //get author_id 
        $authorId = Auth::id();

        $data =  Post::create([
            'title' => $request->title,
            'author_id' => $authorId,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
        ]);

        return redirect('/posts')->with('status', 'Blog Post Created Succesfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('blog.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('blog.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // dd($request);

        $request->validate([
            'title' => 'required|string|min:3',
            'category_id' => 'required',
            'body' => 'required|string|min:10'
        ]);

        //get author_id 
        $authorId = Auth::id();

        $post->update([
            'title' => $request->title,
            'author_id' => $authorId,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
        ]);

        return redirect('/posts')->with('status', 'Blog Post Created Succesfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
