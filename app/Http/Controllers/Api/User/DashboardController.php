<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\JobCard;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_jobcards = JobCard::where('status','Active')->where('print_status','!=','Pending')->count();
        $ready_for_print = JobCard::where('print_status','Ready for Print')->count();
        $printed_jobcards = JobCard::where('print_status','Printed')->count();
        $in_progress = JobCard::where('print_status','Work in Progress')->count();

        $today_total_jobcards = JobCard::where('status','Active')->where('print_status','!=','Pending')->whereDate('created_at',Carbon::now())->count();
        $today_ready_for_print = JobCard::whereDate('created_at',Carbon::now())->where('print_status','Ready for Print')->count();
        $today_printed_jobcards = JobCard::whereDate('created_at',Carbon::now())->where('print_status','Printed')->count();
        $today_in_progress = JobCard::whereDate('created_at',Carbon::now())->where('print_status','Work in Progress')->count();

        $month_total_jobcards = JobCard::where('status','Active')->where('print_status','!=','Pending')->count();
        $month_ready_for_print = JobCard::whereMonth('created_at',Carbon::now())->where('print_status','Ready for Print')->count();
        $month_printed_jobcards = JobCard::whereMonth('created_at',Carbon::now())->where('print_status','Printed')->count();
        $month_in_progress = JobCard::whereMonth('created_at',Carbon::now())->where('print_status','Work in Progress')->count();

        return [
            'total_jobcards' => $total_jobcards,
            'ready_for_print' => $ready_for_print,
            'printed_jobcards' => $printed_jobcards,
            'in_progress' => $in_progress,
            'today_total_jobcards' => $total_jobcards,
            'today_ready_for_print' => $ready_for_print,
            'today_printed_jobcards' => $printed_jobcards,
            'today_in_progress' => $in_progress,
            'month_total_jobcards' => $total_jobcards,
            'month_ready_for_print' => $ready_for_print,
            'month_printed_jobcards' => $printed_jobcards,
            'month_in_progress' => $in_progress,
        ];
    }
}
