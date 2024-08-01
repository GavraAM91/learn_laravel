<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Post::get();
        if ($blogs->count() > 0) {
            return BlogResource::collection($blogs);
        } else {
            return response()->json(['message' => 'No Record Available'], 200);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3',
            'author_id' => 'required',
            'category_id' => 'required',
            'body' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields is mandatory',
                'error' => $validator->messages()
            ], 422);
        }

        $blog = Post::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
        ]);

        return response()->json([
            'message' => 'Post Created Succesfully',
            'data' => new BlogResource($blog)
        ], 200);
    }
    public function show(Post $post, $id)
    {
        $post = Post::findOrFail($id);
        return new BlogResource($post);
    }
    public function update(Request $request, Post $post, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3',
            'author_id' => 'required',
            'category_id' => 'required',
            'body' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields is mandatory',
                'error' => $validator->messages()
            ], 422);
        }

        $post = Post::findOrFail($id);

        $post->update([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
        ]);

        return response()->json([
            'message' => 'Post Updated Succesfully',
            'data' => new BlogResource($post)
        ], 200);
    }
    public function destroy(Post $post, $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            'message' => 'Post Deleted Succesfully',
        ], 200);
    }
}
