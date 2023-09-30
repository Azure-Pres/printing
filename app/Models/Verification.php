<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Verification extends Model
{
    use HasFactory;
    
    public static function getApiVerificationModel($input)
    {   
        $q = Verification::orderBy('created_at','DESC');
        
        if (isset($input['client_id']) && $input['client_id']!='') {
            $q->where('client_id',$input['client_id']);
        }
        
        if (isset($input['batch_id']) && $input['batch_id']!='') {
            $q->whereHas('getCode',function($query) use ($input){
                $query->where('batch_id',$input['batch_id']);
            });
        }
        
        if (isset($input['date']) && $input['date']!='') {
            $q->whereDate('created_at',date('Y-m-d',strtotime($input['date'])));
        }
        
        if (isset($input['category']) && $input['category']=='me') {
            $q->where('scanned_by',Auth::id());
        }
        
        $total_q = clone $q;
        $total = $total_q->count();
        
        $perPage = isset($input['limit']) ? intval($input['limit']) : $total;
        $page = isset($input['offset']) ? intval($input['offset']) : 1;
        
        $verifications = $q->paginate($perPage, ['*'], 'page', $page);
        
        
        return [
            'total' => $total,
            'data'  => $verifications
        ];
    }
    
    public function getClient()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
    
    public function getCode()
    {
        return $this->belongsTo(Code::class,'code_id','id');
    }
}
