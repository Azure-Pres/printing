<?php

namespace App\Http\Livewire\Admin\BatchReports;

use Livewire\Component;
use DB;

class Home extends Component
{
    public $batches= [];

    public function render()
    {
        return view('livewire.admin.batch-reports.home');
    }

    public function mount(){
        $client_id = 2;

        $this->batches = DB::select("
            SELECT
            JSON_UNQUOTE(JSON_EXTRACT(code_data, '$.batch_id')) as batch,
            COUNT(*) as total_count,
            SUM(CASE WHEN first_verification_status = 'Success' THEN 1 ELSE 0 END) as first_verified_count,
            SUM(CASE WHEN second_verification_status = 'Success' THEN 1 ELSE 0 END) as second_verified_count
            FROM codes
            WHERE client_id = ?
            GROUP BY batch
            ", [$client_id]);
    }
}
