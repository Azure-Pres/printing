<?php

namespace App\Http\Livewire\Admin\UserLogs;

use App\Models\UserLog;
use Livewire\Component;

class View extends Component
{
    public $data;

    public function mount($id)
    {   
        $id = decrypt($id);
        $this->data = UserLog::find($id);
    }

    public function render()
    {   
        return view('livewire.admin.userlogs.view')->layout('layouts.app');
    }
}
