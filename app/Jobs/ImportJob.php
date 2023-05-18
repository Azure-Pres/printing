<?php

namespace App\Jobs;

use App\Imports\Client\UploadData\Upload as UploadCode;
use App\Models\ClientUpload;
use Excel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ImportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $uploadFile;
    public $client_id;
    public $progress_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->uploadFile = $data['file_path'];
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
        $import_data = [
            'client_id'   => $this->client_id,
            'progress_id' => $this->progress_id
        ];

        Excel::import(new UploadCode($import_data), $this->uploadFile);
    }

    public function failed()
    {
        $progress = ClientUpload::where('client_id',$this->client_id)->where('progress_id',$this->progress_id)->first();
        $progress->status = '3';
        $progress->save();
    }
}
