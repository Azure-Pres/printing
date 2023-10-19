<?php

namespace App\Http\Controllers;
use App\Exports\Admin\Batches\BatchesReportExport;
use Illuminate\Http\Request;
use DB;
use Excel;

class ReportsController extends Controller
{
    public function index()
    {
        return $this->batches();
    }

    public function batches()
    {
        $client_id = 4;

        $batches = DB::select("
            SELECT
            JSON_UNQUOTE(JSON_EXTRACT(code_data, '$.batch_id')) as batch,
            COUNT(*) as total_count,
            SUM(CASE WHEN first_verification_status = 'Success' THEN 1 ELSE 0 END) as first_verified_count,
            SUM(CASE WHEN second_verification_status = 'Success' THEN 1 ELSE 0 END) as second_verified_count
            FROM codes
            WHERE client_id = ?
            GROUP BY batch
            ", [$client_id]);

        $response = Excel::download(new BatchesReportExport($batches), 'batches.xlsx');

        ob_end_clean();
        return $response;
    }
}
