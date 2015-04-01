<?php

/**
 * Pick a random element and partition the array, such that all numbers that are less than
 * it come before all elements that are greater than it Then do that for each half, then each
 * quar- ter, etc O(n log n) expected, O(n^2) worst case
 */
namespace PHP_Algorithms\sort;

class QuickSort
{
    protected $array;
    protected $size;

    protected $debug = false;
    
    /**
     *  setup the class
     * @param type $inputArray
     */
    public function intialize($inputArray)
    {
        $this->array = $inputArray;
        $this->size = count($inputArray);
    }
    
    
    /**
     * run the quick sort
     */
    public function quickSort()
    {
 
        if ($this->debug == false) {
//            shuffle($this->array);
        }
        $this->sort(0, count($this->array) -1);
     
    }
    
    
    private function sort($lo, $hi)
    {
        if ($hi <= $lo) {
            return;
        }
        if ($lo == 5 && $hi == 9) {
            $temp = 2;
        }
        $j = $this->partition($lo, $hi);
        $this->sort($lo, $j - 1);
        $this->sort($j + 1, $hi);

        assert($this->isSorted($lo, $hi));
    }

    /**
     *
     * @param type $array
     * @param type $lo - low pointer
     * @param type $hi - high pointer
     */
    public function partition($lo, $hi)
    {
        $i = $lo + 1;
        $j = $hi;
        $comparator = $lo;

        while (true) {
            // find item on lo to swap
            // look for item higher than comparator coming from the left, if find item higher then stop this while loop
            while ($this->less($i, $comparator)) {
                $i++;
                if ($i >= $hi) {
                    break;
                }

            }

            // find item on hi to swap
            // look for item lower than comparator coming from the right
            while ($this->less($comparator, $j)) {
                $j--;
                if ($j <= $lo) {
                    break;
                }

            }

            // check if pointers cross
            if ($i >= $j) {
                break;
            }

            //check if there have been no inversions found if so break
//            if (($i == $lo + 1) && $j == $hi) {
//                break;
//            }

            // we have a inversion where the item at $i is higher than the comparator and $j is lower than the comparator
             $this->exch($i, $j);
        }
        
        // put v = a[j] into position
        $this->exch($lo, $j);
        
        // with a[lo .. j-1] <= a[j] <= a[j+1 .. hi]
        return $j;
    }


    protected function less($i, $j)
    {
        if ($i >=  $this->size || $j >=  $this->size) {
            $temp = "huh";
            $temp ++;
        }
        $temp = "great";

        if ($this->array[$i] < $this->array[$j]) {
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
    
    
    public function show()
    {
        $string = "";
        foreach ($this->array as $key => $value) {
            $string .= $value . " ";
        }
        echo $string . '<br/>';
    }
    
    
    private function show_between($lo, $hi)
    {
        $string = "";
        for ($i = $lo; $i <= $hi; $i++) {
            $string .= $this->array[$i] . " ";
        }
        echo $string . '<br/>';
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
            if ($this->less($i + 1, $i)) {
                return false;
            }
        }
        return true;
    }
    
    /**
     *
     * simple test to verify isSorted() is working
     *
     */
    public function testIsSorted()
    {
        $this->array = array(1, 2, 3, 4, 5);
        
        $lo = 0;
        $hi = 3;
        if (!$this->isSorted($lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between($lo, $hi);
            exit;
        } else {
            echo 'SUCCESS';
        }
        
        $lo = 3;
        $hi = 5;
        if (!$this->isSorted($lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between($lo, $hi);
            exit;
        } else {
            echo 'SUCCESS';
        }
        
        $lo = 0;
        $hi = 5;
        if (!$this->isSorted($lo, $hi)) {
            echo 'lo-' . $lo . ' hi:' . $hi . '<br/>';
            $this->show_between($lo, $hi);
            exit;
        } else {
            echo 'SUCCESS';
        }
    }

    public function getArray()
    {
        return $this->array;
    }
}
