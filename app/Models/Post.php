<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// class Post extends Model
class Post 
{
    public static function all()
    {
        return [
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

    }

    public static function find($slug): array
    {
        // Arr::first(static::getStaticPosts(), function ($post) use ($slug) {
        //     return $post['slug'] == $slug;
        // });
        $post = Arr::first(static::all(), fn($post) => $post['slug'] == $slug);

        if(!$post) {
            abort(404);
        }

        return $post;
    }
}
