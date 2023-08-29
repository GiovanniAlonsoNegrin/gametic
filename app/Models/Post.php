<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Reverse one to many relationship
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    //Many to many relationship
    public function Tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Polimorphic one to one relationship
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
