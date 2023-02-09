<?php

namespace App\Http\Livewire\Admin\Clients;

use Livewire\Component;
use App\Models\User;

class Create extends Component
{
    public $client = null;
    public $name     ='';
    public $email    ='';
    public $phone    ='';
    public $address  ='';
    public $city     ='';
    public $state    ='';
    public $country  ='';
    public $zipcode  ='';
    public $status   ='';
    public $view     =[];
    public $modify   =[];
    public $type     ='Client';


    public function render()
    {
        return view('livewire.admin.clients.manage');
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
        dd($this->validate($rules));
        $validated = $this->validate($rules);
        $validated['type']  = $this->type;

        $client = User::create($validated);

        return redirect('admin/clients');
    }
}
