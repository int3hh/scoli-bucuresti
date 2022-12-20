<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Messages;

class FeedbackForm extends Component
{
    public $email;
    public $message;
    public $submited;

    public function submit() {
        $validatedData = $this->validate([
            'email' => 'required|email',
            'message' => 'required|min:5',
        ]);
       
        Messages::create([
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ]);
        $this->submited = true;
    }

    public function render()
    {
        return view('livewire.feedback-form');
    }
}
