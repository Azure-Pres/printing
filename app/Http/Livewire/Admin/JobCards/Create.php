<?php

namespace App\Http\Livewire\Admin\JobCards;

use Livewire\Component;
use App\Models\JobCard;

class Create extends Component
{
    public $job_card = null;
    public $job_card_id = '';
    public $machine = '';
    public $print_status = '';
    public $allowed_copies = '';
    public $first_verification_status = '';
    public $second_verification_status = '';
    public $remarks  = '';
    public $status   ='';

    public function render()
    {
        return view('livewire.admin.jobcards.manage')->layout('layouts.app');
    }

    public function modify()
    {
        $rules = [
            'job_card_id'    => getRule('',true),
            'machine'        => getRule('',true),
            'print_status'   => getRule('',true),
            'allowed_copies' => getRule('',true),
            'first_verification_status'  => getRule('',true),
            'second_verification_status' => getRule('',true),
            'remarks'        => getRule('',true),
            'status'         => getRule('',true),
        ];

        $validated = $this->validate($rules);

        $job_card = JobCard::create($validated);

        return redirect('admin/job-cards');

    }
}
