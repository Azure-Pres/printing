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
                    'left' => "Verified Scan: Batch - {$batch->batch_name}",
                    'right' => "Printing material - {$batch->printing_material}"
                ];
                $this->emit('verificationSuccess');
            } else {
                $this->lastScanMessage = [
                    'left' => "Failed Scan: Batch - {$batch->batch_name}",
                    'right' => "Printing material - {$batch->printing_material}"
                ];
                $this->bgClass = 'bg-danger';
                $batch->failed_at = now();
                $batch->save();
                $this->emit('duplicateScan');
            }
        } else {
            $this->bgClass = 'bg-danger';
            $this->emit('batchNotFound');
            $this->lastScanMessage = [
                'left' => "Batch ID {$value} not found",
                'right' => ''
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
