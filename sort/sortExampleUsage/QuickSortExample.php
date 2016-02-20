<?php

require_once(__DIR__ . "/../../vendor/autoload.php");
function test()
{

    $obj = new PHP_Algorithms\sort\QuickSort();

    $sample_array = array(5, 3, 5, 1, 4, 6 ,9, 7, 5);
    $array_full = array( 25, 37, 45, 84, 74, 16, 99, 64, 15, 14, 26, 43);
    $array_full2 = array (25, 37, 45, 84, 74, 16, 99, 64, 15, 14, 26, 43);
    $array_short = array( 25, 37, 45, 84, 74);
    $array_short = array( 74, 37, 45, 84, 25);



    $working_short1 = array( 45, 99, 64);
    $working_short2 = array( 99, 45, 64);
    $working_short3 = array( 99, 64, 45);

    $arrayEqual = array(1, 0, 0, 0, 0);
    $breaking_example = array(84, 99, 64, 37, 45);


    $obj->intialize($arrayEqual);

    echo 'Initial Array : ';
    $obj->show();
    $obj->quickSort();
    echo 'Final Array : ';
    $obj->show();
    echo $obj->isSorted();
}


test();
