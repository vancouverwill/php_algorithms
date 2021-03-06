<?php

namespace PHP_Algorithms\sort;

class QuickSortFirstElementPartition
{
    private $array;
    private $noComparisons;

    public function __construct($array)
    {
        $this->array = $array;
    }


    public function startSort()
    {
        $this->noComparisons = 0;
        $this->recursiveSort(0, count($this->array) -1);
    }


    private function recursiveSort($lo, $hi)
    {
        if ($hi <= $lo) {
            return false;
        }

        $arraySize = $hi - $lo + 1;
        $this->noComparisons += ($arraySize - 1);

        $par = $this->partition($lo, $hi);
        $this->recursiveSort($lo, $par - 1);
        $this->recursiveSort($par + 1, $hi);
    }


    private function partition($lo, $hi)
    {
        $p = $this->array[$lo];
        $i = $lo + 1;
        $j = $lo + 1;

        while ($j <= $hi) {
            if ($this->array[$j] < $p) {
                $this->exch($i, $j);
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
            echo $this->array[$i] . ', ';
        }
    }


    public function getNoComparisons()
    {
        return $this->noComparisons;
    }


    private function less($i, $j)
    {
        if ($i < $j) {
            return true;
        } else {
            return false;
        }
    }


    public function isSorted($lo = null, $hi = null)
    {
        if ($lo === null) {
            $lo = 0;
        }
        if ($hi === null) {
            $hi = $this->size - 1;
        }
        for ($i = $lo; $i < $hi; $i++) {
            if ($this->less($this->array[$i + 1], $this->array[$i])) {
                return false;
            }
        }
        return true;
    }

    public function getArray() {
        return $this->array;
    }
}



function test()
{
    $array= array(10,20,4,3,5,19,11,12,1,7,8,2);

    $quickSort = new QuickSortFirstElementPartition($array);

    $quickSort->displayArray();

    $quickSort->startSort();

    $quickSort->displayArray();

    echo '<br/>';
    echo '<br/>';

    echo $quickSort->getNoComparisons();
}
