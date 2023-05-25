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

        if ($progress->error_logs!='') {
            $errors = json_decode($progress->error_logs,true);
        }

        if (!empty($unique_fields)) {
            foreach($temp_codes as $key=>$temp_code){
                $code_data = [];

                foreach ($unique_fields as $unique_field) {
                    if (isset(json_decode($temp_code->code_data,true)[$unique_field])) {
                        $code_data[$unique_field] = json_decode($temp_code->code_data,true)[$unique_field];
                    }
                }

                $exists = Code::where('client_id',$this->client_id)->whereJsonContains('code_data',$code_data)->exists();

                if ($exists) {
                    $verified=false;
                    $errors[$key+2] = 'Duplicate data found';
                }
            }
        }

        if ($verified) {
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
            $progress->status = '2';
            $progress->save();
        }else{
            $progress->error_logs = json_encode($errors);
            $progress->status = '3';
            $progress->save();
        }

        $clear = TempCode::where('upload_id',$progress->id)->delete();
    }

    public function failed()
    {
        $progress = ClientUpload::where('client_id',$this->client_id)->where('progress_id',$this->progress_id)->first();
        $progress->status = '3';
        $progress->save();
    }
}
