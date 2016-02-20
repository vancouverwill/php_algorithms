<?php

function findPair($sortedArray, $desiredNumber)
{
    $lo = 0;
    $hi = count($sortedArray) - 1;

//    for ($lo < count($desiredNumber - 1); $hi >= 0;) {
    for ($lo < (count($sortedArray) - 1); $hi >= 0;) {
        if ($sortedArray[$lo] + $sortedArray[$hi] > $desiredNumber) {
            $hi--;
        } elseif ($sortedArray[$lo] + $sortedArray[$hi] < $desiredNumber) {
            $lo++;
        } else {
            break;
        }
    }

    echo 'lo:' . $lo . ' .hi:' . $hi;
}


$sortedArray = array(0, 4, 6, 9, 13, 17, 24, 32);
$desiredNumber = 30;
echo findPair($sortedArray, $desiredNumber);



$sortedArray = array(0, 4, 6, 9, 13, 17, 24, 32);
$desiredNumber = 49;

echo findPair($sortedArray, $desiredNumber);
