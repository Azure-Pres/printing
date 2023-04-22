<?php

use App\CustomClasses\Validations;
use App\Models\UserLog;
use App\Models\ClientUpload;

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
			$text = 'In Progress';
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

