<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\BatchPrint;
use App\Models\Code;
use App\Models\TemporaryData;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;
use App\Models\Verification;
use App\Models\OfflineVerification;

class ScanCodeController extends Controller
{
    public function index(Request $request)
    {
        // try{
        $input = $request->all();
        $validator = Validator::make($input, [
            'scan_code' => getRule('', true)
        ]);

        if ($validator->fails()) {
            return response([
                'success'   => false,
                'message'   => 'Invalid given data.',
                'errors'    => $validator->errors()
            ], 200);
        } else {

            $scan_code = $input['scan_code'];
            
            // $code = Code::whereJsonContains('code_data', ['upi_qr_url' => $scan_code])->orderBy('created_at', 'DESC')->first();

            $query = "
            SELECT id, code_data, client_id
            FROM codes
            WHERE client_id = ?
            AND (
                JSON_UNQUOTE(JSON_EXTRACT(code_data, '$.upi_qr_url')) = ?
                )
            limit 1";

            $code = DB::selectOne($query, ["4",$scan_code]);

            if (!$code) {
                return response([
                    'success'   => false,
                    'message'   => 'Invalid scan code.'
                ], 200);
            }

            $result = [];
            $code_data = json_decode($code->code_data, true);

            if (isset($code_data['batch_id'])) {
                $result['batch'] = $code_data['batch_id'];
                $check = BatchPrint::where('batch', $code_data['batch_id'])->exists();

                if ($check) {
                    return response([
                        'success'   => false,
                        'message'   => 'Duplicate print is not allowed.'
                    ], 400);
                }
            }

            if (isset($code_data['sku_id'])) {
                $result['pid'] = $code_data['sku_id'];
            }

            if (isset($code_data['wh'])) {
                $result['wh'] = $code_data['wh'];
            }

            $result['month'] = date("M'Y");

            if (isset($code_data['order_date'])) {
                $result['month'] = $code_data['order_date'];
            }

            if (isset($code_data['material_name'])) {
                $result['material_type'] = $code_data['material_name'];

                $broken = str_split($code_data['material_name'], 50);

                $result['field_one'] = isset($broken[0]) ? trim($broken[0]) : '';
                $result['field_two'] = isset($broken[1]) ? trim($broken[1]) : '';
                $result['field_three'] = isset($broken[2]) ? trim($broken[2]) : '';
            }

            if (isset($code_data['lot_no'])) {
                $result['lot_no'] = $code_data['lot_no'];
            }

            return response([
                'success'   => true,
                'message'   => 'Code fetched successfully.',
                'code_data' => $result
            ], 200);
        }
        // }catch(Exception $e){
        //     return response([
        //         'success'  => false,
        //         'message'  => 'Something went wrong.'
        //     ], 200);
        // }
    }

    public function updateBatchPrint(Request $request)
    {
        // try{
        $input = $request->all();
        $validator = Validator::make($input, [
            'batch' => getRule('', true)
        ]);

        if ($validator->fails()) {
            return response([
                'success'   => false,
                'message'   => 'Invalid given data.',
                'errors'    => $validator->errors()
            ], 200);
        } else {

            $batch = $input['batch'];
            $store = BatchPrint::create(['batch' => $input['batch']]);

            return response([
                'success'   => true,
                'message'   => 'Batch updated successfully.'
            ], 200);
        }
        // }catch(Exception $e){
        //     return response([
        //         'success'  => false,
        //         'message'  => 'Something went wrong.'
        //     ], 200);
        // }
    }

    public function markSuccess()
    {
        $old_codes = TemporaryData::orderBy('id', 'DESC')->whereNull('updated')->get();

        foreach ($old_codes as $key => $old_code) {
            $code = Code::where('client_id', 5)->orderBy('created_at', 'DESC')->whereJsonContains('code_data', ['qr_text' => $old_code->result])->first();

            if ($code) {
                $code->first_verification_status = 'Success';
                $code->second_verification_status = 'Success';
                $code->save();

                $old_code->updated = 'Yes';
                $old_code->save();

                $online = Verification::where('code_id', $code->id)->first();

                if (!$online) {
                    $online = new Verification;
                    $online->code_id = $code->id;
                    $online->code_data = $old_code->result;
                    $online->client_id = 5;
                    $online->scanned_by = 1;
                    $online->message = 'Verified';
                    $online->status = 'Success';
                    $online->save();
                }

                $offline = OfflineVerification::where('code_id', $code->id)->first();

                if (!$offline) {
                    $offline = new OfflineVerification;
                    $offline->code_id = $code->id;
                    $offline->code_data = $old_code->result;
                    $offline->client_id = 5;
                    $offline->scanned_by = 1;
                    $offline->message = 'Verified';
                    $offline->status = 'Success';
                    $offline->save();
                }

            }
        }

        return response([
            'message' => 'Successfully updated.'
        ],200);
    }

    public function serialUpdate()
    {
        $codesToUpdate = Code::where('upload_id','')->where('client_id',4)->orderBy('serial_no','ASC')->get();

        // $startingSerialNo = ''; 

        foreach ($codesToUpdate as $code) {
            ++$startingSerialNo;            
            $code->serial_no = $startingSerialNo;
            $code->save();
        }

        return response([
            'message' => 'Successfully updated.'
        ],200);
    }

    public function updateSerialNumbers()
    {
        $startSerialNo = 3568010;
        $endSerialNo = 3568244;

        $recordsToUpdate = Code::where('serial_no', '>=', $startSerialNo)
        ->where('serial_no', '<=', $endSerialNo)
        ->get();

        $currentSerialNo = $startSerialNo;

        foreach ($recordsToUpdate as $record) {
            $record->serial_no = $currentSerialNo;
            $record->save();

            $currentSerialNo++;
        }

        return "Serial numbers updated successfully.";
    }
}