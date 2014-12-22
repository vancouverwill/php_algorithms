<?php
/**
 *
 * problem : You are a given a UNIMODAL array of n distinct elements, meaning that its
 * entries are in increasing order up until its maximum element, after which its elements
 * are in decreasing order.
 *
 * 1. Give an algorithm to compute the maximum element that runs in O(log n) time.
 *
 * exp array
 * 4 5 6 7 8 9 10 11 12 13 14 15 14 13 12 11 10
 *
 * notes:
 *
 * try and work out constraints
 *
 * - if range hi > lo then we know top is inside range or to right
 * - if range lo > hi then we know top is inside range to to the left
 *
 *
 * Binary Search Pseudo code
 *
 * n = desired number
 * a = sorted array
 *
 * lo = 0
 * hi = count(array) - 1
 *
 * i = n/2
 *
 * while (hi > lo) {
 *  if ( a[i] < n) {
 *      lo = i + 1
 *          i = i + (hi - lo)/2
 *  }
 *  else if (a[i] > n) {
 *      hi = i - 1
 *      i = i - (hi - lo)/2
 *  }
 *  else { return i; }
 * }
 *
 *
 */


function unimodalArrayFindMax($array)
{
    $hiFixed = count($array) - 1;
    $lo = 0;
    $hi = count($array)  - 1;
    while ($hi > $lo) {
        $med = floor(($hi - $lo) / 2) + $lo;
        if ($med < $hiFixed && $array[$med + 1] > $array[$med]) {
            $lo = $med + 1 ;
            $exit = $lo;
        } elseif ($med > 0 && $array[$med - 1] > $array[$med]) {
            $hi = $med - 1;
            $exit = $hi;
        } else {
            return $med;
        }
    }
    return $exit;
}


$risingArray = array(1,2,3,4);
$decreasingArray = array(4,3,2,1);
$middleArray = array(1,2,3,4,3,2,1);
$fiveArray = array(1,2,3,4,5,6,1);
$largeArray = array(7,8,9,200,4000,3000,2000,100,30,7);
$largeArray2 = array(7,8,9,200,4000,6000,10000,5000,100,30,7);
$result = unimodalArrayFindMax($largeArray2);

echo $result;
