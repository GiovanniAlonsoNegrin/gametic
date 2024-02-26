<?php

namespace App\Livewire\Admin;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class QuestionsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    #[On('destroyQuestion')]
    public function destroy($questionId)
    {
        $questionId = Question::find($questionId);
        $questionId->delete();
    }

    public function render()
    {
        $questions = Question::query()
        ->when($this->search, function ($query) {
            return $query->whereRelation('user', 'email', 'LIKE', '%'.$this->search.'%')
                ->orWhereRelation('user', 'name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('body', 'LIKE', '%'.$this->search.'%');
        })->with('user')->latest('id')->paginate();

        return view('livewire.admin.questions-index', compact('questions'));
    }
}
