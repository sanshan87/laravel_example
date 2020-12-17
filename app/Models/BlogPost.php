<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    public const UNKNOWN_USER = 1;

    protected $fillable = ['title',
        'slug',
        'category_id',
        'content_raw',
        'excerpt',
        'is_published',
        'published_at',
        'user_id'];

    public function category(){
        return $this->belongsTo(BlogCategory::class,'category_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
