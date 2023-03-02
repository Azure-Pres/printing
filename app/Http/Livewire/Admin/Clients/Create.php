<?php

namespace App\Http\Livewire\Admin\Clients;

use Livewire\Component;
use App\Models\User;
use App\Models\CodeAttribute;
use App\Models\ClientAttribute;

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
    public $password   ='';
    public $applicable = [];
    public $unique     = [];
    public $type       ='Client';


    public function render()
    {
        $attributes = CodeAttribute::where('id','!=','')->get();
        return view('livewire.admin.clients.manage')->layout('layouts.app')->with('attributes',$attributes);
    }

    public function modify()
    {
        $rules = [
            'name'       => getRule('name',true),
            'email'      => getRule('email',true),
            'phone'      => getRule('mobile_number',true),
            'address'    => getRule('',true),
            'city'       => getRule('',true),
            'state'      => getRule('',true),
            'zipcode'    => getRule('zip',true),
            'password'   => getRule('',true),
            'status'     => getRule('',true),
            'applicable' => getRule('',true),
            'unique'     => getRule('',true),
        ];

        $validated = $this->validate($rules);

        $validated['type']  = $this->type;
        $validated['password']  = bcrypt($this->password);

        $client = User::create($validated);

        $destroy_permissions = ClientAttribute::where('user_id',$client->id)->delete();

        if (count($validated['applicable'])>0) {
            foreach($validated['applicable'] as $attribute){
                $assign = $this->assignApplicable('applicable',$attribute,$client->id);
            }
        }

        if (count($validated['unique'])>0) {
            foreach($validated['unique'] as $attribute){
                $assign = $this->assignApplicable('unique',$attribute,$client->id);
            }
        }

        return redirect('admin/clients');
    }

    public function assignApplicable($permission,$attribute,$user_id)
    {

        $assign = ClientAttribute::where('attribute_id',$attribute)->where('user_id',$user_id)->first();
        
        if(!$assign){
            $assign = new ClientAttribute;
        }

        $assign->user_id = $user_id;
        $assign->attribute_id = $attribute;
        $assign->$permission = '1';

        $assign->save();

        return true;
    }
}
