<?php

namespace App\Http\Livewire\Client\Profile;

use Livewire\Component;
use App\Models\User;
use Auth;
use Hash;

class ChangePassword extends Component
{
    public $old_password = '';
    public $password = '';
    public $password_confirmation = '';

    public function render()
    {
        return view('livewire.client.profiles.changepassword')->layout('layouts.client');
    }

    public function modify()
    {
        $rules = [
            'old_password' => getRule('',true),
            'password' => getRule('',true).'|confirmed',
        ];

        $this->validate($rules);
        $user= User::where('id', Auth::id())->first();

        if ($this->password == $this->old_password)
        {
            session()->flash('error', 'New password must be different from old password');
            return back();
        }
        if (!Hash::check($this->old_password, $user->password))
        {
            session()->flash('error', 'Old password is wrong.');
            return back();
        }
        $user->password = bcrypt($this->password);
        $user->save();

        return redirect('login');
    }

}
