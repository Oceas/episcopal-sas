<?php

namespace App\Models;

use App\HidesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HidesId;

    protected $fillable = [
        'uuid',
        'wp_post_id',
        'title',
        'link',
        'excerpt',
        'content',
        'publish_date',
        'author_name',
        'featured_image',
        'author'
    ];
}
