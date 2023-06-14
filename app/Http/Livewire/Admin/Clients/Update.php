<?php

namespace App\Http\Livewire\Admin\Clients;

use Livewire\Component;
use App\Models\User;
use App\Models\CodeAttribute;
use App\Models\ClientAttribute;
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
    public $password   ='';
    public $applicable = [];
    public $unique     = [];
    public $type     ='Client';

    public function render()
    {
        $attributes = CodeAttribute::where('id','!=','')->get();
        return view('livewire.admin.clients.manage')->with('attributes',$attributes)->layout('layouts.app');
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
        $this->applicable = ClientAttribute::where('user_id',$this->client->id)->where('applicable','1')->pluck('attribute_id');
        $this->unique     = ClientAttribute::where('user_id',$this->client->id)->where('unique','1')->pluck('attribute_id');
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
            'password'     => getRule('',false,true),
            'status'       => getRule('',true),
            'applicable'   => getRule('',false,true),
            'unique'       => getRule('',false,true),
        ];

        $validated = $this->validate($rules);
        $validated['type']  = $this->type;
        $validated['password']  = bcrypt($this->password);
        $this->client->update($validated);

        $destroy_permissions = ClientAttribute::where('user_id',$this->client->id)->delete();

        if (count($validated['applicable'])>0) {
            foreach($validated['applicable'] as $attribute){
                $assign = $this->assignApplicable('applicable',$attribute,$this->client->id);
            }
        }

        if (count($validated['unique'])>0) {
            foreach($validated['unique'] as $attribute){
                $assign = $this->assignApplicable('unique',$attribute,$this->client->id);
            }
        }

        userlog('Client','Client '.$validated['name'].' Updated');

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
