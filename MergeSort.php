<?php
/**
 * Sort each pair of elements Then, sort every four elements by merging every two pairs 
 * Then, sort every 8 elements, etc O(n log n) expected and worst case
 */

class MergeSort {
    
    
    
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