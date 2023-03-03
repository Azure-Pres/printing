<?php

use App\CustomClasses\Validations;


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
