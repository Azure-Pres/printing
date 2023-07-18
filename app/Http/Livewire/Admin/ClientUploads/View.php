<?php

namespace App\Http\Livewire\Admin\ClientUploads;

use App\Models\ClientUpload;
use App\Models\Code;
use Livewire\Component;
use Carbon\Carbon;

class View extends Component
{
    public $data;
    public $uploaded_rows = 0;
    public $production_status = 'Pending';
    public $old_production_status = 'Pending';
    public $dispatch_data;

    public function mount($id)
    {   
        $id = decrypt($id);
        $this->data = ClientUpload::find($id);
        $this->uploaded_rows = Code::where('upload_id',$id)->count();
        $this->old_production_status = $this->data->production_status;
        $this->production_status = $this->data->production_status;
        $this->dispatch_data = $this->data->dispatch_data;
    }


    public function rules()
    {
        $rules = [
            'production_status'=> getRule('',true)
        ];
        if ($this->production_status=='Dispatched') {
            $rules['dispatch_data'] = getRule('',true);
        }
        return $rules;
    }

    public function modify()
    {
        $this->validate();

        $this->data->production_status = $this->production_status;

        if ($this->production_status=='Ready' && $this->old_production_status!=$this->production_status) {
            $this->data->ready_at = Carbon::now();
        }

        if ($this->production_status=='Dispatched' && $this->old_production_status!=$this->production_status) {
            $this->data->dispatched_at = Carbon::now();
            $this->data->dispatch_data = $this->dispatch_data;
        }

        $this->data->save();

        userlog('Lot','Lot '.$this->data->progress_id.' status updated.');
        return redirect('admin/client-uploads/view/'.encrypt($this->data->id));
    }

    public function render()
    {   
        return view('livewire.admin.clientuploads.view')->layout('layouts.app');
    }
}
