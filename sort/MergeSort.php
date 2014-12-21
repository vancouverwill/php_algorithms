<?php
/**
 * Sort each pair of elements Then, sort every four elements by merging every two pairs 
 * Then, sort every 8 elements, etc O(n log n) expected and worst case
 */

class MergeSort {
    
    private $array;
    private $aux_array;
    private $size;
    
    private $debug = TRUE;
    private $merge_count;
    
    /**
     *  setup the class
     * @param type $input_array
     */
    public function intialize( $input_array)
    {
        $this->array = $input_array;
        $this->size = count($input_array);
        $this->merge_count = 0;
    }
    
    /**
     * run the quick sort
     */
    public function merge_sort()
    {
        $this->aux_array = new SplFixedArray($this->size);
        $this->sort(0, $this->size - 1);
        
        assert($this->is_sorted());
    }
    
    private function sort($lo, $hi)
    {
        if ($hi <= $lo) return;
        $mid = $lo + floor(($hi - $lo) / 2);
        $this->sort($lo, $mid);
        $this->sort($mid + 1, $hi);
        $this->merge($lo, $mid, $hi);
    }
    
    
    private function merge( $lo, $mid, $hi)
    {
        $this->merge_count++;
        // precondition: $this->array[lo .. mid] and $this->array[mid+1 .. hi] are sorted subarrays
        assert($this->is_sorted( $lo, $mid));
        assert($this->is_sorted( $mid + 1, $hi));

        // copy to $this->aux_array[]
        for ( $k = $lo; $k <= $hi; $k++) {
            $this->aux_array[$k] = $this->array[$k]; 
        }
        
         // merge back to $this->array[]
        $i = $lo; 
        $j = $mid + 1;
        for ($k = $lo; $k <= $hi; $k++) {
            if      ($i > $mid)              $this->array[$k] = $this->aux_array[$j++];
            else if ($j > $hi)               $this->array[$k] = $this->aux_array[$i++];
            else if ($this->less($this->aux_array[$j], $this->aux_array[$i])) {
                $this->array[$k] = $this->aux_array[$j++];
            }
            else {
                $this->array[$k] = $this->aux_array[$i++];
            }
        }
        
        // postcondition: $this->array[lo .. hi] is sorted
        assert($this->is_sorted( $lo, $hi));
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

    
    public function is_sorted( $lo = 0, $hi = null)
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

$array_short2 = array( 2378, 50000, 4323, 16, 99, 64, 15, 14, 300, 43000);
$exercise_array = array(55, 48, 44, 42, 24, 67, 41, 29, 99, 98, 84, 52 );

$obj = new MergeSort();

$obj->intialize($exercise_array);
echo 'Initial Array : ';
$obj->show();
$obj->merge_sort();
echo 'Final Array : ';
$obj->show(); 