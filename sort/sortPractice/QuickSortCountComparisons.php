<?php
require_once("./QuickSortFirstElementPartition.php");
require_once("./QuickSortLastElementPartition.php");
require_once("./QuickSortMedianElementPartition.php");


$REQUEST_URI = $_SERVER['REQUEST_URI'];

$pathVariables = explode("/", $REQUEST_URI);

$lastElementInArray = $pathVariables[count($pathVariables) - 1];

if (strpos($lastElementInArray, "?") != false) {
    $lastElementInArrayWithoutGetVariables = explode("?", $lastElementInArray)[0];
} else {
    $lastElementInArrayWithoutGetVariables = $lastElementInArray;
}


var_dump($lastElementInArrayWithoutGetVariables);


$handle = fopen($lastElementInArrayWithoutGetVariables, "r");

$unsortedArray = array();

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $unsortedArray[] = (int)$line;

    }
} else {
    // error opening the file.
    "no file exists";
}
fclose($handle);


$quickSort = new QuickSortFirstElementPartition($unsortedArray);

//$quickSort->displayArray();

$quickSort->startSort();

//$quickSort->displayArray();

var_dump($quickSort->getNoComparisons());




$quickSortLAst = new QuickSortLastElementPartition($unsortedArray);

//$quickSortLAst->displayArray();

$quickSortLAst->startSort();

//$quickSortLAst->displayArray();

var_dump($quickSortLAst->getNoComparisons());



$quickSortMedian = new QuickSortMedianElementPartition($unsortedArray);

//$quickSortMedian->displayArray();

$quickSortMedian->startSort();

//$quickSortMedian->displayArray();

var_dump($quickSortMedian->getNoComparisons());
