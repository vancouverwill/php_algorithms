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
    
    private $debug = FALSE;
    
    /**
     *  setup the class
     * @param type $input_array
     */
    public function intialize( $input_array)
    {
        $this->array = $input_array;
        $this->size = count($input_array);
    }
    
    
    /**
     * run the quick sort
     */
    public function quick_sort()
    {
 
        if ($this->debug == FALSE) {
            shuffle($this->array);
        }        
        $this->sort( 0, count($this->array) -1);
     
    }
    
    
    private function sort( $lo, $hi){
        if ($hi <= $lo) return;
        $j = $this->partition( $lo, $hi); 
        $this->sort( $lo, $j - 1);
        $this->sort( $j + 1, $hi);

        assert($this->is_sorted( $lo, $hi));
    }

    /**
     * 
     * @param type $array
     * @param type $lo - low pointer
     * @param type $hi - high pointer
     */
    private function partition($lo, $hi)
    {
        $i = $lo + 1;
        $j = $hi;
        $comparator = $this->array[$lo];

        while (true) {
            // find item on lo to swap
            while($this->less($this->array[$i], $comparator)) {
                if ($i == $hi) break;
                $i++;
            }

            // find item on hi to swap
            while($this->less($comparator, $this->array[$j])) {
                if ($j == $lo) break;
                $j--;
            }

            // check if pointers cross
            if (($i) >= ($j)) break;
            
             $this->exch($i, $j);
        }
        
        // put v = a[j] into position
        $this->exch( $lo, $j);
        
        // with a[lo .. j-1] <= a[j] <= a[j+1 .. hi]
        return $j;
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
    }
    
    
    public function show() 
    {
        $string = "";
        foreach ($this->array as $key => $value) {
            $string .= $value . " ";
        }
        echo $string . '<br/>';
    }
    
    
    private function show_between( $lo, $hi) 
    {
        $string = "";
        for ( $i = $lo; $i <= $hi; $i++) {
            $string .= $this->array[$i] . " ";
        }
        echo $string . '<br/>';
    }
    
    
    private function is_sorted( $lo, $hi)
    {
        if ($hi === null)  $hi = $this->size - 1; 
        for ( $i = $lo; $i < $hi; $i++) {
            if ($this->less($this->array[$i + 1], $this->array[$i])) return false;
        }
        return true;
    }
    
    /**
     * 
     * simple test to verify is_sorted() is working
     * 
     */
    public function test_is_sorted() {
        $this->array = array(1, 2, 3, 4, 5);
        
        $lo = 0; $hi = 3;
        if (!$this->is_sorted( $lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between( $lo, $hi);
            exit;
        }
        else {
            echo 'SUCCESS';
        }
        
        $lo = 3; $hi = 5;
        if (!$this->is_sorted( $lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between( $lo, $hi);
            exit;
        }
        else {
            echo 'SUCCESS';
        }
        
        $lo = 0; $hi = 5;
        if (!$this->is_sorted( $lo, $hi)) {
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

$sample_array = array(5, 3, 5, 1, 4, 6 ,9, 7, 5);
$array_full = array( 25, 37, 45, 84, 74, 16, 99, 64, 15, 14, 26, 43);
$array_full2 = array (25, 37, 45, 84, 74, 16, 99, 64, 15, 14, 26, 43);
$array_short = array( 25, 37, 45, 84, 74);
$array_short2 = array( 16, 99, 64, 15, 14);


$obj->intialize($array_full2);
echo 'Initial Array : ';
$obj->show();
$obj->quick_sort();
echo 'Final Array : ';
$obj->show(); 
