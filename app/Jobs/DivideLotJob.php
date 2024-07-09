<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Batch;
use App\Models\Code;

class DivideLotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batch_id;
    protected $divide_in_lot;
    protected $lot_size;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($batch_id, $divide_in_lot, $lot_size)
    {
        $this->batch_id = $batch_id;
        $this->divide_in_lot = $divide_in_lot;
        $this->lot_size = $lot_size;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $batch = Batch::find($this->batch_id);
        if ($this->divide_in_lot == 'Yes') {
            $codes = Code::where('batch_id', $batch->id)->get();
            $lot = 1;
            $lot_s_no = 1;

            foreach ($codes as $code) {
                $code->update([
                    'lot' => $lot,
                    'lot_s_no' => $lot_s_no
                ]);
                if ($this->lot_size == $lot_s_no) {
                    $lot++;
                    $lot_s_no = 0;
                }
                $lot_s_no++;
            }
        } else {
            Code::where('client_id', $batch->client)
            ->where('batch_id', $this->batch_id)
            ->update([
                'lot' => NULL,
                'lot_s_no' => NULL
            ]);
        }
    }
}