# whats-new-in-laravel9

1-Video (Controller Route Groups)

you can group routes by controller like this
Route::controller(PostController::class)->group(function() {
    Route::get('/posts', 'index');
    Route::post('/posts', 'store');
    Route::get('/posts/{post}', 'show');
});
