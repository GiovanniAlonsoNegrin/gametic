<?php

namespace App\Livewire;

use App\Models\Question as QuestionModel;
use Livewire\Component;

class Question extends Component
{
    public $model;

    public $message;

    public $showQuantity = 5;

    public $question_edit = [
        'id' => null,
        'body' => ''
    ];

    //Computed property
    public function getQuestionsProperty()
    {
        return $this->model
                    ->questions()
                    ->orderBy('created_at', 'desc')
                    ->take($this->showQuantity)
                    ->get();
    }

    public function store()
    {
        $this->validate([
            'message' => 'required|min:2'
        ]);

        $this->model->questions()->create([
            'body' => $this->message,
            'user_id' => auth()->id(),
        ]);

        $this->message = '';
    }

    public function edit($questionId)
    {
        $question = QuestionModel::find($questionId);

        $this->question_edit = [
            'id' => $question->id,
            'body' => $question->body
        ];
    }

    public function update()
    {
        $this->validate([
            'question_edit.body' => 'required|min:2'
        ]);

        $question = QuestionModel::find($this->question_edit['id']);
        $question->update([
            'body' => $this->question_edit['body']
        ]);

        $this->reset('question_edit');
    }

    public function destroy($questionId)
    {
        $question = QuestionModel::find($questionId);
        $question->delete();

        $this->reset('question_edit');
    }

    public function cancel()
    {
        $this->reset('question_edit');
    }

    public function showMoreQuestion()
    {
        $this->showQuantity += 5;
    }

    public function render()
    {
        return view('livewire.question');
    }
}
