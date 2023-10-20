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
