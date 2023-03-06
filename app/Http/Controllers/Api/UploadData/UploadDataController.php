<?php

namespace App\Http\Controllers\Api\UploadData;

use App\Http\Controllers\Controller;
use App\Models\ClientUpload;
use App\Models\Code;
use Auth;
use Illuminate\Http\Request;
use Validator;

class UploadDataController extends Controller
{

    public function store(Request $request)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input, $this->dataRules());

            if($validator->fails()) {
                return response([
                    'success'   => false,
                    'message'   => 'Invalid given data.',
                    'errors'    => $validator->errors()
                ], 200);
            }else{

                $client_upload = new ClientUpload;
                $client_upload->client_id  = Auth::id();
                $client_upload->lot_number = $input['lot_number'];
                $client_upload->lot_size   = $input['lot_size'];
                $client_upload->category   = $input['category'];
                $client_upload->progress_id= $progress_id = uniqid();;
                $client_upload->total_rows = count($input['data']);
                $client_upload->status     = '2';
                $client_upload->save();

                foreach ($input['data'] as $key => $row) {

                    try{
                        $collect = [
                            'client_id'           => Auth::id(),
                            'code_data'           => json_encode($row),
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
        }catch(Exception $e){
            return response([
                'success'  => false,
                'message'  => 'Something went wrong.'
            ], 200);
        }
    }

    public function dataRules()
    {
        $rules = [
            'lot_number' => getRule('',true),
            'lot_size'   => getRule('quantity',true),
            'category'   => getRule('',true),
            'data'       => getRule('',true),
        ];

        $client = Auth::user();

        foreach ($client->getClientAttributes as $key => $client_attribute) {
            $rules ['data.*.'.$client_attribute->getCodeAttribute->name] = getRule('',true);

            if($client_attribute->unique=='1'){
                $rules ['data.*.'.$client_attribute->getCodeAttribute->name] = getRule('',true).'|unique:codes,code_data->'.$client_attribute->getCodeAttribute->name;                
            }
        }

        return $rules;
    }
}
