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
        return view('blog.create', ['title' => 'create']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(string $id)
    {
        return view('blog.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
