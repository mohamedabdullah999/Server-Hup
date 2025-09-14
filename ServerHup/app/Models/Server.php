<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Server extends Model
{

    protected $fillable = ['name', 'description', 'image', 'created_by'];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function owner(){
        return $this->belongsTo(User::class , 'created_by');
    }
}
