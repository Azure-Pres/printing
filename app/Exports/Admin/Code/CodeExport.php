<?php

namespace App\Exports\Admin\Code;

use App\Models\Code;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class CodeExport implements FromView
{
	public function __construct($job_card,$codes_per_sheet){
		$this->job_card = $job_card;
		        $this->codes_per_sheet = $codes_per_sheet;
	}

	public function view(): View
	{
		$codes = Code::where('batch_id', $this->job_card->batch_id)->get();

		$client = User::with('getClientAttributes')
		->find($this->job_card->getBatch->client);

		$sheet_no = 1;
		$count = 1;

		if ($this->codes_per_sheet) {
			foreach ($codes as $code) {
				$decodedCodeData = json_decode($code->code_data, true);
				$decodedCodeData['sheet_no'] = $sheet_no;
				$code->code_data = json_encode($decodedCodeData);
				$code->save();

				if ($count < $this->codes_per_sheet) {
					$count++;
				} else {
					$sheet_no++;
					$count = 1;
				}
			}
		}

		return view('livewire.admin.exports.codes')
		->with('codes', $codes)
		->with('client', $client)
		->with('job_card', $this->job_card)
		->with('codes_per_sheet', $this->codes_per_sheet);
	}
}
