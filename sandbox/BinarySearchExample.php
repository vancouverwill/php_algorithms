<?php


function exampleBinarySearchUse()
{
    $array = array( 0, 1 , 1, 2, 3, 5, 8, 13, 21, 34, 55, 89);

    $result = binarySearch(34, $array);

    echo $result;

    $array = array( 0, 2, 4, 6, 8, 10);

    echo binarySearchGreaterThanOrEqual(7, $array);
    echo "<br/>";
    echo binarySearchGreaterThanOrEqual(8, $array);
    echo "<br/>";
    echo binarySearchLesserThanOrEqual(8, $array);
    echo "<br/>";
    echo binarySearchLesserThanOrEqual(7, $array);

}


exampleBinarySearchUse();
