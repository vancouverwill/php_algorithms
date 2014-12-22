<?php
/**
 *
 * recursively switch the order of an array
 * @param $array
 * @param $lowerPointer
 * @param $higherPointer
 * @return bool
 */
//set counter as half of size of array
//recursive swap first and last
//when 1 or 0 left in between then finished

namespace PHP_Algorithms\sandbox;

function recursiveSwitch($array, $lowerPointer, $higherPointer)
{
    if ($lowerPointer >= $higherPointer) {
        return false;
    }
    $last_element = $array[$higherPointer];
    $array[$higherPointer] = $array[$lowerPointer];
    $array[$lowerPointer] = $last_element;
    $results =  recursiveSwitch($array, $lowerPointer + 1, $higherPointer - 1);

    if ($results != false) {
        $array = $results;
    }
    return $array;
}

$array = array(0,1,2,3,4,5,6,7);

$results = recursiveSwitch($array, 0, count($array) - 1);

var_dump($results);
