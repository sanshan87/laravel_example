<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    const ROOT = 1;
    protected $fillable = ['title', 'slug', 'parent_id', 'description'];

    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /* Accessor*/

    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title ?? ($this->id === self::ROOT ? 'Корень' : '???');
        return $title;
    }
}
