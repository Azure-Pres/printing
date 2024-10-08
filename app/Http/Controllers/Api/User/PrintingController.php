<?php

namespace App\Http\Controllers\Api\User;

use App\Exports\Admin\Code\CodeExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Printing\PrintingResource;
use App\Models\JobCard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PrintingController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $jobcards   = JobCard::getApiPrintingModel($input);
        $response   = PrintingResource::collection($jobcards);

        return response([
            'success'   => true,
            'message'   => 'Printing fetched successfully.',
            'jobcards'  => $response
        ], 200);
    }  

    public function download($id)
    {
        $job_card = JobCard::find($id);

        if ($job_card->machine=='Handtop') {
            $subpath = $job_card->file_url;
            $path = storage_path('app/'.$subpath);
            return response()->download($path);
        }else{
            return Excel::download(new CodeExport($job_card), 'codes.xlsx');
        }
        
    }  
}
