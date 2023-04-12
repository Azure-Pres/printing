<?php

namespace App\Http\Livewire\Admin\Batches;

use Livewire\Component;
use App\Models\Batch;
use App\Models\User;
use App\Models\Code;

class Update extends Component
{
    public $batch = null;
    public $batch_code = '';
    public $from_serial_number = '';
    public $to_serial_number = '';
    public $status   ='';
    public $client   ='';

    public function render()
    {
        $clients = User::where('type','Client')->get();
        return view('livewire.admin.batches.manage')->with('clients',$clients)->layout('layouts.app');
    }

    public function mount($id)
    {
        $id = decrypt($id);
        $this->batch = Batch::find($id);
        $this->batch_code = $this->batch->batch_code;
        $this->from_serial_number = $this->batch->from_serial_number;
        $this->to_serial_number   = $this->batch->to_serial_number;
        $this->status   = $this->batch->status;
        $this->client   = $this->batch->client;
    }

    public function modify()
    {
        $rules = [
            'batch_code'         => getRule('',true).'|unique:batches,client,'.$this->client,
            'client'             => getRule('',true),
            'from_serial_number' => getRule('',true).'|exists:codes,serial_no,client_id,'.$this->client,
            'to_serial_number'   => getRule('',true).'|exists:codes,serial_no,client_id,'.$this->client,
            'status'             => getRule('',true),
        ];

        $validated = $this->validate($rules);
        $this->batch->update($validated);

        $update_codes = Code::where('serial_no','>=',$this->from_serial_number)->where('serial_no','<=',$this->to_serial_number)->where('client_id',$this->client)->update(['batch_id'=>$this->batch->id]);

        return redirect('admin/batches');

    }
}
