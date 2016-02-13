<?php



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
        } elseif ($key > $comparator) {
                        $lo = $mid + 1;

        } else {
            return $mid;
        }
    }
    return -1; //search $key does not exist
}


/**
 *
 * find the first number greater than or equal to the need in the sortedArray
 *
 * @param $needle
 * @param $sortedArray
 * @return int
 */
function binarySearchGreaterThanOrEqual($needle, $sortedArray)
{
    $array =  $sortedArray;
    $lo = 0;
    $hi = count($array) - 1;

    while ($lo <= $hi) {
        // Key is in a[lo..hi] or not present.
        $mid = $lo + floor(($hi - $lo) / 2);
        $comparator = $array[$mid];
        if ($needle < $comparator) {
            $hi = $mid - 1;
        } elseif ($needle > $comparator) {
            $lo = $mid + 1;

        } else {
            return $mid;
        }
    }

    if (isset($array[$hi + 1]) && $array[$hi + 1] > $needle) {
        return $hi + 1;
    } else {
        return -1;
    }
}


function binarySearchLesserThanOrEqual($needle, $sortedArray)
{
    $array =  $sortedArray;
    $lo = 0;
    $hi = count($array) - 1;

    while ($lo <= $hi) {
        // Key is in a[lo..hi] or not present.
        $mid = $lo + floor(($hi - $lo) / 2);
        $comparator = $array[$mid];
        if ($needle < $comparator) {
            $hi = $mid - 1;
        } elseif ($needle > $comparator) {
            $lo = $mid + 1;

        } else {
            return $mid;
        }
    }

    if (isset($array[$lo - 1]) && $array[$lo - 1] < $needle) {
        return $lo - 1;
    } else {
        return -1;
    }
}
