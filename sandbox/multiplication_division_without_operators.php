<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-04-13
 * Time: 2:50 PM
 */


function multiplicationWithOutOperator($productA, $productB)
{
    $results = 0;
    for($i = 0; $i < $productB; $i++)
    {
        $results += $productA;
    }

    return $results;
}

function recursiveMultiplicationWithOutOperator($productA, $productB)
{
    if ($productB <= 0) return 0;
    $results = recursiveMultiplicationWithOutOperator($productA, $productB - 1);
    $results += $productA;

    return $results;
}

function recursiveDivisionWithOutOperator($numerator, $denominator)
{
    //keep subtracting from $denominator until lower than $denominator
    //pass a counter which is returned as

    if ($numerator < $denominator) return 0;

    $count = recursiveDivisionWithOutOperator($numerator - $denominator, $denominator);
    $count++;

    return $count;
}

//echo multiplicationWithOutOperator(5, 9);
//echo recursiveMultiplicationWithOutOperator(5, 9);

//echo recursiveDivisionWithOutOperator(29, 5, 0);

function  isPalindrome( $a) {
    $aWithOutSpaces = str_replace(" ", "", $a);
    $aWithOutPeriods = str_replace(".", "", $aWithOutSpaces);
    $aLowerCase = strtolower($aWithOutPeriods);

    $a = preg_replace("/[^A-Za-z0-9 ]/", '', $a);

    echo $a;

    if (strrev($aLowerCase) == $aLowerCase) {
        return 1;
    }
    else {
        return 0;
    }
}


echo isPalindrome("A Toyota.");

//function angleBetweenHands( $a) {
//    $array = explode(":", $a);
//    $hours = $array[0];
//    $minutes = $array[1];
//if ($hours > 12) {
//$hours = $hours - 12;
//}
//$hoursDegree = $hours * 30;
//
//$minutesDegree = ($minutes / 60) * 360;
//
//$difference = $hoursDegree - $minutesDegree;
//
//if ($difference < 0) $difference = 360 + $difference;
//
//return $difference;
//
//}

//function angleBetweenHands( $a) {
//    $array = explode(":", $a);
//    $hours = $array[0];
//    $minutes = $array[1];
//    if ($hours > 12) {
//        $hours = $hours - 12;
//    }
//    $hoursDegree = $hours * 30;
//
//    $minutesDegree = ($minutes / 60) * 360;
//
//    if ($hoursDegree > $minutesDegree) {
//        $difference = $hoursDegree - $minutesDegree;
//    }
//    else {
//        $difference =  $minutesDegree - $hoursDegree;
//    }
//
////    if ($difference < 0) $difference = 360 + $difference;
//
//    if ($difference > 180) $difference = 360 - $difference;
//
//    return $difference;
//}
//
//echo angleBetweenHands("21:30");