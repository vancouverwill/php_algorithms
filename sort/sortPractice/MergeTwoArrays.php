<?php

/**
 * super simple usage of the last part of the mergeSort recursive function i.e. merge()
 */

$arrayI = array(0, 2, 4, 6, 8);
$arrayJ = array(0, 1, 3, 5, 7);


$final_array = array();



$i = 0;
$j = 0;

show($final_array);

for ($k = 0; $k < count($arrayI) + count($arrayJ); $k++) {
    if ($i >= count($arrayI)) {
        $final_array[$k] = $arrayJ[$j++];
    } elseif ($j >= count($arrayJ))
        $final_array[$k] = $arrayI[$i++];
    elseif ($arrayI[$i] < $arrayJ[$j]) {
        $final_array[$k] = $arrayI[$i++];
    } else {
        $final_array[$k] = $arrayJ[$j++];
    }
}
echo 'finished' . PHP_EOL;

show($final_array);



function show($array)
{
    foreach ($array as $key => $item) {
        echo $item . " ";
    }
}
