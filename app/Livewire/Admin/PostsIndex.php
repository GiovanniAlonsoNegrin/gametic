<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    public function render()
    {
        $posts = Post::query()
            ->when($this->search, function ($query) {
                return $query->whereRelation('User', 'email', 'LIKE', '%'.$this->search.'%')
                    ->orWhereRelation('User', 'name', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('name', 'LIKE', '%'.$this->search.'%');
            })->with('User')->latest('id')->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
