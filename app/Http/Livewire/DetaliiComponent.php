<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\School;

class DetaliiComponent extends Component
{

    public $selectedSchool;

    protected $listeners = ['updateSchool' => 'updateSchool'];

    public function render()
    {
        return view('livewire.detalii-component');
    }

    public function mount() {
        $school = School::where('id', 10)->first();
        if ($school) {
            $this->selectedSchool = $school;
        }
    }

    public function updateSchool(School $id) {
        $this->selectedSchool = $id;        
    }
}
