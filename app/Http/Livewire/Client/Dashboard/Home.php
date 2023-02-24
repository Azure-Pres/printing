<?php

namespace App\Http\Livewire\Client\Dashboard;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.client.dashboard.home')->layout('layouts.client');
    }
}
