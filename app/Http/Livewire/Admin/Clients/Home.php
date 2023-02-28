<?php

namespace App\Http\Livewire\Admin\Clients;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {   
        return view('livewire.admin.clients.home')->layout('layouts.app');
    }
}
