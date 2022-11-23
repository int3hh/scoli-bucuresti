<?php

namespace App\Http\Livewire;

use App\Models\School;
use Livewire\Component;

class HartaComponent extends Component
{

    public $schools;

    public function mount() {
        $this->schools = School::select('id', 'name', 'lat', 'lon', 'privat', 'nivel')->get()->toJson();
    }

    public function render()
    {
        return view('livewire.harta-component');
    }
}
