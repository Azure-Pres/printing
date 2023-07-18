<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone_code',
        'phone',
        'secret_key',
        'token',
        'photo',
        'city',
        'state',
        'country',
        'zipcode',
        'address',
        'status',
        'machines'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function getClientAttributes()
    {
        return $this->hasMany(ClientAttribute::class,'user_id','id');
    }

    public static function getApiUserModel($input)
    {   
        $q = User::where('id','!=','');

        if(isset($input['id']) && $input['id']!='')
        {
            $q->where('id',$input['id']);
        }

        if(isset($input['search']) && $input['search']!='')
        {
            $search = $input['search'];
            $q->where(function($query) use ($search)
            {
                $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orWhere('phone', 'LIKE', '%'.$search.'%')
                ->orWhere('status', 'LIKE', '%'.$search.'%');
            });
        }

        $users = $q->get();

        return $users;
    }

    public static function getApiPermissionModel($input)
    {   
        $q = User::where('user_id',Auth::id());

        if(isset($input['id']) && $input['id']!=''){
            $q->where('id',$input['id']);
        }

        $user = $q->get();
        
        return $user;
    }
}
