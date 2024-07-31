<?php

namespace App\Http\Livewire\User\Scan;

use Livewire\Component;
use App\Models\PaytmBatchPrint;

class Index extends Component
{
    public $barcode;
    public $bgClass;
    public $lastScanMessage;

    public function updatedBarcode($value)
    {
        $batch = PaytmBatchPrint::where('batch_name', $value)->first();
        if ($batch) {
            if (!$batch->verified) {
                $batch->verified = true;
                $batch->save();
                $this->bgClass = 'bg-success';
                $this->lastScanMessage = [
                    'left' => "{$batch->batch_name}",
                    'right' => "{$batch->printing_material}",
                    'status' => "Verified"
                ];
                $this->emit('verificationSuccess');
            } else {
                $this->lastScanMessage = [
                    'left' => "{$batch->batch_name}",
                    'right' => "{$batch->printing_material}",
                    'status' => "Failed (Duplicate Scan)"
                ];
                $this->bgClass = 'bg-danger';
                $batch->timestamps = false;
                $batch->failed_at = now();
                $batch->save();
                $this->emit('duplicateScan');
            }
        } else {
            $this->bgClass = 'bg-danger';
            $this->emit('batchNotFound');
            $this->lastScanMessage = [
                'left' => "{$value} not found",
                'right' => "",
                'status' => "Failed (Batch not found)"

            ];
        }
        $this->barcode = null;
    }

    public function clearBarcode()
    {
        $this->barcode = '';
        $this->bgClass = '';
    }

    public function render()
    {
        return view('livewire.user.scan.index')->layout('layouts.user');
    }
}

