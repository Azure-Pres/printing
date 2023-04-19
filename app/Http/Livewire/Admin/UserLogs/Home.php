<?php

namespace App\Http\Livewire\Admin\UserLogs;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {   
        return view('livewire.admin.userlogs.home')->layout('layouts.app');
    }
}
