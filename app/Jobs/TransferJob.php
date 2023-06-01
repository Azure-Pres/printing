<?php

namespace App\Jobs;

use App\Models\ClientUpload;
use App\Models\Code;
use App\Models\TempCode;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class TransferJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $client_id;
    public $progress_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->client_id = $data['client_id'];
        $this->progress_id = $data['progress_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $progress = ClientUpload::where('client_id',$this->client_id)->where('progress_id',$this->progress_id)->first();

        $temp_codes = TempCode::where('upload_id',$progress->id)->get();
        $verified = true;

        $client = User::find($this->client_id);
        $unique_fields = [];

        foreach ($client->getClientAttributes as $attr_key => $client_attribute) {
            if($client_attribute->unique=='1'){
                array_push($unique_fields, $client_attribute->getCodeAttribute->name);
            }
        }

        $errors = [];

        // if ($progress->error_logs!='') {
        //     $errors = json_decode($progress->error_logs,true);
        // }


        $count = Code::where('client_id',$this->client_id)->count();
        foreach ($temp_codes as $key => $temp_code) {
            $count = $count+1;
            $collect = [
                'client_id'           => $this->client_id,
                'code_data'           => $temp_code->code_data,
                'serial_no'           => $count,
                'upload_id'           => $progress->id
            ];
            Code::create($collect);
        }


        if (!empty($unique_fields)) {
            foreach ($unique_fields as $unique_field) {

                $sqlQuery = 'select id,dup_count,dup_value
                from (select id,json_extract(`code_data`,"$.'.$unique_field.'") as dup_v
                from codes where client_id = '.$this->client_id.') t1 
                join
                (select count(id) dup_count, json_extract(`code_data`,"$.'.$unique_field.'") as dup_value
                from codes where client_id = '.$this->client_id.'
                group by json_extract(`code_data`,"$.'.$unique_field.'") 
                having dup_count>1) t2
                on t1.dup_v=t2.dup_value';

                $count = count(DB::select(DB::raw($sqlQuery)));

                if ($count>0) {
                    $verified=false;
                }
            }
        }

        if ($verified) {
            $progress->status = '2';
            $progress->save();
        }else{
            $delete = Code::where('client_id',$this->client_id)->where('upload_id',$progress->id)->delete();
            $errors = ['error' => 'Duplicate Data Found !'];
            $progress->error_logs = json_encode($errors);
            $progress->status = '3';
            $progress->save();
        }

        $clear = TempCode::where('upload_id',$progress->id)->delete();
    }

    public function failed()
    {
        $clear = TempCode::where('upload_id',$progress->id)->delete();
        $delete = Code::where('client_id',$this->client_id)->where('upload_id',$progress->id)->delete();
        $progress = ClientUpload::where('client_id',$this->client_id)->where('progress_id',$this->progress_id)->first();
        $progress->status = '3';
        $progress->save();
    }
}
