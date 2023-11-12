<?php

function pre($str) {
	echo '<pre>';
	print_r($str);
	echo '</pre>';
}

function pred($str) {
	echo '<pre>';
	print_r($str);
	echo '</pre>';
	die;
}

if (!function_exists('calculatePercentageDifference')) {
    function calculatePercentageDifference($value1, $value2)
    {
        if ($value1 == 0) {
            return $value2 == 0 ? 0 : 100;
        }

        return (($value2 - $value1) / $value2) * 100;
    }
}

?>