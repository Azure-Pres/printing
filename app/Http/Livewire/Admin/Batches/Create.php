<?php

namespace App\Http\Livewire\Admin\Batches;

use Livewire\Component;
use App\Models\Batch;

class Create extends Component
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

    public function modify()
    {
        $rules = [
            'batch_code'         => getRule('name',true),
            'from_serial_number'   => getRule('name',true),
            'to_serial_number'     => getRule('name',true),
            'status'             => getRule('',true),
        ];
        $validated = $this->validate($rules);

        $batch = Batch::create($validated);

        return redirect('admin/batches');

    }
}
