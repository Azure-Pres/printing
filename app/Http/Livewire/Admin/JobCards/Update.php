<?php

namespace App\Http\Livewire\Admin\JobCards;

use App\Exports\Admin\Code\CodeExport;
use App\Models\JobCard;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Update extends Component
{
    use WithFileUploads;

    public $job_card = null;
    public $job_card_id   ='';
    public $machine = '';
    public $print_status = '';
    public $allowed_copies = '';
    public $first_verification_status = '';
    public $second_verification_status = '';
    public $remarks  = '';
    public $status   ='';
    public $batch_code   ='';
    public $batch_id   ='';
    public $print_file;

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
        $this->batch_id   = $this->job_card->batch_id;
        $this->batch_code   = $this->job_card->getBatch->batch_code;
    }

    public function modify()
    {
        $rules = [
            'job_card_id' => getRule('',true).'|unique:job_cards,job_card_id,'.$this->job_card->id,
            'machine'        => getRule('',true),
            'print_status'   => getRule('',true),
            'allowed_copies' => getRule('',true),
            'first_verification_status'  => getRule('',true),
            'second_verification_status' => getRule('',true),
            'remarks'        => getRule('',true),
            'status'         => getRule('',true),
        ];

        if ($this->print_status=='Ready for Print') {
            $rules['print_file'] = getRule('',true);
        }

        $validated = $this->validate($rules);

        if ($this->print_status=='Ready for Print') {
            $validated['file_url']   = $this->print_file->store('print_files');
        }

        $this->job_card->update($validated);
        return redirect('admin/job-cards');

    }

    public function downloadCodes()
    {
        return Excel::download(new CodeExport($this->job_card), date('Y-m-d').'-codes.csv');
    }
}
