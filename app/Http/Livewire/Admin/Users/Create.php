<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class Create extends Component
{
    public $user = null;
    public $username = null;
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
        // dd($validated);
        $user = User::create($validated);

        return redirect('admin/users');
    }
}
