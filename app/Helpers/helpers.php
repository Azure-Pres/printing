<?php

use App\CustomClasses\Validations;
use App\Models\ClientUpload;
use App\Models\Code;
use App\Models\UserLog;

if (! function_exists('getRule')) {
	function getRule($name, $required = false, $nullable = false)
	{
		return Validations::getRule($name, $required, $nullable);
	}
}

if (! function_exists('printingMaterial')) {
	function printingMaterial()
	{
		return [
			'PVC'
		];
	}
}

if (! function_exists('uploadStatusText')) {
	function uploadStatusText($status)
	{
		switch ($status) {
			case '1':
			$text = 'Verifying';
			break;
			case '2':
			$text = 'Completed';
			break;
			case '3':
			$text = 'Failed';
			break;			
			default:
			$text = 'Pending';
			break;
		}
		
		return $text;
	}
}

if (! function_exists('getDateWithFormat')) {
	function getDateWithFormat($date) 
	{	
		return date('M d, Y',strtotime($date));
	}
}

if (! function_exists('userlog')) {
	function userlog($action,$description)
	{
		$log  = new UserLog;
		$log->action   = $action;
		$log->user_id  = Auth::id();
		$log->description = json_encode([
			'event' => $description
		]);
		$log->save();
	}
}

if (! function_exists('currentUploadProgresses')) {
	function currentUploadProgresses()
	{
		return ClientUpload::where('client_id',Auth::id())->whereIn('status',['0','1'])->get();
	}
}

if (! function_exists('getSerialNo')) {
	function getSerialNo($upload_id)
	{
		$from = null;
		$to = null;

		$from_code = Code::where('upload_id',$upload_id)->orderBy('serial_no','ASC')->first();
		$to_code = Code::where('upload_id',$upload_id)->orderBy('serial_no','DESC')->first();

		if ($from_code && $to_code) {
			$from = $from_code->serial_no;
			$to = $to_code->serial_no;
		}

		return ['from'=>$from, 'to'=>$to];	
	}
}

