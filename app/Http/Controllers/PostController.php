<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $posts = Post::where('author_id', $userId)->get();

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
    public function show(Post $post, $id)
    {   
        $title = 'Single Post (author only)';
        $post = Post::findOrFail($id);
        return view('blog.show', compact('post', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post,$id)
    {
        //dump data
        // dd(compact('post')); 
        // dd($id); 
        $post = Post::findOrFail($id);
        $title = 'edit';
        return view('blog.edit', compact('post', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, $id)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'category_id' => 'required',
            'body' => 'required|string|min:10'
        ]);

        //get author_id 
        $authorId = Auth::id();

        //check if id on the table
        $post = Post::findOrFail($id);

        // dd($request);
        // dd($authorId);
        // dd($post);

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
    public function destroy(Post $post, $id)
    {
        // dd($post['id']);
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('blog.index')->with('status', 'Blog Deleted Succesfully ');
    }
}
