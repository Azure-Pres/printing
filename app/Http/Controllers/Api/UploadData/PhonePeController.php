<?php

namespace App\Http\Controllers\Api\UploadData;

use App\Http\Controllers\Controller;
use App\Models\ClientUpload;
use App\Models\Code;
use App\Models\User;
use Illuminate\Http\Request;

class PhonePeController extends Controller
{
    public $id = 5;

    public function getToken(Request $request, $secret_key)
    {
        $client = User::where('id',$this->id)->where('secret_key',$secret_key)->first();

        if (!$client) {
            return response([
                "success"  => false,
                "message"  => 'Invalid Key'
            ],400);
        }

        $client->token = $client->createToken('app-token')->plainTextToken;
        $client->save();

        return response($client->token, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "LotData"       => getRule('',true),
            "LotSize"       => getRule('integer',true),
            "APIToken"      => getRule('',true),
            "LotChecksum"   => getRule('',true)
        ]);

        if (!$this->verifyToken($request->APIToken)) {
            return response([
                "success"  => false,
                "message"  => 'Authentication Fail'
            ],400);
        }

        if ($request->LotChecksum!=hash('sha224', $request->LotData)) {
            return response([
                "success"  => false,
                "message"  => 'Invalid Lot Checksum'
            ],400);
        }

        $data = $this->extractCsv($request->LotData);

        if (!is_array($data)) {
            return response([
                "success"  => false,
                "message"  => 'Malformed'
            ],400);
        }

        if (!$this->hasNoBlankEntry($data)) {
            return response([
                "success"  => false,
                "message"  => 'Malformed. Blank entry found.'
            ],400);
        }

        if (count($data)!=$request->LotSize) {
            return response([
                "success"  => false,
                "message"  => 'Incorrect count'
            ],400);
        }

        $lot_position = 2;
        $printing_material_position = 3;

        if (!isset($data[0][$printing_material_position]) || $data[0][$printing_material_position]=='') {
            return response([
                "success"  => false,
                "message"  => 'Printing material missing'
            ],400);
        }

        $lot_number = $data[0][$lot_position];
        $find = ClientUpload::where('lot_number',$lot_number)->where('client_id',$this->id)->first();

        if ($find) {
            return response([
                "success"  => false,
                "message"  => 'Repeated Lot'
            ],400);
        }

        if (!$this->hasUniqueData($data,0)) {
            return response([
                "success"  => false,
                "message"  => 'Repeated Qr id'
            ],400);
        }

        if (!$this->hasUniqueData($data,1)) {
            return response([
                "success"  => false,
                "message"  => 'Repeated Qr text'
            ],400);
        }

        if (!$this->arraysHaveSameValueAtIndex($data,2)) {
            return response([
                "success"  => false,
                "message"  => 'Different lot number present'
            ],400);
        }

        if (!$this->arraysHaveSameValueAtIndex($data,3)) {
            return response([
                "success"  => false,
                "message"  => 'Different printing material present'
            ],400);
        }

        $qr_ids = $this->getValuesAtIndex($data, 0);
        $qr_texts = $this->getValuesAtIndex($data, 1);

        $duplicate_qr_ids = Code::where('client_id',$this->id)->whereIn('code_data->qr_id',$qr_ids)->orWhereIn('code_data->qr_text',$qr_texts)->exists();
        
        if ($duplicate_qr_ids) {
            return response([
                "success"  => false,
                "message"  => 'Duplicate QR id or text present'
            ],400);
        }

        $client_upload = new ClientUpload;
        $client_upload->client_id  = $this->id;
        $client_upload->progress_id= $progress_id = uniqid();;
        $client_upload->total_rows = $request->LotSize;
        $client_upload->lot_size   = $request->LotSize;
        $client_upload->status     = '2';
        $client_upload->file_name  = $data[0][2];
        $client_upload->lot_number = $data[0][2];
        $client_upload->printing_material = $data[0][3];
        $client_upload->save();

