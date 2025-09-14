<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Catgory;
use App\Models\PostImage;
use App\Models\Comment;
use App\Models\Server;
use App\Models\User;

class Post extends Model
{
    //
    protected $fillable = ['title', 'content', 'server_id', 'user_id', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function photos(){
        return $this->hasMany(PostImage::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function server(){
        return $this->belongsTo(Server::class);
    }
}
