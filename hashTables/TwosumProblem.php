<?php
/**
 *
 * Variation on the 2 sum  problem.
 * Here we we need to find the number of distinct pairs in the array whose sum lies in a specified array where the total is within a range
 *
 * (x+y=t)  where t is in a range
 *
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 2014-11-27
 * Time: 11:23 PM
 */
namespace PHP_Algorithms\hashTables;

require_once(__DIR__ . "/../sort/QuickSort.php");
require_once(__DIR__ . "/../sandbox/binarySearch.php");



class TwoSumProblem
{
    private $array;
    private $pairCount;

    public function __construct()
    {

    }


    public function run($filename, $lowerRangeLimit, $upperRangeLimit)
    {
        $startTime = microtime(true);

        $handle = fopen($filename, "r");

        $this->array = array();
        $this->pairCount = 0;
        $this->totals = array();

        $count = 0;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $this->array[(int)$line] = (int)$line;
                $count++;
            }
        } else {
            // error opening the file.
            "no file exists";
        }
        fclose($handle);

//        $QuickSort = new QuickSort();
//        $QuickSort->intialize($this->array);
//        $QuickSort->quick_sort();
//
//
//        $sortedArray = $QuickSort->getSortedArray();

        sort($this->array);

        $sortedArray = $this->array;

        $index = 0;
        $sortedIndexedArray = array();
        foreach ($sortedArray as $value) {
            $sortedIndexedArray[$index] = $value;
            $index++;
        }

        foreach ($sortedIndexedArray as $index => $xValue) {
            //  given $xValue + $lowerY = $lowerRangeLimit
            $lowerY = $lowerRangeLimit - $xValue;


            // given $xValue + $upperY = $upperRangeLimit;
            $upperY = $upperRangeLimit - $xValue;


            // look all  Y where      $lowerY <= $this->array[Y] <= $upperY;
            // what is lowerYIndex where is smallest $lowerYIndex such that $this->array[$lowerYIndex] >= $lowerY
            $lowerYIndex = binarySearchGreaterThanOrEqual($lowerY, $sortedIndexedArray);
            if ($lowerYIndex == -1) {
                continue;
            }

            $upperYIndex = binarySearchLesserThanOrEqual($upperY, $sortedIndexedArray);
            if ($upperYIndex == -1) {
                continue;
            }

            if ($index >= $lowerYIndex) {
                ($lowerYIndex = $index + 1);
            }

            if ($lowerYIndex > $upperYIndex) {
                continue;
            }
            $this->pairCount += $upperYIndex - $lowerYIndex + 1;

            for ($i = $lowerYIndex; $i <= $upperYIndex; $i++) {
                $this->totals[$xValue + $sortedIndexedArray[$i]] = true;
            }
        }

        echo count($this->array);
        echo PHP_EOL;
        echo PHP_EOL;
        echo $this->pairCount;
        echo PHP_EOL;
        echo PHP_EOL;
        echo count($this->totals);
        echo PHP_EOL;
        echo PHP_EOL;


        $endTime = microtime(true);

        $timeDifference = $endTime - $startTime;

        echo PHP_EOL . PHP_EOL . "TimeDifference " . $timeDifference;
        echo PHP_EOL . PHP_EOL . "Start Time " . $startTime;
        echo PHP_EOL . PHP_EOL . "End Time " . $endTime . PHP_EOL . PHP_EOL;
    }
}

$TwoSumProblem = new TwoSumProblem();

$TwoSumProblem->run("algoProgramming_prob2sum.txt", -10000, 10000);   // rows 999752 pairs 50195
//$TwoSumProblem->run("2sumDataTestSet1.txt", -10000, 10000);
//$TwoSumProblem->run("2sumDataTestSet2.txt", -10000, 10000);
//$TwoSumProblem->run("2sumDataTestSet3.txt", -10000, 10000);
