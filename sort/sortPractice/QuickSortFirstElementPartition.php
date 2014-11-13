<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-05-17
 * Time: 2:28 PM
 */

class QuickSortFirstElementPartition {
    private     $array;
    private     $noComparisons;

   public function __construct($array)
    {
        $this->array = $array;
    }


    public function initializeSort()
    {
        $this->noComparisons = 0;
        $this->recursiveSort(0, count($this->array) -1);
    }


    private function recursiveSort($lo, $hi)
    {
        if ($hi <= $lo) return FALSE;

        $arraySize = $hi - $lo + 1;
        $this->noComparisons += $arraySize - 1;

        $mid = $this->partition($lo, $hi);
        $this->recursiveSort($lo, $mid);
        $this->recursiveSort($mid + 1, $hi);
    }


    private function partition($lo, $hi)
    {
        $partitionElement = $this->array[$lo];
        $i = $lo + 1;
        $j = $lo + 1;

        while ($j <= $hi) {
            if ($this->array[$j] < $partitionElement) {
                $this->exch( $i, $j);
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
        for ($i = 0; $i < count($this->array); $i++)
        {
            echo $this->array[$i] . ', ';
        }
    }


    public function getNoComparisons()
    {
        return $this->noComparisons;
    }
}

$array= array(10,20,4,3,5,19,11,12,1,7,8,2);

$quickSort = new QuickSortFirstElementPartition($array);

$quickSort->displayArray();

$quickSort->initializeSort();

$quickSort->displayArray();

echo '<br/>';
echo '<br/>';

echo $quickSort->getNoComparisons();
