<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Reverse one to many relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Many to many relationship
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Polimorphic one to one relationship
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
