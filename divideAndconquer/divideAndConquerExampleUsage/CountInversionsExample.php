<?php

require_once("../../vendor/autoload.php");

$array= array(6,3,5,2,4,1);

$CountInversions = new PHP_Algorithms\divideAndConquer\CountInversions();
$CountInversions->countSortInit($array);

var_dump($CountInversions->getTotal());


@set_time_limit(60*60*24);

$integerArray = array();
//$handle = fopen("IntegerArray.txt", "r");
$handle = fopen("IntegerArrayVerySmall.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $integerArray[] = (int)$line;
    }
} else {
    // error opening the file.
}
fclose($handle);


$CountInversions = new PHP_Algorithms\divideAndConquer\CountInversions();
$CountInversions->countSortInit($integerArray);

var_dump($CountInversions->getTotal());

$CountInversions = new PHP_Algorithms\divideAndConquer\CountInversions();
$CountInversions->countSortInit(array(1, 0, 0, 0, 0, 0));
var_dump($CountInversions->getTotal());

$CountInversions = new PHP_Algorithms\divideAndConquer\CountInversions();
$CountInversions->countSortInit(array(0, 0, 0, 0, 0,));
var_dump($CountInversions->getTotal());


$CountInversions = new PHP_Algorithms\divideAndConquer\CountInversions();
$CountInversions->countSortInit(array(1, 2, 3, 4, 5));
var_dump($CountInversions->getTotal());


