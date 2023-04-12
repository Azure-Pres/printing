<?php

namespace App\Http\Livewire\Admin\JobCards;

use Livewire\Component;

class Home extends Component
{

    public function render()
    {   
        return view('livewire.admin.jobcards.home')->layout('layouts.app');
    }

    public function delete($id)
    {
        JobCard::find($id)->delete();
        $this->message = "Job card deleted successfully.";
        $this->success = true;

        return back();
    }
}
