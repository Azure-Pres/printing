<?php

namespace App\Http\Controllers\Api\UploadData;

use App\Http\Controllers\Controller;
use App\Models\FileUploadTemp;
use Illuminate\Http\Request;
use App\Jobs\TestJob;
use Illuminate\Support\Facades\Bus;

class PhonePeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "LotData"       => 'required|array',
            "LotSize"       => 'required|integer',
        ]);

        $data = $request->LotData;

        if (count($data) != $request->LotSize) {
            return response([
                "success"  => false,
                "message"  => 'Malformed'
            ], 400);
        }

        foreach ($data as $row) {
            FileUploadTemp::create([
                'qr_id'                    => $row[0],
                'qr_text'                  => $row[1],
                'lot_number'               => $row[2],
                'printing_material'        => $row[3]
            ]);
        }

        Bus::batch([
            new TestJob(),
        ])->dispatch();

        return response([
            'success'  => true,
            'message'  => 'Data received successfully.'
        ], 200);
    }

    public function extractCsv($csvString)
    {
        $lines = explode("\n", $csvString);
        $data = [];
        foreach ($lines as $line) {
            $dataArray = str_getcsv($line);
            $data[] = $dataArray;
        }
        return $data;
    }
}