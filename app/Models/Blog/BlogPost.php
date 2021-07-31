<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function postCategory(){
        return $this->belongsTo(BlogPostCategory::class, 'category_id', 'id');
    }
}
