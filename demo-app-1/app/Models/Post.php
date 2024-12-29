<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use HasTranslations;
    use HasTags;

    protected $fillable = ['title', 'content', 'user_id'];
    public $translatable = ['summary'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
