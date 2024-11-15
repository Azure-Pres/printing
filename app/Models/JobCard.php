<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class JobCard extends Model
{
    use HasFactory;

    protected $fillable = ['job_card_id','batch_id','file_url','machine','print_status','allowed_copies','first_verification_status','second_verification_status','remarks','status','divide_in_lot','lot_size','printing_material'];

    public static function getApiJobCardModel($input)
    {   
        $machines = json_decode(Auth::user()->machines);

        $q = JobCard::where('status','Active')->where('print_status','!=','Pending')->orderBy('created_at','DESC');
        $jobcards = $q->get();
        return $jobcards;
    }

    public static function getApiPrintingModel($input)
    {   
        $machines = json_decode(Auth::user()->machines);

        $q = JobCard::where('print_status','Ready for Print')->whereIn('machine',$machines)->orderBy('created_at','DESC');
        $jobcards = $q->get();
        return $jobcards;
    }

    public function getBatch()
    {
        return $this->belongsTo(Batch::class,'batch_id','id');
    }
}
