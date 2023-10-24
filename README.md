# whats-new-in-laravel9

1-Video (Controller Route Groups)

you can group routes by controller like this
Route::controller(PostController::class)->group(function() {
    Route::get('/posts', 'index');
    Route::post('/posts', 'store');
    Route::get('/posts/{post}', 'show');
});

2-Video (Anonymous Migration Classes)

when you create migartion it dont have a name that why it is called anonymus migration classes. before laravel 9 it have a proper name

this is in laravel 9
return new class extends Migration

3-Video (New Helper Functions)

These three code work the same. 

In laravel 8 you have to use this code to generate the string.
Str::of('hello world')->slug();

In laravel 9 you have to use this code to generate the string. you dont have to define classes for it.
Str('hello world')->slug();
Str()->slug('hello world');

we will call this route by three methods
Route::get('/', function () {
    return view('welcome');
})->name('home');

to_route is intruduce in laravel 9 which is easy to use.
Route::get('/endpoint', function () {
    return redirect('/');
    return redirect()->route('home');
    return to_route('home');
});

4-Video (Refreshed Ignition Error Page)

Route::get('/exception', function() {
    throw new \Exception('whoops');
});

you can throw axception like this
but there is a small styling changes in laravel 9. documentaion and setting schanges to top right

5-Video (Render a Blade String)

If you want to render somthing before passing to view you can do it like this
Route::get('/blade-rendering', function() {
    return Blade::render('{{ $greeting }}, @if (true) World @else folks @endif', ['greeting' => 'hello']);
});

6-Video (Forced Scope Bindings)

Route::get('users/{user}/posts/{post}', function(User $user, Post $post) {
    return $post;
})

http://127.0.0.1:8000/users/1/posts/1

it will wotk smoothly but when we pass another id for post it will give you the post but when you see the user_id in the url it will be different so in some apps the first wild card is neceeasary to check so we can restrict it by scope binding

we can do it by two ways

in laravel 8
Route::get('users/{user}/posts/{post:id}', function(User $user, Post $post) {
    return $post;
})

OR

in laravel 9
Route::get('users/{user}/posts/{post}', function(User $user, Post $post) {
    return $post;
})->scopeBindings();

