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
        $this->status   = $this->batch->status;
        $this->client   = $this->batch->client;
    }

    public function modify()
    {
        $rules = [
            'batch_code'         => getRule('',true).'|unique:batches,client,'.$this->client,
            'status'             => getRule('',true),
        ];

        $validated = $this->validate($rules);
        $this->batch->update($validated);

        userlog('Batch','Batch '.$validated['batch_code'].' Updated');

        return redirect('admin/batches');

    }
}
