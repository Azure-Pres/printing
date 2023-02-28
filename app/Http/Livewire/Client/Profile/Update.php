<?php

namespace App\Http\Livewire\Client\Profile;

use Livewire\Component;
use App\Models\User;
use Auth;

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

    public function render()
    {
        return view('livewire.client.profiles.manage')->layout('layouts.client');
    }

    public function mount()
    {   
        $this->client = Auth::user();

        $this->name     = $this->client->name;
        $this->email    = $this->client->email;
        $this->phone    = $this->client->phone;
        $this->address  = $this->client->address;
        $this->city     = $this->client->city;
        $this->state    = $this->client->state;
        $this->country  = $this->client->country;
        $this->zipcode  = $this->client->zipcode;
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
        $this->client->update($validated);

        return redirect('client');

    }
}
