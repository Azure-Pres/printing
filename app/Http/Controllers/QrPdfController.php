<?php

namespace App\Http\Controllers;

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

    public function mmToPoint($mm)
    {
        return round((($mm / 10) / 2.54) * 72);
    }
}
