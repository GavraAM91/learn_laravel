<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index () {
        return view('/crud/crud', ['title' => 'CRUD']);
    }

    public function create () {
        //
    }

    public function store (Request $request) {
        dd('request');
    } 

    public function show(string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }
}
