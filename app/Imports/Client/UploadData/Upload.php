<?php

namespace App\Imports\Client\UploadData;

use App\Jobs\TransferJob;
use App\Models\ClientUpload;
use App\Models\Code;
use App\Models\TempCode;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Str;
use Throwable;
use Illuminate\Support\Facades\Bus;

class Upload implements
ToArray,
WithHeadingRow,
SkipsOnError,
SkipsOnFailure,
WithChunkReading,
ShouldQueue,
WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public function  __construct($data)
    {
        $this->client_id       = $data['client_id'];
        $this->progress_id     = $data['progress_id'];
    }

    public function array(array $array)
    {
        $progress = ClientUpload::where('client_id',$this->client_id)->where('progress_id',$this->progress_id)->first();

        foreach ($array as $key => $row) {

            try{
                $collect = [
                    'code_data'           => json_encode($row),
                    'upload_id'           => $progress->id
                ];
                TempCode::create($collect);
                $progress->uploaded_rows = $progress->uploaded_rows+1;
            }catch(Exception $e){
            }

            $progress->processed_rows = $progress->processed_rows+1;
            $progress->save();
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 10000;
    }

    public static function afterImport(AfterImport $event)
    {
        $thisobj  = $event->getConcernable();

        $transfer_data = [
            'client_id' => $thisobj->client_id,
            'progress_id' => $thisobj->progress_id
        ];

        $progress = ClientUpload::where('client_id',$thisobj->client_id)->where('progress_id',$thisobj->progress_id)->first();
        $progress->status = '1';
        $progress->save();

        Bus::batch([
            new TransferJob($transfer_data),
        ])->dispatch();
    }

}
