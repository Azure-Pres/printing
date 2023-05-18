<?php

namespace App\Jobs;

use App\Models\ClientUpload;
use App\Models\Code;
use App\Models\TempCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;

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

        if (!$progress->error_logs) {
            $temp_codes = TempCode::where('upload_id',$progress->id)->get();
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
            $progress->status = '3';
            $progress->save();
        }
    }

    public function failed()
    {
        $progress = ClientUpload::where('client_id',$this->client_id)->where('progress_id',$this->progress_id)->first();
        $progress->status = '3';
        $progress->save();
    }
}
