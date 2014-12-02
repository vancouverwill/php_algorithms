<?php
error_reporting(E_ALL);

/**
* @author William Melbourne 
* @source 
*/



function binarySearch($key, $sortedArray)
{
    $array =  $sortedArray;
    $lo = 0;
    $hi = count($array) - 1;
    while ($lo <= $hi) {
        // Key is in a[lo..hi] or not present.
        $mid = $lo + floor(($hi - $lo) / 2);
                    $comparator = $array[$mid];
        if ($key < $comparator) {
                        $hi = $mid - 1;
                    }
        elseif ($key > $comparator) {
                        $lo = $mid + 1;

                    }
        else return $mid;
    }
    return -1; //$key does not exist
}


function binarySearchGreaterThanOrEqual($needle, $sortedArray)
{
    $array =  $sortedArray;
    $lo = 0;
    $hi = count($array) - 1;

    $midPreviousOneStep = null;
    $midPreviousTwoStep = null;

    while ($lo <= $hi) {

        if ($midPreviousOneStep != null) $midPreviousTwoStep = $midPreviousOneStep;
        if (isset($mid)) $midPreviousOneStep = $mid;


        // Key is in a[lo..hi] or not present.
        $mid = $lo + floor(($hi - $lo) / 2);
        $comparator = $array[$mid];
        if ($needle < $comparator) {
            $hi = $mid - 1;
        }
        elseif ($needle > $comparator) {
            $lo = $mid + 1;

        }
        else return $mid;
    }
//    if ($array[$hi + 1] > $needle) return $hi + 1;

    if (isset($array[$hi + 1]) && $array[$hi + 1] > $needle) return $hi + 1;

//    if ($array[$midPreviousOneStep] > $needle) return $midPreviousOneStep;
//    elseif ($array[$midPreviousTwoStep] > $needle) return $midPreviousTwoStep;
    else return -1;
}


function binarySearchLesserThanOrEqual($needle, $sortedArray)
{
    $array =  $sortedArray;
    $lo = 0;
    $hi = count($array) - 1;

    $midPreviousOneStep = null;
    $midPreviousTwoStep = null;

    while ($lo <= $hi) {

        if ($midPreviousOneStep != null) $midPreviousTwoStep = $midPreviousOneStep;
        if (isset($mid)) $midPreviousOneStep = $mid;


        // Key is in a[lo..hi] or not present.
        $mid = $lo + floor(($hi - $lo) / 2);
        $comparator = $array[$mid];
        if ($needle < $comparator) {
            $hi = $mid - 1;
        }
        elseif ($needle > $comparator) {
            $lo = $mid + 1;

        }
        else return $mid;
    }

    if (isset($array[$lo - 1]) && $array[$lo - 1] < $needle) return $lo - 1;
//    if ($array[$midPreviousOneStep] < $needle) return $midPreviousOneStep;
//    elseif ($array[$midPreviousTwoStep] < $needle) return $midPreviousTwoStep;
    else return -1;
}


function exampleUse()
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


//$array = array( 0, 2, 4, 6, 8, 10);
//
//echo binarySearchGreaterThanOrEqual(12, $array);


