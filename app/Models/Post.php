<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'text',
        'views',
        'category_id',
        'user_id',
    ];

    public function categories(){
        return $this->belongsToMany(\App\Models\Category::class,'post_categories');
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(\App\Models\Comment::class,'post_id');
    }

    public function tags(){
        return $this->belongsToMany(\App\Models\Tag::class,'post_tags');
    }
}
