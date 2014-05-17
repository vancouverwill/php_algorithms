<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-05-04
 * Time: 8:13 PM
 *
 *
 * Binary Search Psuedo code
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
 * }
 * else if (a[i] > n) {
 *      hi = i - 1
 *      i = i - (hi - lo)/2
 * }
 * else { break; }
 * }
 *
 * problem : You are a given a unimodal array of n distinct elements, meaning that its
 * entries are in increasing order up until its maximum element, after which its elements
 * are in decreasing order. Give an algorithm to compute the maximum element that runs in O(log n) time.
 *
 *
 *
 * 4 5 6 7 8 9 10 11 12 13 14 15 14 13 12 11 10
 *
 * set Mid as (hi - lo) / 2
 * topCheck = (hi - mid) /2 + mid
 * botCheck = (mid - lo) / 2
 *
 *
 * while() {
 * topCheck = (hi - mid) /2 + mid
 * botCheck = (mid - lo) / 2
 * if mid == n break
 *  topComparison = a[topCheck] - num;
 *
 *  botComparison = a[botCheck] - num;
 * if topComparison < botComparison {
 *  lo = mid
 * mid = topCheck
 * }
 *
 *
 *
 * }
 *
 */

class UnimodalBinarySearch {

} 