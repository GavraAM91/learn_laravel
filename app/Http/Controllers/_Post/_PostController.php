<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return view('/blog/create', ['title' => 'CRUD']);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //for debugging only
        // dd($request);

        //validate request system
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'body' => 'required|min:10',
        ], [
            'title.required' => 'The Title Must Not be Blank',
            'title.min' => 'Minimum have 3 characthers for title',
            'author.required' => 'The Author name must not be blank',
            'author.min' => 'the author name at least have 3 characthers',
            'body.required' => 'The Body must not be blank',
            'body.min' => 'Minimum have 10 characters for the body',
        ]);

        //recieve all data from form (crud.blade.php)
        $data = [
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'category' => $request->input('category'),
            'body' => $request->input('body'),
        ];

        //send into model post
        Post::created($data);

        //back into page
        return redirect('/posts')->with('success', 'Success to create post');

    }

    public function show(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
