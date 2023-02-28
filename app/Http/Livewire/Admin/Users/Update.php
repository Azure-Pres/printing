<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class Update extends Component
{
    public $user = null;
    public $name     ='';
    public $email    ='';
    public $phone    ='';
    public $address  ='';
    public $city     ='';
    public $state    ='';
    public $country  ='';
    public $zipcode  ='';
    public $status   ='';
    public $type     ='User';

    public function render()
    {
        return view('livewire.admin.users.manage')->layout('layouts.app');
    }

    public function mount($id)
    {
        $id = decrypt($id);
        
        $this->user = User::find($id);

        $this->name     = $this->user->name;
        $this->email    = $this->user->email;
        $this->phone    = $this->user->phone;
        $this->address  = $this->user->address;
        $this->city     = $this->user->city;
        $this->state    = $this->user->state;
        $this->country  = $this->user->country;
        $this->zipcode  = $this->user->zipcode;
        $this->status   = $this->user->status;
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
            'status'       => getRule('',true),
        ];

        $validated = $this->validate($rules);
        $validated['type']  = $this->type;
        $this->user->update($validated);

        return redirect('admin/users');

    }
}
