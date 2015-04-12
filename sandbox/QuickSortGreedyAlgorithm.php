<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-01
 * Time: 7:05 PM
 */

namespace PHP_Algorithms\sandbox;

use PHP_Algorithms\sort\QuickSort;

require_once __DIR__ . '/../vendor/autoload.php';

abstract class QuickSortGreedyAlgorithm extends QuickSort
{

    public function calculateTotalCompletionTime()
    {
        $total = 0;

        foreach ($this->array as $value) {
            $total += $value["weight"] * $value["length"];
        }
        return $total;
    }
}
