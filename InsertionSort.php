<?php

/**
 * Find the smallest element using a linear scan and move it to the front 
 * Then, find the second smallest and move it, again doing a linear scan 
 * Continue doing this until all the elements are in place O(n^2)
 * 
 * @author Will Melbourne <willmelbourne@gmail.com>
 */
class InsertionSort {
    
    private $array;
    private $size;
    
    
    /**
     * the insertion sort algorithm
     * 
     * @param int[] $input_array input_array
     */
    public function insertion_sort($input_array)
    {
        $this->array = $input_array;
        $this->size = count($input_array);
        
        for ($index = 0; $index < count($input_array); $index++) {
            for ($j = $index; $j > 0 && $this->array[$j] < $this->array[$j - 1]; $j--) {
                $this->exch($j, $j -1);
            }
            assert($this->isSorted(0, $index));
        }
    }
   
    /**
     * 
     * @param int $i exchange number 1
     * @param int $j exhange number 2
     * @return boolean
     */
     private function less( $i, $j)
    {
        if ($i < $j){
            return true;
        }
        else {
            return false;
        }
    }
    
    
     private function exch( $i, $j)
    {
        $swap = $this->array[$i];
        $this->array[$i] = $this->array[$j];
        $this->array[$j] = $swap;
     }
    
     
    public function isSorted( $lo = 0, $hi = null)
    {
        if ($hi === null)  $hi = $this->size - 1; 
        for ( $i = $lo; $i < $hi; $i++) {
            if ($this->less($this->array[$i + 1], $this->array[$i])) return false;
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
}

$obj = new InsertionSort();
$obj->insertion_sort(array(5, 3, 5, 1, 4, 6 ,9, 7, 5));
$obj->show();

if ($obj->isSorted()) {
    echo 'SUCCESS: sorted <br/>';
}
else {
    echo 'FAIL: unsorted <br/>';
}

$obj->show();

