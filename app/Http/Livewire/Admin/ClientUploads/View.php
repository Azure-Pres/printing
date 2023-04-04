<?php

namespace App\Http\Livewire\Admin\ClientUploads;

use App\Models\ClientUpload;
use Livewire\Component;

class View extends Component
{
    public $data;

    public function mount($id)
    {   
        $id = decrypt($id);
        $this->data = ClientUpload::find($id);
    }

    public function render()
    {   
        return view('livewire.admin.clientuploads.view')->layout('layouts.app');
    }
}
