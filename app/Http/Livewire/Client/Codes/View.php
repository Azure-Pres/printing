<?php

namespace App\Http\Livewire\Client\Codes;

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
        return view('livewire.client.codes.view')->layout('layouts.client');
    }
}
