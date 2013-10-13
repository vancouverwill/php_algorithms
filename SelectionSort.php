<?php

/**
 * Find the smallest element using a linear scan and move it to the front 
 * Then, find the second smallest and move it, again doing a linear scan 
 * Continue doing this until all the elements are in place O(n^2)
 * 
 * @author Will Melbourne <willmelbourne@gmail.com>
 */
class SelectionSort {
    
    private $array;
    private $size;
    
    /**
     * the selection sort algorithm
     * 
     * @param int[] $input_array input_array
     */
    public function selection_sort($input_array)
    {
        $this->array = $input_array;
        $this->size = count($input_array);
                
        for ($index = 0; $index < count($input_array); $index++) {
            $min = $index;
            for ($j = $index + 1; $j < $this->size; $j++)
            {
                if ($this->array[$j] < $this->array[$min]) $min = $j;
            }
            $this->exch($index, $min);
            
             assert($this->isSorted(0, $index));
        }
        
         assert($this->isSorted(0, $this->size - 1));
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
    
    public function getSize(){
        return $this->size;
    }
}

$obj = new SelectionSort();
$obj->selection_sort(array(5, 3, 5, 1, 4, 6 ,9, 7, 5));
$obj->show();

if ($obj->isSorted(0, $obj->getSize() - 1)) {
    echo 'SUCCESS: sorted <br/>';
}
else {
    echo 'FAIL: unsorted <br/>';
}

$obj->show();

