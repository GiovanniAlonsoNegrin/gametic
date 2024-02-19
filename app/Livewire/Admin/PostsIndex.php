<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use App\Rules\EmailExists;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $postName;

    public $postUser;

    public $clickedInResetPosts = false;
    public $authUser = null;

	// public function updatingSearch()
	// {
	// 	$this->resetPage();
	// }

    public function save(){
        $this->validate([
            'postUser' => ['nullable', 'email', new EmailExists]
        ]);
    }

    public function resetPosts()
    {
        $this->clickedInResetPosts = true;
        $this->postName = '';
        $this->postUser = null;
    }

    public function getUserIdByEmail()
    {
        if ($this->postUser || $this->authUser) {
            if(User::where('email', $this->postUser ? $this->postUser : $this->authUser)->exists()) {
                return User::where('email', $this->postUser ? $this->postUser : $this->authUser)->pluck('id');
            } else {
                return null;
            }
        }

        return null;
    }

    public function showMyPosts()
    {
        $this->postUser = null;
        $this->authUser = auth()->user()->email;
    }

    public function render()
    {
        $posts = Post::where('name', 'LIKE', '%'.$this->postName.'%')
        ->when($this->getUserIdByEmail(), function ($query, $userId) {
            return $query->where('user_id', $userId);
        })
        ->latest('id')
        ->paginate();

        $this->authUser = null;

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
