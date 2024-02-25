<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    //One to many relationship
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    //One to many inversed relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionable()
    {
        return $this->morphTo();
    }
}
