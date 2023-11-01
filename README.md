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

7-Video (Test Coverage with XDebug)

pecl install xdebug
first of all we have to install xdbug on this command

if not set in php ini file set it there
php -ini

then restart server

you can now see it in 
php -v

then set mode like this
XDEBUG_MODE=coverage php artisan test

then you can test you coverage. it will show you how much you project file are covered
XDEBUG_MODE=coverage php artisan test --coverage

you can set minimum treshold like this
XDEBUG_MODE=coverage php artisan test --coverage --min=80

8-Video (Laravel Scout Database Engine)
we can search in model by scout easily also we can paginate on it

how to install
composer require laravel/scout

how to publish
php artisan vendor:publish

and then select scout it will create scout file in config folder so configure it

'driver' => env('SCOUT_DRIVER', 'algolia'),
set it scout driver to database

now add seacable trait for the model in which you want to search
class Post extends Model
{
    use HasFactory, Searchable;

    public function user() {
        return $this->belongsTo(User::class);
    }
}

this trait have functions, realations and scopes on which you will search in models

now we will use it like this
Route::get('scout', function() {
    return Post::search('Voluptatum')->get();
});

by this funciton you will find search only in ttile and body

public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }

you can also paginate
Route::get('scout', function() {
    return Post::search('Voluptatum')->paginate();
});

9-Video (Full Text Indexing)

add fulltext() to body so we can search full text for body.
Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('body')->fulltext();
            $table->timestamps();
        });

you can seed only one seeder like this
php artisan migrate:fresh --seed --seeder=PostSeeder

then you can search in tinker full text searching like this like this
Post::whereFullText('body', 'natus')->count()

in previous video we have search post model but we were searching by Wherelike functionolity but when we add this check then it will search fulltext search. bu twe have to add fulltect() to its table in migration.
#[SearchUsingFullText('body')]
