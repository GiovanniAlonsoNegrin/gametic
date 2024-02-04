<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'color'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    //Many to many relationship
    public function Posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
