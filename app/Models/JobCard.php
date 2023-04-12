<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{
    use HasFactory;

    protected $fillable = ['job_card_id','batch_id','file_url','machine','print_status','allowed_copies','first_verification_status','second_verification_status','remarks','status'];

    public static function getApiJobCardModel($input)
    {   
        $q = JobCard::where('status','Active')->where('print_status','!=','Pending')->orderBy('created_at','DESC');
        $jobcards = $q->get();
        return $jobcards;
    }

    public static function getApiPrintingModel($input)
    {   
        $q = JobCard::where('print_status','Ready for Print')->orderBy('created_at','DESC');
        $jobcards = $q->get();
        return $jobcards;
    }

    public function getBatch()
    {
        return $this->belongsTo(Batch::class,'batch_id','id');
    }
}
