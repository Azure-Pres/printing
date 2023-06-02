<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;

class ScanCodeController extends Controller
{
    public function index(Request $request)
    {
        // try{
            $input = $request->all();
            $validator = Validator::make($input, [
                'scan_code' => getRule('',true)
            ]);

            if($validator->fails()) {
                return response([
                    'success'   => false,
                    'message'   => 'Invalid given data.',
                    'errors'    => $validator->errors()
                ], 200);
            }else{

                $scan_code = $input['scan_code'];
                $code = Code::whereJsonContains('code_data', ['upi_qr_url'=>$scan_code])->orderBy('created_at','DESC')->first();

                if (!$code) {
                    return response([
                        'success'   => false,
                        'message'   => 'Invalid scan code.'
                    ], 200);
                }

                $result = [];
                $code_data = json_decode($code->code_data,true);

                if (isset($code_data['batch_id'])) {
                    $result['batch'] = $code_data['batch_id'];
                }

                if (isset($code_data['sku_id'])) {
                    $result['pid'] = $code_data['sku_id'];
                }

                if (isset($code_data['date'])) {
                    // $result['month'] = date("M'Y",strtotime($code_data['date']));
                }
                $result['month'] = date("M'Y",strtotime("01-June-2023"));

                if (isset($code_data['material_name'])) {
                    $result['material_type'] = $code_data['material_name'];

                    $broken = str_split($code_data['material_name'],50);

                    $result['field_one'] = isset($broken[0])?trim($broken[0]):'';
                    $result['field_two'] = isset($broken[1])?trim($broken[1]):'';
                    $result['field_three'] = isset($broken[2])?trim($broken[2]):'';
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

    public $client_id = 4;

    // public function duplicate()
    // {

    //     $client = User::find($this->client_id);
    //     $unique_fields = [];
    //     $verified=true;

    //     foreach ($client->getClientAttributes as $attr_key => $client_attribute) {
    //         if($client_attribute->unique=='1'){
    //             array_push($unique_fields, $client_attribute->getCodeAttribute->name);
    //         }
    //     }

    //     if (!empty($unique_fields)) {

    //         $sqlQuery = 'select id,dup_count,dup_value
    //         from (select id,json_extract(`code_data`,"$.'.$unique_fields[0].'") as dup_v
    //         from codes where client_id = '.$this->client_id.') t1 
    //         join
    //         (select count(id) dup_count, json_extract(`code_data`,"$.'.$unique_fields[0].'") as dup_value
    //         from codes where client_id = '.$this->client_id.'
    //         group by json_extract(`code_data`,"$.'.$unique_fields[0].'") 
    //         having dup_count>1) t2
    //         on t1.dup_v=t2.dup_value';

    //         $count = count(DB::select(DB::raw($sqlQuery)));

    //         if ($count>0) {
    //             $verified=false;
    //         }
    //     }
    // }
}
