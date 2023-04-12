<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Permission;

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
    public $password ='';
    public $type     ='User';
    public $view     =[];
    public $modify   =[];    
    public $machines =[];
    public $show_printing_options = false;

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
        $this->machines   = json_decode($this->user->machines);
        $this->show_printing_options = $this->modify?true:false;
        $this->view     = Permission::where('user_id',$this->user->id)->where('view','1')->pluck('module_name');
        $this->modify   = Permission::where('user_id',$this->user->id)->where('modify','1')->pluck('module_name');
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
            'password'     => getRule('',false,true),
            'view'         => getRule('',false,true),
            'modify'       => getRule('',false,true),           
            'machines'     => getRule('',false,true)            
        ];

        $validated = $this->validate($rules);
        $validated['type']  = $this->type;

        if ($this->password!='') {
            $validated['password']  = bcrypt($this->password);
        }

        $this->user->update($validated);

        $destroy_permissions = Permission::where('user_id',$this->user->id)->delete();

        if (count($validated['view'])>0) {
            foreach($validated['view'] as $module){
                $assign = $this->assignPermission('view',$module,$this->user->id);
            }
        }

        if (count($validated['modify'])>0) {
            foreach($validated['modify'] as $module){
                $assign = $this->assignPermission('modify',$module,$this->user->id);
            }
        }

        $user->machines = json_encode($this->machines);
        $user->save();
        
        return redirect('admin/users');
    }

    public function assignPermission($permission,$module,$user_id)
    {

        $assign = Permission::where('module_name',$module)->where('user_id',$user_id)->first();

        if(!$assign){
            $assign = new Permission;
        }

        $assign->user_id = $user_id;
        $assign->module_name = $module;
        $assign->$permission = '1';

        if ($permission=='modify') {
            $assign->view = '1';
        }

        $assign->save();

        return true;
    }

    public function toggle_printing()
    {
        $this->show_printing_options = $this->modify?true:false;
    }
}
