<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function published(?User $user, Post $post)
    {
        if ($post->status == 'enable') {
            return true;
        }

        return false;
    }
}
