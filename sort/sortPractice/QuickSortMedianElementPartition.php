<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-05-21
 * Time: 10:15 PM
 */

class QuickSortMedianElementPartition {

    private $array;
    private     $noComparisons;


    public function __construct($array)
    {
        $this->array = $array;

    }

    public function startSort()
    {
        $this->noComparisons = 0;
        $this->recursiveSort(0, count($this->array) - 1);
    }

    private function recursiveSort($lo, $hi)
    {
        if ($hi <= $lo) return FALSE;

        $arraySize = $hi - $lo + 1;
        $this->noComparisons += ($arraySize - 1);

        $par = $this->partition($lo, $hi);
        $this->recursiveSort($lo, $par - 1);
        $this->recursiveSort($par + 1, $hi);
    }

    private function partition($lo, $hi)
    {
        if (($hi - $lo + 1) % 2 == 0) {
            $median 
        }
        else {
            $median = floor(($hi - $lo + 1)/2) + $lo;
        }
        $this->exch($lo, $median);
        $p = $this->array[$lo];
        $i = $lo + 1;
        $j = $lo + 1;

        while ($j <= $hi) {
            if ($this->array[$j] < $p) {
                $this->exch($j, $i);
                $i++;
            }
            $j++;
        }
        $this->exch($i - 1, $lo);

        return $i - 1;
    }


    private function exch($i, $j)
    {
        $temp = $this->array[$i];
        $this->array[$i] = $this->array[$j];
        $this->array[$j] = $temp;
    }

    public function displayArray()
    {
        echo '<br/>';
        for ($i = 0; $i < count($this->array); $i++) {
            echo $this->array[$i] . ',';
        }
    }

    public function getNoComparisons()
    {
        return $this->noComparisons;
    }
}

function medianTest() {
//$array = array(20, 15, 1, 4, 6, 2);
$array= array(10,20,4,3,5,19,11,12,1,7,8,2);

$sort = new QuickSortLastElementPartition($array);

$sort->displayArray();
echo '<br/>';
$sort->startSort();

echo '<br/>';

$sort->displayArray();
}