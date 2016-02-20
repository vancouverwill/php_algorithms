<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 16-02-20
 * Time: 11:48 AM
 */


function angleBetweenHands( $a) {
    $array = explode(":", $a);
    $hours = $array[0];
    $minutes = $array[1];
if ($hours > 12) {
$hours = $hours - 12;
}
$hoursDegree = $hours * 30;

$minutesDegree = ($minutes / 60) * 360;

$difference = $hoursDegree - $minutesDegree;

if ($difference < 0) $difference = 360 + $difference;

return $difference;

}

function angleBetweenHandsAttempt2( $a) {
    $array = explode(":", $a);
    $hours = $array[0];
    $minutes = $array[1];
    if ($hours > 12) {
        $hours = $hours - 12;
    }
    $hoursDegree = $hours * 30;

    $minutesDegree = ($minutes / 60) * 360;

    if ($hoursDegree > $minutesDegree) {
        $difference = $hoursDegree - $minutesDegree;
    }
    else {
        $difference =  $minutesDegree - $hoursDegree;
    }

//    if ($difference < 0) $difference = 360 + $difference;

    if ($difference > 180) $difference = 360 - $difference;

    return $difference;
}

//echo angleBetweenHands("21:30");
