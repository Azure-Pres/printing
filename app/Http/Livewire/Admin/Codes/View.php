<?php

namespace App\Http\Livewire\Admin\Codes;

use Livewire\Component;
use App\Models\User;
use App\Models\Code;

class View extends Component
{
    public $code = null;

    public function mount($id)
    {   
        $id = decrypt($id);
        $code = Code::find($id);

        $this->code = $code;
    }

    public function render()
    {   
        return view('livewire.admin.codes.view')->layout('layouts.app');
    }
}
