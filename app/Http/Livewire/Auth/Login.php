<?php

namespace App\Http\Livewire\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $success, $message;

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }

    public function mount()
    {
        $this->email = null;
        $this->password = null;
    }

    public function rules()
    {
        return [
            'email' => getRule('email', true) . '|exists:users,email',
            'password' => getRule('', true)
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function login()
    {
        $this->validate();

        if(!Auth::attempt(['email'=>$this->email,'password'=>$this->password])){
            $this->success = false;
            $this->message = 'Invalid credentials. Please try again.';
            return false;
        }

        $user = Auth::user();

        if($user->status == 'Pending'){
            Auth::logout();
            $this->success = false;
            $this->message = 'Your account approval is in progress. Will notify you once it is approved.';
            return false;
        }

        if($user->status == 'Blocked'){
            Auth::logout();
            $this->success = false;
            $this->message = 'Your account is Blocked. Please contact to Administrator.';
            return false;
        }

        if($user->status == 'Inactive'){
            Auth::logout();
            $this->success = false;
            $this->message = 'Your account is Inactive. Please contact to Administrator.';
            return false;
        }

        if($user->type === 'Admin') {
            $this->success = true;
            $this->message = 'Login successful. Please wait.';
            return redirect('/admin');
        }

    }
}
