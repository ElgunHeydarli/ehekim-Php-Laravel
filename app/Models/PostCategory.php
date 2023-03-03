<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'category_id',
    ];

    public function post(){
        return $this->belongsTo(\App\Models\Post::class,'post_id');
    }
}