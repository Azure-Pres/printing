<?php

namespace App\Http\Livewire\User\Scan;

use Livewire\Component;
use App\Models\PaytmBatchPrint;

class Index extends Component
{
    public $barcode;
    public $bgClass;

    public function updatedBarcode($value)
    {
        $batch = PaytmBatchPrint::where('batch_name', $value)->first();
        if ($batch) {
            if (!$batch->verified) {
                $batch->verified = true;
                $batch->save();
                $this->bgClass = 'bg-success';
            } else {
                $this->bgClass = 'bg-danger';
            }
        } else {
            $this->bgClass = 'bg-danger'; // Optionally handle case where batch ID is not found
        }
    }

    public function render()
    {
        return view('livewire.user.scan.index')->layout('layouts.user');
    }
}