<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Auth;
use Hash;

class ChangePassword extends Component
{
    public $confirm_password = '';
    public $new_password = '';
    public $password_confirmation = '';

    public function render()
    {
        return view('livewire.auth.changepassword');
    }

    public function modify()
    {
        $rules = [
            'old_password' => getRule('',true),
            'new_password' => getRule('',true).'|confirmed',
        ];

        $validated = $this->validate($rules);
        $user= User::where('id', Auth::id())->first();

        if (!Hash::check($validated->old_password, $user->password))
        {

            $response = [
                'success' => false,
                'message' => 'Old password is wrong.',
                'errors'  => [
                    'old_password' =>['Old password is wrong.']
                ]
            ];    

            return response($response, 400);
        }
        $user->password = bcrypt($validated->new_password);
        $this->admin->update($validated);

        return redirect('admin');

    }

}
