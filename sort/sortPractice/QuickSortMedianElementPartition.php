<?php
namespace PHP_Algorithms\sort;

class QuickSortMedianElementPartition
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
        $this->recursiveSort(0, count($this->array) - 1);
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
        $medianParition = $this->getMedianParitionIndex($lo, $hi);

        $this->exch($lo, $medianParition);

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


    public function testPartition()
    {
        $this->array = array(4,5,6,7);

        $value = $this->getMedianParitionIndex(0, 2);

        if ($value == 1) {
            echo "OKAY" . "<br/>";
        } else {
            echo "FAILED" . "<br/>";
        }

        $value = $this->getMedianParitionIndex(0, 1);

        if ($value == 0) {
            echo "OKAY" . "<br/>";
        } else {
            echo "FAILED" . "<br/>";
        }


        $value = $this->getMedianParitionIndex(1, 2);

        if ($value == 1) {
            echo "OKAY" . "<br/>";
        } else {
            echo "FAILED" . "<br/>";
        }


        $value = $this->getMedianParitionIndex(0, 3);

        if ($value == 1) {
            echo "OKAY" . "<br/>";
        } else {
            echo "FAILED" . "<br/>";
        }


        $this->array = array(8,1,6,7,);

        $value = $this->getMedianParitionIndex(0, 3);

        if ($value == 3) {
            echo "OKAY" . "<br/>";
        } else {
            echo "FAILED" . "<br/>";
        }

        $value = $this->getMedianParitionIndex(0, 1);

        if ($value == 1) {
            echo "OKAY" . "<br/>";
        } else {
            echo "FAILED" . "<br/>";
        }
    }


    private function getMedianParitionValue($lo, $hi)
    {
        $median = ceil(($hi - $lo + 1)/2) + $lo;

        $array = array();

        $array[0] = $this->array[$lo];
        $array[1] = $this->array[$median];
        $array[2] = $this->array[$hi];

        // find lowest
        $min = 0;
        for ($j = 0 + 1; $j <= 2; $j++) {
            if ($array[$j] < $array[$min]) {
                $min = $j;
            }
        }

        $temp = $array[$min];
        $array[$min] = $array[0];
        $array[0] = $temp;

        //find second lowest i.e. middle

        if ($array[1] < $array[2]) {
            $medianValue = $array[1];
        } else {
            $medianValue = $array[2];
        }


        return $medianValue;
    }


    /**
     *
     * this assumes that all items are unique
     *
     * if the two items are so close that the medium is also the lower value then return that
     *
     * @param $lo
     * @param $hi
     * @return float
     */
    private function getMedianParitionIndex($lo, $hi)
    {
        $median = floor(($hi - $lo)/2) + $lo;

        if ($median == $lo) {
            return $lo;
        }

        $array = array();

        $array[0] = $lo;
        $array[1] = $median;
        $array[2] = $hi;

        // find lowest
        $minIndex = 0;
        for ($j = 0 + 1; $j <= 2; $j++) {
            if ($this->array[$array[$j]] < $this->array[$array[$minIndex]]) {
                $minIndex = $j;
            }
        }

        $temp = $array[$minIndex];
        $array[$minIndex] = $array[0];
        $array[0] = $temp;

        //find second lowest i.e. middle

        if ($this->array[$array[1]] < $this->array[$array[2]]) {
            $medianIndex = $array[1];
        } else {
            $medianIndex = $array[2];
        }


        return $medianIndex;
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

function medianTest()
{
//$array = array(20, 15, 1, 4, 6, 2);
    $array= array(10,20,4,3,5,19,11,12,1,7,8,2);

    $sort = new QuickSortMedianElementPartition($array);

    $sort->displayArray();
    echo '<br/>';
    $sort->startSort();

    echo '<br/>';

    $sort->displayArray();

    echo '<br/>';

    echo $sort->getNoComparisons();
}

//$array= array(10,20,4,3,5,19,11,12,1,7,8,2);
//
//$sort = new QuickSortMedianElementPartition($array);
//echo $sort->getMedianParitionIndex(0,11);
//echo "<br/>";
//echo $sort->getMedianParitionIndex(3,5);
//
//echo "<br/>";
//echo $sort->getMedianParitionIndex(2,4);


//medianTest();

//$testSort = new QuickSortMedianElementPartition(null);
//$testSort->testPartition();
