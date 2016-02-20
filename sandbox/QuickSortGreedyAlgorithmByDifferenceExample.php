<?php

require_once(__DIR__ . "/../vendor/autoload.php");
function test()
{

    $obj = new PHP_Algorithms\sandbox\QuickSortGreedyAlgorithmByRatio();

    $sample = array(
        array("id" => 1, "weight" => 20, "length" => 10),
        array("id" => 2, "weight" => 40, "length" => 10),
        array("id" => 3, "weight" => 20, "length" => 50),
    );

    $obj->intialize($sample);
    echo 'Initial Array : ';
    var_dump($obj->getArray());
    $obj->quickSort();
    var_dump($obj->getArray());


    echo $obj->calculateTotalCompletionTime();
}


function calculateTotalCompletionTime($array)
{
    $total = 0;

    foreach ($array as $value) {
        $total += $value["weight"] * $value["length"];
    }
    return $total;
}

test();


