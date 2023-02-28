<?php

namespace App\Http\Livewire\Admin\Codes;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {   
        return view('livewire.admin.codes.home')->layout('layouts.app');
    }
}
