<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'id',
        'story_id',
        'character_id'
    ];

    use HasFactory;
}
