<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Permission extends Model
{
    use HasFactory;

    public static function getApiPermissionModel($input)
    {   
        $q = Permission::where('user_id',Auth::id());
        dd(Auth::id());
        if(isset($input['id']) && $input['id']!=''){
            $q->where('id',$input['id']);
        }

        $permissions = $q->get();
        
        return $permissions;
    }
}
