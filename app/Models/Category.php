<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // * Massive assigment
    // * Introduce into array allowed properties
    protected $fillable = ['name', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    //One to many relationship
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
