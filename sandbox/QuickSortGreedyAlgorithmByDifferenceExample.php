<?php

require_once(__DIR__ . "/../../vendor/autoload.php");
function test()
{

    $obj = new PHP_Algorithms\sandbox\QuickSortGreedyAlgorithmByDifference();


    $obj->intialize($breaking_example);
    echo 'Initial Array : ';
    $obj->show();
    $obj->quickSort();
    echo 'Final Array : ';
    $obj->show();
    echo $obj->isSorted();
}


test();
