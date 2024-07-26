<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class TestController extends Controller
{
    public function savePhoto($pdfKey, $photoQrKey)
    {

        $url = "https://business-api.phonepe.com/apis/gemini/v1/external/qrDownload/{$pdfKey}?fileType=pdf";

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJhenVyZSIsImlhdCI6MTY4MTgxOTI5MiwiaXNzIjoiZ2VtaW5pIiwicm9sZSI6InFyVmVuZG9yIiwidHlwZSI6InN0YXRpYyIsImV4cCI6MzMyMTc4MTkyOTJ9.-XQJ7gbxrowy8i-14SFE2HmmSmhD0oL-cwyLp36O1q4oTQdKWN_M89b6uh5ZNNW9mCDtEm_vuklLDncmL2nKWA";

        $qr_id = "Q808585011@ybl";

        $response = Http::withToken($token)->get($url);

        if ($response->successful()) {
            $photoContent = $response->body();

            $fileName = 'qr_photo_' . $qr_id . '.pdf';

            Storage::disk('public')->put('qr_photos/' . $fileName, $photoContent);

            $photo = new Photo();
            $photo->photo_qr_key = $photoQrKey;
            $photo->photo_path = 'qr_photos/' . $fileName;
            $photo->qr_id = $qr_id;
            $photo->save();

            return response()->json(['message' => 'Photo saved successfully.'], 200);
        } else {
            return response()->json(['message' => 'Failed to download the photo.'], 500);
        }
    }

    public function importCsv()
    {
        $csvFilePath = public_path('csv/Batch_id.csv');

        if (!file_exists($csvFilePath)) {
            return response()->json(['message' => 'CSV file not found.'], 404);
        }

        $csvFile = fopen($csvFilePath, 'r');
        if (!$csvFile) {
            return response()->json(['message' => 'Unable to open CSV file.'], 500);
        }

        $header = fgetcsv($csvFile);

        $data = [];
        $batchSize = 400;
        while ($row = fgetcsv($csvFile)) {
            $data[] = [
                'batch_name' => $row[0],
                'printing_material' => $row[1],
                'verified' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert in batches
            if (count($data) == $batchSize) {
                DB::table('paytm_batch_prints')->insert($data);
                $data = []; // Reset the data array
            }
        }

        // Insert any remaining data
        if (count($data) > 0) {
            DB::table('paytm_batch_prints')->insert($data);
        }

        fclose($csvFile);

        return response()->json(['message' => 'CSV data imported successfully.']);
    }

    public function updateBatches()
    {
        $filePath = 'C:/xampp/htdocs/printing/public/csv/Paytm_Generic_2024_25July2024.csv';

        if (!file_exists($filePath)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        Excel::import(new class implements \Maatwebsite\Excel\Concerns\ToCollection {
            public function collection(Collection $rows)
            {
                foreach ($rows as $row) {
                    $batchName = $row[0];

                    DB::table('paytm_batch_prints')
                    ->where('batch_name', $batchName)
                    ->update(['verified' => true]);
                }
            }

        }, $filePath);

        return response()->json(['message' => 'Batches verified successfully.']);
    }
}