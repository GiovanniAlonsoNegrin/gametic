<?php

namespace App\Livewire\Admin;

use App\Models\Answer;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AnswersIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    #[On('destroyAnswer')]
    public function destroy($answerId)
    {
        $answer = Answer::find($answerId);
        $answer->delete();
    }

    public function render()
    {
        $answers = Answer::query()
        ->when($this->search, function ($query) {
            return $query->whereRelation('user', 'email', 'LIKE', '%'.$this->search.'%')
                ->orWhereRelation('user', 'name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('body', 'LIKE', '%'.$this->search.'%');
        })->with('user')->latest('id')->paginate();

        return view('livewire.admin.answers-index', compact('answers'));
    }
}
