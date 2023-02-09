<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\User;

class View extends Component
{   
    public $admin = null;
    public $image    = null; 

    public function mount($id)
    {   
        $this->image = asset('assets/img/avatars/user.png');

        $id = decrypt($id);
        $admin = User::find($id);

        $this->admin = $admin;

        if ($admin->photo) {
            if (str_contains($admin->photo, 'http')) {
                $this->image = $admin->photo;
            }else{
                $this->image = asset('storage/'.$admin->photo);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.profiles.view');
    }
}
