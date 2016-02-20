<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-03-31
 * Time: 7:40 PM
 *
 * this quicksort implementation is designed to work specifically for the greedy algorithm sorting jobs based onr the difference between weight and length.
 *
 * Weight brings a job forwards in priority as it is important but
 * length pushs a job down in priority as a long job at the start makes all the other jobs following it finish late too
 *
 * here is a sample of one element of the array we will be sorting on
 *
 * array(
 *      array("weight" => 20, "length" => 10),
 *      array("weight" => 40, "length" => 10),
 *      array("weight" => 20, "length" => 50),
 *  );
 *
 * the aim here is to sort with decreasing priorityByDifference and if there is a tie higher weight should come first
 */

namespace PHP_Algorithms\sandbox;


require_once __DIR__ . '/../vendor/autoload.php';



class QuickSortGreedyAlgorithmByDifference extends QuickSortGreedyAlgorithm
{
    public function intialize($inputArray) {
        parent::intialize($inputArray);

        foreach ($this->array AS $index => $value) {
            $this->array[$index]["priorityByDifference"] = $value["weight"] -  $value["length"];
        }
    }

    protected function less($i, $j)
    {
        if ($this->array[$i]["priorityByDifference"] > $this->array[$j]["priorityByDifference"]) {
            return true;
        } elseif ($this->array[$i]["priorityByDifference"] < $this->array[$j]["priorityByDifference"]) {
            return false;
        } elseif ($this->array[$i]["weight"] > $this->array[$j]["weight"]) {
            return true;
        } else {
            return false;
        }
    }

    public function show()
    {
        $string = "";
        foreach ($this->array as $key => $value) {
            $string .= $value . " ";
        }
        echo $string . '<br/>';
    }


}