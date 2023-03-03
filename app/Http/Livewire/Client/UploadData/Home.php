<?php

namespace App\Http\Livewire\Client\UploadData;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.client.upload-data.home')->layout('layouts.client');
    }
}
