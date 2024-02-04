<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use App\Rules\EmailExists;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\TryCatch;

class PostsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $postName;

    public $postUser;

	// public function updatingSearch()
	// {
	// 	$this->resetPage();
	// }

    public function save(){
        $this->validate([
            'postUser' => ['email', new EmailExists]
        ]);
    }

    public function resetPosts()
    {
        $this->postName = '';
        $this->postUser = null;
    }

    public function getUserIdByEmail()
    {
        if ($this->postUser) {
            if(User::where('email', $this->postUser)->exists()) {
                return User::where('email', $this->postUser)->pluck('id');
            } else {

            }
        }

        return null;
    }

    public function showMyPosts()
    {
        $this->postUser = auth()->user()->email;
    }

    public function render()
    {

        $posts = Post::where('name', 'LIKE', '%'.$this->postName.'%')
        ->when($this->getUserIdByEmail(), function ($query, $userId) {
            return $query->where('user_id', $userId);
        })
        ->latest('id')
        ->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
