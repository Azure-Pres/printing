<?php

namespace App\Http\Livewire\Admin\JobCards;

use Livewire\Component;
use App\Models\JobCard;
use App\Models\Batch;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $job_card = null;
    public $job_card_id = '';
    public $batch_id = '';
    public $machine = '';
    public $print_status = '';
    public $allowed_copies = '';
    public $first_verification_status = '';
    public $second_verification_status = '';
    public $remarks  = '';
    public $status   ='';
    public $print_file;

    public function render()
    {
        $included = JobCard::pluck('batch_id');
        $batches = Batch::where('status','Active')->whereNotIn('id',$included)->get();
        return view('livewire.admin.jobcards.manage')->with('batches',$batches)->layout('layouts.app');
    }

    public function modify()
    {
        $rules = [
            'job_card_id'    => getRule('',true).'|unique:job_cards',
            'batch_id'       => getRule('',true),
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

        $job_card = JobCard::create($validated);

        return redirect('admin/job-cards');

    }
}
