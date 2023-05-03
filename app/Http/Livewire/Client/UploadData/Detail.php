<?php

namespace App\Http\Livewire\Client\UploadData;

use App\Models\ClientUpload;
use App\Models\Code;
use Livewire\Component;

class Detail extends Component
{
    public $data;
    public $uploaded_rows = 0;
    
    public function mount($id)
    {
        $id = decrypt($id);
        $this->data = ClientUpload::find($id);
        $this->uploaded_rows = Code::where('upload_id',$id)->count();
    }

    public function render()
    {
        return view('livewire.client.upload-data.detail')->layout('layouts.client');
    }
}
