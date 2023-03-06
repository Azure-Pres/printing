<?php

namespace App\Http\Livewire\Admin\JobCards;

use Livewire\Component;
use App\Models\JobCard;

class Update extends Component
{
    public $job_card = null;
    public $job_card_id   ='';
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

    public function mount($id)
    {
        $id = decrypt($id);
        
        $this->job_card = JobCard::find($id);
        $this->job_card_id = $this->job_card->job_card_id;
        $this->machine = $this->job_card->machine;
        $this->print_status = $this->job_card->print_status;
        $this->allowed_copies = $this->job_card->allowed_copies;
        $this->first_verification_status = $this->job_card->first_verification_status;
        $this->second_verification_status = $this->job_card->second_verification_status;
        $this->remarks = $this->job_card->remarks;
        $this->status   = $this->job_card->status;
    }

    public function modify()
    {
        $rules = [
            'job_card_id' => getRule('',true),
            'machine'        => getRule('',true),
            'print_status'   => getRule('',true),
            'allowed_copies' => getRule('',true),
            'first_verification_status'  => getRule('',true),
            'second_verification_status' => getRule('',true),
            'remarks'        => getRule('',true),
            'status'      => getRule('',true),
        ];

        $validated = $this->validate($rules);
        $this->job_card->update($validated);
        return redirect('admin/job-cards');

    }
}
