<?php

function add($string)
{
    $pattern = '/[;,\r\n]/';

    $array = preg_split($pattern, $string);
    $checkEmpty = array_filter($array);
    //Check Empty string
    if (empty($checkEmpty)) {
        return 0;
    }
    //Count negative numbers
    $returnValue['negative'] = array_filter($array, function ($value) {return $value < 0;});
    //Count Empty values
    $returnValue['emptyvalues'] =array_filter($array, function($x) { return empty($x); });
    //Calculate the sum
    $returnValue['sum'] = array_sum(array_filter($array, 'is_numeric'));
    return $returnValue;
}

$result = add("1\n2,3");

try {
    if ($result == 0) {
        throw new Exception("Empty string");
    }
    if (isset($result['emptyvalues']) && count($result['emptyvalues'])>=1) {
        throw new Exception("input is NOT ok");
    }
    if (isset($result['negative']) && count($result['negative']) == 1) {
        throw new Exception("negatives not allowed");
    } elseif (isset($result['negative']) && count($result['negative']) == 1) {
        throw new Exception("negatives not allowed =" . implode(",", $result['negative']));
    }
    if (isset($result['sum'])) {
        echo "Output: ".$result['sum'];
    }

} //catch exception
catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

