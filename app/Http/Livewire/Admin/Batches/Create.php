<?php

namespace App\Http\Livewire\Admin\Batches;

use Livewire\Component;
use App\Models\Batch;
use App\Models\User;
use App\Models\Code;

class Create extends Component
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

    public function modify()
    {
        $rules = [
            'batch_code'         => getRule('',true).'|unique:batches',
            'client'             => getRule('',true),
            'from_serial_number' => getRule('',true).'|exists:codes,serial_no,client_id,'.$this->client,
            'to_serial_number'   => getRule('',true).'|exists:codes,serial_no,client_id,'.$this->client,
            'status'             => getRule('',true),
        ];

        $validated = $this->validate($rules);  

        $check = Code::where('client_id',$this->client)->where('serial_no',$this->from_serial_number)->where('batch_id','!=',NULL)->exists();

        if ($check) {
            $this->addError('from_serial_number', 'Serial number already exists in another batch.');
            return false;
        }

        if ($this->from_serial_number>=$this->to_serial_number) {
            $this->addError('to_serial_number', 'Invalid serial taken.');
            return false;
        }

        $batch = Batch::create($validated);

        $update_codes = Code::where('serial_no','>=',$this->from_serial_number)->where('serial_no','<=',$this->to_serial_number)->where('client_id',$this->client)->update(['batch_id'=>$batch->id]);

        userlog('Batch','Batch Added');

        return redirect('admin/batches');

    }
}
