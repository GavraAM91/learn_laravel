<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;

Route::get('/', function () {
    return view('dashboard', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['nama' => 'Gavra Maheswara', 'title' => 'About']);
});

Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(9)->withQueryString( )]);
});

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load('category', 'author');

    return view('posts', ['title' => count($user->posts) . 'Articles by : ' . $user->name, 'posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', ['title' => 'Articles in : ' . $category->name, 'posts' => $category->posts]);
});

//login route
Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Home Page']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('blog',PostController::class);

//route for CRUD 
Route::middleware('auth')->group(function () {
    Route::get('/blog', [PostController::class, 'create'])->name('blog.create');
    Route::post('/blog', [PostController::class, 'store'])->name('blog.store');
    Route::get('/blog/{post}/edit', [PostController::class, 'edit'])->name('blog.edit');
    Route::patch('/blog/{post}', [PostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{post}', [PostController::class, 'destroy'])->name('blog.destroy');
});

// Route::middleware(['auth'])->group(function () {
//     Route::post('/blog/store', [PostController::class, 'store'])->name('blog.store');
// });

require __DIR__.'/auth.php';

//admin route
require __DIR__.'/admin-auth.php';
