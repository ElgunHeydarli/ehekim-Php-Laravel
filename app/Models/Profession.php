<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
    ];

    public function tags(){
        return $this->belongsToMany(\App\Models\Tag::class,'profession_tags');
    }

    public function categories(){
        return $this->belongsToMany(\App\Models\Category::class,'profession_categories');
    }

    public function users(){
        return $this->belongsToMany(\App\Models\User::class,'user_professions');
    }
}
