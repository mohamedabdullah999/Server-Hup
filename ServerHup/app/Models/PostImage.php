<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class PostImage extends Model
{
    protected $fillable = ['image_path' , 'post_id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
