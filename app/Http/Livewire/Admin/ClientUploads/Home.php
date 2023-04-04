<?php

namespace App\Http\Livewire\Admin\ClientUploads;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {   
        return view('livewire.admin.clientuploads.home')->layout('layouts.app');
    }
}
