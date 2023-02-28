<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\User;
use Auth;

class Update extends Component
{
    public $admin = null;
    public $name     ='';
    public $email    ='';
    public $phone    ='';
    public $address  ='';
    public $city     ='';
    public $state    ='';
    public $country  ='';
    public $zipcode  ='';

    public function render()
    {
        return view('livewire.admin.profiles.manage')->layout('layouts.app');
    }

    public function mount()
    {   
        $this->admin = Auth::user();

        $this->name     = $this->admin->name;
        $this->email    = $this->admin->email;
        $this->phone    = $this->admin->phone;
        $this->address  = $this->admin->address;
        $this->city     = $this->admin->city;
        $this->state    = $this->admin->state;
        $this->country  = $this->admin->country;
        $this->zipcode  = $this->admin->zipcode;
    }

    public function modify()
    {
        $rules = [
            'name'         => getRule('name',true),
            'email'        => getRule('email',true),
            'phone'        => getRule('mobile_number',true),
            'address'      => getRule('',true),
            'city'         => getRule('',true),
            'state'        => getRule('',true),
            'zipcode'      => getRule('zip',true),
        ];

        $validated = $this->validate($rules);
        $this->admin->update($validated);

        return redirect('admin');

    }
}
