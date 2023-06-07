<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    public static function getApiVerificationModel($input)
    {   
        $q = Verification::orderBy('created_at','DESC');

        if (isset($input['client_id']) && $input['client_id']!='') {
            $q->where('client_id',$input['client_id']);
        }

        if (isset($input['date']) && $input['date']!='') {
            $q->whereDate('created_at',date('Y-m-d',strtotime($input['date'])));
        }

        $verifications = $q->get();
        return $verifications;
    }

    public function getClient()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
}
