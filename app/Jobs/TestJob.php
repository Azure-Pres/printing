<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;

class TestJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $tempData = FileUploadTemp::where('status', '!=', '3')->orWhereNull('status')->get();

        $groupedData = $tempData->groupBy('lot_number');

        DB::transaction(function() use ($groupedData) {
            foreach ($groupedData as $lotNumber => $rows) {
                $existingCodes = Code::select('qr_id', 'qr_text', 'lot_number')
                ->where('lot_number', $lotNumber)
                ->get()
                ->keyBy('qr_id');

                $validData = [];
                $invalidData = [];

                foreach ($rows as $row) {
                    $duplicate = false;

                    foreach (['qr_id', 'qr_text'] as $field) {
                        if ($existingCodes->contains($field, $row->$field)) {
                            $duplicate = true;
                            break;
                        }
                    }

                    if ($duplicate) {
                        $invalidData[] = $row;
                    } else {
                        $validData[] = $row;
                    }
                }

                $this->processData($lotNumber, $validData, $invalidData);
            }
        });
    }

    private function processData($lotNumber, $validData, $invalidData)
    {
        if (!empty($validData)) {
            $clientUpload = FileUploadTemp::create([
                'progress_id' => uniqid(),
                'total_rows' => count($validData),
                'lot_size' => count($validData),
                'status' => '2',
                'file_name' => $lotNumber,
                'lot_number' => $lotNumber,
            ]);

            $lastCode = Code::orderBy('serial_no', 'DESC')->first();
            $count = $lastCode ? $lastCode->serial_no : 0;
            $codesData = [];

            foreach ($validData as $row) {
                $count++;
                $codesData[] = [
                    'qr_id' => $row->qr_id,
                    'qr_text' => $row->qr_text,
                    'lot_number' => $row->lot_number,
                    'printing_material' => $row->printing_material,
                    'serial_no' => $count,
                    'upload_id' => $fileUpload->id,
                ];

                if (count($codesData) >= 50) {                        
                    Code::insert($codesData);                        
                    Log::info('Inserted ' . count($codesData) . ' rows into codes table');                        
                    $codesData = [];
                }
            }

            if (!empty($codesData)) {
                Code::insert($codesData);
                Log::info('Inserted remaining ' . count($codesData) . ' rows into codes table');
            }

            ClientUploadTemp::where('lot_number', $lotNumber)
            ->whereIn('id', array_column($validData, 'id'))
            ->update(['status' => '2']);
        }

        if (!empty($invalidData)) {
            foreach ($invalidData as $row) {
                $duplicateFields = [];

                foreach (['qr_id', 'qr_text'] as $field) {
                    if (isset($existingCodes[$row->$field])) {
                        $duplicateFields[] = $field;
                    }
                }

                ErrorLog::create([
                    'lot_number' => $lotNumber,
                    'error_message' => 'Duplicate data found: ' . json_encode($row) . '. Matching fields: ' . implode(', ', $duplicateFields),
                ]);
            }

            FileUploadTemp::where('lot_number', $lotNumber)
            ->whereIn('id', array_column($invalidData, 'id'))
            ->update(['status' => '3']);
        }

        Log::info('Deleting rows from client_upload_temps for lot_number: ' . $lotNumber);
        FileUploadTemp::where('lot_number', $lotNumber)
        ->whereIn('status', ['2', '3'])->delete();
        Log::info('Deleted rows from client_upload_temps for lot_number: ' . $lotNumber);
    }
}