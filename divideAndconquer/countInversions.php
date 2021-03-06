<?php
/**
 * input: array A containing the numbers 1,2,3,4.... in some arbitary order
 *
 * output: number of inversions : number of pairs of array indices (i,j) where i < j and A[i] > a[j]
 *
 * example (1,3,5,2,4,6)
 *
 * inversion (3,2), (5,2), (5,4)
 *
 * motivation: numerical similarity measure between two ranked lists. e.g. for collaborative filtering
 */


namespace PHP_Algorithms\divideAndConquer;

class CountInversions
{


    private $inputArray; /** @var  array */
    private $total; /** @var  int */

    public function countSortInit($array)
    {
        $this->inputArray = $array;
        $this->total = $this->countSort(0, count($this->inputArray) -1);
    }


    private function countSort($lo, $hi)
    {
        if ($hi <= $lo) {
            return 0;
        }
            $mid  = $lo + floor(($hi - $lo) / 2);
            $x = $this->countSort($lo, $mid);
            $y = $this->countSort($mid +1, $hi);
            $z = $this->countSplitInvMerge($lo, $hi);
            return $x + $y + $z;
    }


    private function countSplitInvMerge($lo, $hi)
    {
        $mid  = $lo + floor(($hi - $lo) / 2);

        $i = $lo;
        $j = $mid + 1;
        $k = $lo;

        $tempArray = $this->inputArray;

        $inversions = 0;

        while ($k <= $hi) {
            if ($i > $mid) {
                $this->inputArray[$k++] =  $tempArray[$j++];
            } elseif ($j > $hi) {
                $this->inputArray[$k++] =  $tempArray[$i++];
            } elseif ($tempArray[$i] < $tempArray[$j]) {
                $this->inputArray[$k++] =  $tempArray[$i++];
            } else {
                if ($tempArray[$i] > $tempArray[$j]) {
                    $inversions += ($mid + 1) - $i;
                }
                $this->inputArray[$k++] =  $tempArray[$j++];
            }
        }
        return $inversions;
    }

    /**
     * @return array
     */
    public function getInputArray()
    {
        return $this->inputArray;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}