        foreach ($data as $key => $row) {
            $count = Code::where('client_id',$this->id)->count();              
            $serial_no = $count+1;

            try{
                $collect = [
                    'client_id'           => $this->id,
                    'code_data'           => json_encode([
                        'qr_id'   => $row[0],
                        'qr_text' => $row[1],
                        'lot_no'  => $row[2],
                        'printing_material' => $row[3],
                    ]),
                    'serial_no'           => $serial_no,
                    'upload_id'           => $client_upload->id
                ];

                Code::create($collect);
                $client_upload->uploaded_rows = $client_upload->uploaded_rows+1;
            }catch(Exception $e){
            }

            $client_upload->processed_rows = $client_upload->processed_rows+1;
            $client_upload->save();
        }

        return response([
            'success'  => true,
            'message'  => 'Data uploaded successfully.'
        ], 200);
    }

    public function getValuesAtIndex($arrayOfArrays, $index) {
        return array_map(function ($array) use ($index) {
            return isset($array[$index]) ? $array[$index] : null;
        }, $arrayOfArrays);
    }

    public function arraysHaveSameValueAtIndex($arrayOfArrays, $index) {
        if (count($arrayOfArrays) <= 1) {
            return true;
        }
        $firstArray = reset($arrayOfArrays);
        $expectedValue = $firstArray[$index];

        foreach ($arrayOfArrays as $array) {
            if (!isset($array[$index]) || $array[$index] !== $expectedValue) {
                return false;
            }
        }
        return true;
    }


    public function hasUniqueData($data,$position) {
        $firstObjects = array_map(function ($array) use ($position) {
            return $array[$position];
        }, $data);

        $uniqueFirstObjects = array_unique($firstObjects);

        return count($firstObjects) === count($uniqueFirstObjects);
    }

    public function hasNoBlankEntry($data) {
        foreach ($data as $array) {
            foreach ($array as $value) {
                if (empty($value)) {
                    return false;
                }
            }
        }
        return true;
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

    public function lotStatus(Request $request, $apitoken, $lot_number)
    {
        if (!$this->verifyToken($apitoken)) {
            return response([
                "success"  => false,
                "message"  => 'Authentication Fail'
            ],400);
        }

        $client = User::where('id',$this->id)->first();
        $lot = ClientUpload::where('lot_number',$lot_number)->where('client_id',$this->id)->first();

        if (!$lot) {
            return response([
                "success"  => false,
                "message"  => 'The lot is not with Vendor'
            ],400);
        }

        return response([
            "success"     => true,
            "lot_number"  => $lot->lot_number,
            "date_and_time_received" => date('Y-m-d H:i:s',strtotime($lot->created_at)),
            "date_and_time_ready_at_vendor" => $lot->ready_at?date('Y-m-d H:i:s',strtotime($lot->ready_at)):'',
            "date_and_time_of_dispatch"     => $lot->dispatched_at?date('Y-m-d H:i:s',strtotime($lot->dispatched_at)):'',
            "dispatch_details"              => $lot->dispatch_data??''
        ],200);

    }

    public function deleteLot(Request $request, $apitoken, $lot_number)
    {
        if (!$this->verifyToken($apitoken)) {
            return response([
                "success"  => false,
                "message"  => 'Authentication Fail'
            ],400);
        }

        $client = User::where('id',$this->id)->first();
        $lot = ClientUpload::where('lot_number',$lot_number)->where('client_id',$this->id)->first();

        if (!$lot) {
            return response([
                "success"  => false,
                "message"  => 'Does not exist'
            ],400);
        }

        if ($lot->production_status!='Pending') {
            return response([
                "success"  => false,
                "message"  => 'In Production'
            ],400);
        }

        $batch_assigned = Code::where('upload_id',$lot->id)->whereNotNull('batch_id')->exists();

        if ($batch_assigned) {
            return response([
                "success"  => false,
                "message"  => 'In Production'
            ],400);
        }

        $delete_codes = Code::where('client_id',$this->id)->where('upload_id',$lot->id)->delete();
        $lot->delete();

        return response([
            "success"     => true,
            "message"     => 'Ok'
        ],200);

    }

    public function verifyToken($apitoken)
    {
        $verified = false;
        $client = User::find($this->id);

        if ($client->token && $client->secret_key) {
            $verified = $apitoken==hash('sha224', $client->token.$client->secret_key);
        }

        return $verified;
    }
}
