<?php
/**
 * Experiment try running mergesort from the other direction, instead of recursively halving the array,
 * try starting from the bottom, take single elements and join with the neighbouring element, repeat this process up
 *
 *
 * Sort each pair of elements Then, sort every four elements by merging every two pairs
 * Then, sort every 8 elements, etc O(n log n) expected and worst case
 */

namespace PHP_Algorithms\sort;

class MergeSortBottomUp
{
    
    private $array;
    private $aux_array;
    private $size;
    
    private $mergeCount;
    
    /**
     *  setup the class
     * @param array $input_array
     */
    public function intialize($inputArray)
    {
        $this->array = $inputArray;
        $this->size = count($inputArray);
        $this->mergeCount = 0;
    }
    
    /**
     * run the quick sort
     */
    public function mergeSortBottomUp()
    {
        $this->aux_array = new \SplFixedArray($this->size);
        $this->sort(0, $this->size - 1);
        
        assert($this->isSorted());
    }


    /**
     * instead of recursively breaking up the array smaller,
     * we start at the smallest merge which is merging single items into pairs,
     * then merge the pairs in to four sets and so on until we can't doube anymore
     *
     */
    private function sort()
    {
        for ($n = 1; $n < $this->size; $n = $n + $n) {
            for ($i = 0; $i < $this->size - $n; $i += $n + $n) {
                $lo = $i;
                $m  = $i + $n - 1;
                $hi = min($i + $n + $n - 1, $this->size - 1);
                $this->merge($lo, $m, $hi);

            }
        }
    }


    /**
     * identical merge function from MergeSort
     * @param $lo
     * @param $mid
     * @param $hi
     */
    private function merge($lo, $mid, $hi)
    {
        $this->mergeCount++;
        // precondition: $this->array[lo .. mid] and $this->array[mid+1 .. hi] are sorted subarrays
        assert($this->isSorted($lo, $mid));
        assert($this->isSorted($mid + 1, $hi));


        // copy to $this->aux_array[]
        for ($k = $lo; $k <= $hi; $k++) {
            $this->aux_array[$k] = $this->array[$k];
        }

         // merge back to $this->array[]
        $i = $lo;
        $j = $mid + 1;
        for ($k = $lo; $k <= $hi; $k++) {
            if ($i > $mid) {
                $this->array[$k] = $this->aux_array[$j++];
            } elseif ($j > $hi) {
                $this->array[$k] = $this->aux_array[$i++];
            } elseif ($this->less($this->aux_array[$j], $this->aux_array[$i])) {
                $this->array[$k] = $this->aux_array[$j++];
            } else {
                $this->array[$k] = $this->aux_array[$i++];
            }
        }

        // postcondition: $this->array[lo .. hi] is sorted
        assert($this->isSorted($lo, $hi));
    }
    
    
    private function less($i, $j)
    {
        if ($i < $j) {
            return true;
        } else {
            return false;
        }
    }

    
    private function exch($i, $j)
    {
        $swap = $this->array[$i];
        $this->array[$i] = $this->array[$j];
        $this->array[$j] = $swap;
    }


    public function isSorted($lo = 0, $hi = null)
    {
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
   
    
    public function show()
    {
        $string = "";
        foreach ($this->array as $key => $value) {
            $string .= $value . "-";
        }
        echo $string . '<br/>';
    }


    public function getSize()
    {
        return $this->size;
    }
}

//$array_short2 = array( 2378, 50000, 4323, 16, 99, 64, 15, 14, 300, 43000);
//$exercise_array = array(55, 48, 44, 42, 24, 67, 41, 29, 99, 98, 84, 52 );

$ex_array = array(77, 74, 27, 82, 99, 87, 20, 34, 13, 81);

$obj = new MergeSortBottomUp();

$obj->intialize($ex_array);
echo 'Initial Array : ';
$obj->show();
$obj->mergeSortBottomUp();
echo 'Final Array : ';
$obj->show();
