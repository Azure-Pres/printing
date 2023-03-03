<?php

namespace App\Http\Livewire\Client\Codes;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {   
        return view('livewire.client.codes.home')->layout('layouts.client');
    }
}
