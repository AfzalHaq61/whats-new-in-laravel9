<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use App\Enums\PostState;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $appends = [
        'path'
    ];

    protected $casts = [
        'state' => PostState::class
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    #[SearchUsingFullText('body')]
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }

    public function path(): Attribute
    {
        return Attribute::get(fn() => route('posts.show', $this));
    }

    // public function getPathAttribute() {
    //     return route('posts.show', $this);
    // }
}
