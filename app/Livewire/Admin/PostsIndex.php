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

    public $switchStatus = [];

    public function mount()
    {
        $this->resetSwitchStatus();
    }

    public function toggleSwitch($postId)
    {
        $newStatus = $this->switchStatus[$postId] == 'enable' ? 'disable' : 'enable';
        $this->switchStatus[$postId] = $postId;

        $post = Post::where('id', $postId)->first();
        $post->update([
            'status' => $newStatus
        ]);
    }

    public function resetSwitchStatus() {
        $posts = Post::orderBy('id')->pluck('id')->toArray();
        $status = Post::orderBy('id')->pluck('status')->toArray();
        $this->switchStatus = array_combine($posts, $status);
    }

    public function render()
    {
        $posts = Post::query()
            ->when($this->search, function ($query) {
                return $query->whereRelation('User', 'email', 'LIKE', '%'.$this->search.'%')
                    ->orWhereRelation('User', 'name', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('name', 'LIKE', '%'.$this->search.'%');
            })->with('User')->latest('id')->paginate();

        $this->resetSwitchStatus();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
