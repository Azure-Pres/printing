<?php

namespace App\Exports\Client\Samples;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UploadSample implements FromView
{
    public function view(): View
    {
        return view('livewire.client.exports.samples.upload_data');
    }
}
