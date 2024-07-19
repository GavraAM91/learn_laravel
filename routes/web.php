<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['nama' => 'Gavra Maheswara', 'title' => 'About']);
});

Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog', 'posts' => [
        [
            'id' => '1',
            'slug' => 'judul-artikel-2',
            'title' => 'Judul Artikel 1',
            'author' => 'Gavra Maheswara',
            'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, sequi obcaecati odio autem laborum
            vitae quo quasi illum impedit iste alias voluptatem tempore quos, ut doloremque quibusdam, adipisci
            consequuntur unde.'
        ],
        [
            'id' => '2',
            'slug' => 'judul-artikel-2',
            'title' => 'Judul Artikel 2',
            'author' => 'Gavra Maheswara',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, natus ab? Voluptates, omnis tempore. Earum,
            sed, accusantium cumque cupiditate quae enim debitis doloremque, harum voluptatum possimus eum! Rerum,
            dolorem error?.'
        ]
    ]]);
});

Route::get('/posts/{slug}', function ($slug) {
    $posts = [
        [
            'id' => '1',
            'slug' => 'judul-artikel-1',
            'title' => 'Judul Artikel 1',
            'author' => 'Gavra Maheswara',
            'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, sequi obcaecati odio autem laborum
        vitae quo quasi illum impedit iste alias voluptatem tempore quos, ut doloremque quibusdam, adipisci
        consequuntur unde.'
        ],
        [
            'id' => '2',
            'slug' => 'judul-artikel-2',
            'title' => 'Judul Artikel 2',
            'author' => 'Gavra Maheswara',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, natus ab? Voluptates, omnis tempore. Earum,
        sed, accusantium cumque cupiditate quae enim debitis doloremque, harum voluptatum possimus eum! Rerum,
        dolorem error?.'
        ]
    ];

    $post = Arr::first($posts, function ($post) use ($slug) {
        return $post['slug'] == $slug;
    });

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});
