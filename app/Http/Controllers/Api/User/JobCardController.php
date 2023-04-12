<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\JobCard\JobCardResource;
use App\Models\JobCard;
use Illuminate\Http\Request;
use Validator;

class JobCardController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $jobcards   = JobCard::getApiJobCardModel($input);
        $response   = JobCardResource::collection($jobcards);

        return response([
            'success'   => true,
            'message'   => 'Jobcards fetched successfully.',
            'jobcards'  => $response
        ], 200);
    }

    public function show($id)
    {
        $jobcard   = JobCard::find($id);

        return response([
            'success'   => true,
            'message'   => 'Jobcard fetched successfully.',
            'jobcard'   => new JobCardResource($jobcard)
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input, [
                'status' => getRule('',true)
            ]);

            if($validator->fails()) {
                return response([
                    'success'   => false,
                    'message'   => 'Invalid given data.',
                    'errors'    => $validator->errors()
                ], 200);
            }else{
                $jobcard= JobCard::find($id);
                $jobcard->print_status = $input['status'];
                $jobcard->save();

                return response([
                    'success'   => true,
                    'message'   => 'Jobcards updated successfully.'
                ], 200);
            }
        }catch(Exception $e){
            return response([
                'success'  => false,
                'message'  => 'Something went wrong.'
            ], 200);
        }
    }
}
