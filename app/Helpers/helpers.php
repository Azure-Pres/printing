<?php

use App\CustomClasses\Validations;


if (! function_exists('getRule')) {
	function getRule($name, $required = false, $nullable = false)
	{
		return Validations::getRule($name, $required, $nullable);
	}
}
