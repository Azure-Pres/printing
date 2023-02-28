<?php

namespace App\Http\Livewire\Admin\Batches;

use Livewire\Component;
use App\Models\Batch;

class Update extends Component
{
    public $batch = null;
    public $batch_code = '';
    public $from_serial_number = '';
    public $to_serial_number = '';
    public $status   ='';

    public function render()
    {
        return view('livewire.admin.batches.manage')->layout('layouts.app');
    }

    public function mount($id)
    {
        $id = decrypt($id);
        
        $this->batch = Batch::find($id);

        $this->batch_code = $this->batch->batch_code;
        $this->from_serial_number = $this->batch->from_serial_number;
        $this->to_serial_number   = $this->batch->to_serial_number;
        $this->status   = $this->batch->status;
    }

    public function modify()
    {
        $rules = [
            'batch_code'   => getRule('',true),
            'from_serial_number'   => getRule('name',true),
            'to_serial_number'     => getRule('name',true),
            'status'             => getRule('',true),
        ];

        $validated = $this->validate($rules);
        $this->batch->update($validated);
        return redirect('admin/batches');

    }
}
