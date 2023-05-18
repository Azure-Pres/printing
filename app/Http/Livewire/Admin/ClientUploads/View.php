<?php

namespace App\Http\Livewire\Admin\ClientUploads;

use App\Models\ClientUpload;
use App\Models\Code;
use Livewire\Component;

class View extends Component
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
        return view('livewire.admin.clientuploads.view')->layout('layouts.app');
    }
}
