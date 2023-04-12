<?php

namespace App\Exports\Admin\Code;

use App\Models\Code;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CodeExport implements FromView
{
    public function __construct($job_card){
        $this->job_card = $job_card;
    }
    public function view(): View
    {
        $codes = Code::where('batch_id',$this->job_card->batch_id)->get();
        $client = User::find($this->job_card->getBatch->client);
        return view('livewire.admin.exports.codes')->with('codes',$codes)->with('client',$client);
    }
}
