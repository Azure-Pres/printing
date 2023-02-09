<?php

namespace App\Http\Livewire\Admin\Clients;

use Livewire\Component;
use App\Models\User;

class Update extends Component
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
    public $type     ='Client';

    public function render()
    {
        return view('livewire.admin.clients.manage');
    }

    public function mount($id)
    {
        $id = decrypt($id);
        
        $this->client = User::find($id);

        $this->name     = $this->client->name;
        $this->email    = $this->client->email;
        $this->phone    = $this->client->phone;
        $this->address  = $this->client->address;
        $this->city     = $this->client->city;
        $this->state    = $this->client->state;
        $this->country  = $this->client->country;
        $this->zipcode  = $this->client->zipcode;
        $this->status   = $this->client->status;
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
        $this->client->update($validated);

        return redirect('admin/clients');

    }
}
