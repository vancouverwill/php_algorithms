<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-05-21
 * Time: 10:15 PM
 */

class QuickSortLastElementPartition {

    private $array;

    public function __construct($array)
    {
        $this->array = $array;

    }

    public function startSort()
    {
        $this->recursiveSort(0, count($this->array) - 1);
    }

    private function recursiveSort($lo, $hi)
    {
        if ($hi <= $lo) return FALSE;
        $par = $this->partition($lo, $hi);
        $this->recursiveSort($lo, $par - 1);
        $this->recursiveSort($par + 1, $hi);
    }

    private function partition($lo, $hi)
    {
        $p = $hi;
        $i = $lo;
        $j = $lo;

        while ($j < $hi) {
            if ($this->array[$j] < $this->array[$p]) {
                $this->exch($j, $i);
                $i++;
            }
            $j++;
        }
        $this->exch($p, $i);

        return $i;
    }


    private function exch($i, $j)
    {
        $temp = $this->array[$i];
        $this->array[$i] = $this->array[$j];
        $this->array[$j] = $temp;
    }

    public function display()
    {
        for ($i = 0; $i < count($this->array); $i++) {
            echo $this->array[$i] . ',';
        }
    }
}

$array = array(20, 15, 1, 4, 6, 2);

$sort = new QuickSortLastElementPartition($array);

$sort->display();
echo '<br/>';
$sort->startSort();

echo '<br/>';

$sort->display();
