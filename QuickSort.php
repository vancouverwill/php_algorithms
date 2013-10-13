<?php

/**
 * Pick a random element and partition the array, such that all numbers that are less than 
 * it come before all elements that are greater than it Then do that for each half, then each 
 * quar- ter, etc O(n log n) expected, O(n^2) worst case
 */
error_reporting(E_ALL);

class  QuickSort 
{
    // todo make this object oriented
    private $array;
    private $size;
    
    private $debug = true;
    
    public function quick_sort( $input_array)
    {
        $array = $input_array;
        $this->array = $input_array;
        $this->size = count($input_array);
        
        if (!$debug) {
            shuffle($this->array);
        }        
        $this->sort( 0, count($array) -1);
     
    }
    
    private function sort( $lo, $hi){
        if ($hi <= $lo) return;
        $j = $this->partition( $lo, $hi); 
        $this->sort( $lo, $j - 1);
        $this->sort( $j + 1, $hi);
//          $j = $this->partition();
//        echo $j;
//        assert($this->isSorted( $lo, $hi));
        if (!$this->isSorted( $lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between( $lo, $hi);
            exit;
        }

    }

    /**
     * 
     * @param type $array
     * @param type $lo - low pointer
     * @param type $hi - high pointer
     */
    private function partition($lo, $hi)
    {
        echo 'part';
        $this->show_between($lo, $hi);
        
//        $lo = 0;
//        $hi = $this->size - 1;
        $i = $lo + 1;
        $j = $hi;
        $comparator = $this->array[$lo];

        while (true) {
            // find item on lo to swap
            while($this->less($this->array[$i++], $comparator)) {
                if ($i == $hi) break;
            }

            // find item on hi to swap
            while($this->less($comparator, $this->array[$j--])) {
                if ($j == $lo) break;
            }

            // check if pointers cross
            if ($i >= $j) break;
            
             $this->exch($i - 1, $j + 1);
        }
        
        // put v = a[j] into position
        $this->exch( $lo, $j + 1);
       
//        $this->class_array = $array;
        $result = $j + 1;
        
        return $result;
    }


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
        
//        return $array;
    }
    
    private function show() 
    {
//        echo($this->array);
        $string = "";
        foreach ($this->array as $key => $value) {
            $string .= $value . "-";
        }
        echo $string . '<br/>';
    }
    
    private function show_between( $lo, $hi) 
    {
        $string = "";
        for ( $i = $lo; $i < $hi; $i++) {
            $string .= $this->array[$i] . " ";
        }
        echo $string . '<br/>';
    }
    
    private function isSorted( $lo, $hi)
    {
        for ( $i = $lo; $i < $hi - 1; $i++) {
            if ($this->less($this->array[$i + 1], $this->array[$i])) return false;
        }
        return true;
    }
    
    public function test_is_sorted() {
        $this->array = array(1, 2, 3, 4, 5);
//        $this->isSorted(, 3);
        
        $lo = 0; $hi = 3;
        if (!$this->isSorted( $lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between( $lo, $hi);
            exit;
        }
        else {
            echo 'SUCCESS';
        }
        
        $lo = 3; $hi = 5;
        if (!$this->isSorted( $lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between( $lo, $hi);
            exit;
        }
        else {
            echo 'SUCCESS';
        }
        
        $lo = 0; $hi = 5;
        if (!$this->isSorted( $lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between( $lo, $hi);
            exit;
        }
        else {
            echo 'SUCCESS';
        }
    }
}

$obj = new QuickSort();
//$obj->test_is_sorted();
$obj->quick_sort(array(5, 3, 5, 1, 4, 6 ,9, 7, 5));