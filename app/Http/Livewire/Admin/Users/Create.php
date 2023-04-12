<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Permission;

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
            'password'     => getRule('',true),
            'view'         => getRule('',false,true),
            'modify'       => getRule('',false,true)
        ];

        $validated = $this->validate($rules);
        $validated['type']  = $this->type;
        $validated['password'] = bcrypt($this->password);
        $user = User::create($validated);

        $destroy_permissions = Permission::where('user_id',$user->id)->delete();

        if (count($validated['view'])>0) {
            foreach($validated['view'] as $module){
                $assign = $this->assignPermission('view',$module,$user->id);
            }
        }

        if (count($validated['modify'])>0) {
            foreach($validated['modify'] as $module){
                $assign = $this->assignPermission('modify',$module,$user->id);
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