<?php

use App\Models\Post;
use App\Models\User;
use App\Enums\PostState;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/blade-rendering', function() {
    return Blade::render('{{ $greeting }}, @if (true) World @else folks @endif', ['greeting' => 'hello']);
});

Route::get('/exception', function() {
    throw new \Exception('whoops');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/endpoint', function () {
    // return redirect('/');
    // return redirect()->route('home');
    return to_route('home');
});

Route::get('/str', function () {
    // return Str::of('hello world')->slug();
    // return Str('hello world')->slug();
    return Str()->slug('hello world');
});

// Route::controller(PostController::class)->group(function() {
//     Route::get('/posts', 'index');
//     Route::post('/posts', 'store');
//     Route::get('/posts/{post}', 'show');
// });

Route::get('users/{user}/posts/{post}', function(User $user, Post $post) {
    return $post;
})->scopeBindings();

Route::get('scout', function() {
    return Post::search('Est magnam')->paginate();
})->name('hello');

// Route::get('/posts/{state}', function(PostState $state) {
//     dd($state);
// });

Route::get('/posts/{post}', function(Post $post) {
    return $post;
})->name('posts.show');

