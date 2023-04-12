<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{
    use HasFactory;

    protected $fillable = ['job_card_id','machine','print_status','allowed_copies','first_verification_status','second_verification_status','remarks','status','divide_in_lot','lot_size','printing_material'];
}
