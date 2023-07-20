<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\JobCard;
use App\Models\Template;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QrPdfController extends Controller
{
    public function index($id)
    {
        $id = decrypt($id);

        $template = Template::find($id);

        if (!$template) {
            return abort(404);
        }

        $data = json_decode($template->data,true);
        $customPaper = array(0, 0, $this->mmToPoint($data['page_data']['width']), $this->mmToPoint($data['page_data']['height']));
        
        $pdf = Pdf::loadView('pdf.qr', ['data' => $data])->setPaper($customPaper,'portrait');
        return $pdf->stream('qr.pdf');
    }

    public function preparePdf($jobcard,$template)
    {        
        $template = decrypt($template);
        $template = Template::find($template);
        if (!$template) {
            return abort(404);
        }

        $jobcard = decrypt($jobcard);
        $jobcard = JobCard::find($jobcard);
        if (!$jobcard) {
            return abort(404);
        }
        
        $codes = Code::where('batch_id',$jobcard->batch_id)->get();

        $data = json_decode($template->data,true);
        $customPaper = array(0, 0, $this->mmToPoint($data['page_data']['width']), $this->mmToPoint($data['page_data']['height']));
        
        $pdf = Pdf::loadView('pdf.prepare', ['data' => $data, 'codes'=>$codes])->setPaper($customPaper,'portrait');
        return $pdf->stream('prepared.pdf');
    }

    public function mmToPoint($mm)
    {
        return round((($mm / 10) / 2.54) * 72);
    }
}
