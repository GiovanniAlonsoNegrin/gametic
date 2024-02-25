<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    //One to many inversed relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //One to many inversed relationship
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
