<?php

namespace App\Http\Livewire\Admin\JobCards;

use Livewire\Component;
use App\Models\JobCard;

class Update extends Component
{
    public $job_card = null;
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
        $this->status   = $this->job_card->status;
    }

    public function modify()
    {
        $rules = [
            'job_card_id' => getRule('',true),
            'status'      => getRule('',true),
        ];

        $validated = $this->validate($rules);
        $this->job_card->update($validated);
        return redirect('admin/job-cards');

    }
}
