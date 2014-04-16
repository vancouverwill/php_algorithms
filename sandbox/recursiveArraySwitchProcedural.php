<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-04-11
 * Time: 10:50 PM
 */

//set counter as half of size of array
//recursive swap first and last
//when 1 or 0 left in between then finished




function recursiveSwitch($array, $lowerPointer, $higherPointer)
{
    if ($lowerPointer >= $higherPointer) return FALSE;
    $last_element = $array[$higherPointer];
    $array[$higherPointer] = $array[$lowerPointer];
    $array[$lowerPointer] = $last_element;
    $results =  recursiveSwitch($array, $lowerPointer + 1, $higherPointer - 1);

    if ($results != FALSE) {
        $array = $results;
    }
    return $array;
}

$array = array(0,1,2,3,4,5,6,7);

$results = recursiveSwitch($array, 0, count($array) - 1);

var_dump($results);
