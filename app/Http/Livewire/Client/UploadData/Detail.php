<?php

namespace App\Http\Livewire\Client\UploadData;

use App\Models\ClientUpload;
use Livewire\Component;

class Detail extends Component
{
    public $data;
    
    public function mount($id)
    {
        $id = decrypt($id);
        $this->data = ClientUpload::find($id);
    }

    public function render()
    {
        return view('livewire.client.upload-data.detail')->layout('layouts.client');
    }
}
