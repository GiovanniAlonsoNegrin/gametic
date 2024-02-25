<?php

namespace App\Livewire;

use App\Models\Answer as AnswerModel;
use Livewire\Component;

class Answer extends Component
{
    public $question;

    public $showQuantity = 0;

    public $answer_create = [
        'open' => false,
        'body' => ''
    ];

    public $answer_edit = [
        'id' => null,
        'body' => ''
    ];

    public $answer_to_answer = [
        'id' => null,
        'body' => ''
    ];

    //Computed property
    public function getAnswersProperty()
    {
        return $this->question->answers()
                ->get()
                ->take($this->showQuantity * (-1));
    }

    public function store()
    {
        $this->validate([
            'answer_create.body' => 'required|min:2'
        ]);

        $this->question->answers()->create([
            'body' => $this->answer_create['body'],
            'user_id' => auth()->id()
        ]);

        $this->showQuantity += 1;
        $this->reset('answer_create');
    }

    public function edit($answerId)
    {
        $answer = AnswerModel::find($answerId);

        $this->answer_edit = [
            'id' => $answer->id,
            'body' => $answer->body
        ];
    }

    public function update()
    {
        $this->validate([
            'answer_edit.body' => 'required|min:2'
        ]);

        $answer = AnswerModel::find($this->answer_edit['id']);
        $answer->update([
            'body' => $this->answer_edit['body']
        ]);

        $this->reset('answer_edit');
    }

    public function destroy($answerId)
    {
        $answer = AnswerModel::find($answerId);
        $answer->delete();
        $this->reset('answer_edit');
    }

    public function answer_to_answer_store()
    {
        $this->validate([
            'answer_to_answer.body' => 'required|min:2'
        ]);

        $this->question->answers()->create([
            'body' => $this->answer_to_answer['body'],
            'user_id' => auth()->id(),
        ]);

        $this->reset('answer_to_answer');
    }

    public function cancel()
    {
        $this->reset('answer_edit');
    }

    public function showAnswers() {
        if ($this->showQuantity < $this->question->answers()->count()) {
            $this->showQuantity = $this->question->answers()->count();
        } else {
            $this->showQuantity = 0;
        }
    }

    public function render()
    {
        return view('livewire.answer');
    }
}
