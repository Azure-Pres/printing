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
        $client_id = 8;

        $this->batches = DB::select("
            SELECT
            JSON_VALUE(c.code_data, '$.batch_id') as batch,
            JSON_VALUE(c.code_data, '$.language') as language,
            cu.file_name,
            COUNT(*) as total_count,
            SUM(CASE WHEN c.first_verification_status = 'Success' THEN 1 ELSE 0 END) as first_verified_count,
            SUM(CASE WHEN c.second_verification_status = 'Success' THEN 1 ELSE 0 END) as second_verified_count
            FROM codes c
            JOIN client_uploads cu ON c.upload_id = cu.id
            WHERE c.client_id = ?
            GROUP BY JSON_VALUE(c.code_data, '$.batch_id'), JSON_VALUE(c.code_data, '$.language'), cu.file_name
            ", [$client_id]);
    }
}
