<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-20
 * Time: 8:47 PM
 */
 


$twentyFourChooseOne = array();

$bits = 24;

for ($i = 0; $i < $bits; $i ++) {
    $number = '';
    $x = 0;

    while ($x < $bits) {
        if ($x == $i) {
            $number .= 1;
        }
        else {
            $number .= 0;
        }
        $x++;
    }

    $twentyFourChooseOne[] = $number;
}

var_dump($twentyFourChooseOne);


$twentyFourChooseTwo = array();


for ($i = 0; $i < $bits; $i ++) {
    for ($j = $i + 1; $j < $bits; $j ++) {

        $number = '';
        $x = 0;

        while ($x < $bits) {
            if ($x == $i || $x == $j) {
                $number .= 1;
            }
            else {
                $number .= 0;
            }
            $x++;
        }

    $twentyFourChooseTwo[] = $number;
    }
}

var_dump($twentyFourChooseTwo);
$twentyFourChooseOnePlustwentyFourChooseTwo = array_merge($twentyFourChooseOne, $twentyFourChooseTwo);

var_dump($twentyFourChooseOnePlustwentyFourChooseTwo);

$testNumbers = array();

foreach ($testNumbers AS $testNumber) {
    foreach ($twentyFourChooseOnePlustwentyFourChooseTwo AS $hammingDistance) {
        $requiredNumber = $hammingDistance ^ $testNumber;
        if (in_array($requiredNumber, $testNumbers)) {
                // this is what we are looking for
        }
    }
}