<?php
error_reporting(E_ALL);

/**
* @author William Melbourne 
* @source 
*/

    exampleUse();

	// public function binary_search( $key, $sortedArray)
	 function binary_search( $key, $sortedArray)
	{
		$array =  $sortedArray;
		$lo = 0;
		$hi = count($array);
		while ($lo <= $hi) {
			// Key is in a[lo..hi] or not present.
			$mid = $lo + floor(($hi - $lo) / 2);
                        $comparator = $array[$mid];
			if ($key < $comparator) { 
                            $hi = $mid - 1;
                        }
			elseif ($key > $comparator) { 
                            $lo = $mid + 1;
                            
                        }
			else return $mid;
		}
		return -1; //$key does not exist
	}

	function exampleUse()
	// public exampleUse()
	{
		// $sampleInts = arrau(1, 2, 3,4,5 10, 20, 40, 80, 160, 200);
		$array = array( 0, 1 , 1, 2, 3, 5, 8, 13, 21, 34, 55, 89);

		$result = binary_search(55, $array);
                
                echo $result;
	}

	

// echo 'red';
