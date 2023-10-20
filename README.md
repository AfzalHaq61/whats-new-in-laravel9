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


