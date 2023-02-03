<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryCharacter extends Model
{
    protected $table = 'stories_characters';

    protected $fillable = [
        'story_id',
        'character_id'
    ];

    use HasFactory;
}
