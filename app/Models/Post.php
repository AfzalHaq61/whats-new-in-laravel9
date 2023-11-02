<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use App\Enums\PostState;

class Post extends Model
{
    use HasFactory, Searchable;

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
}
