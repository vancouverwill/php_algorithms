<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-01
 * Time: 8:23 AM
 */


namespace PHP_Algorithms\tests\sort;

use PHP_Algorithms\sandbox\QuickSortGreedyAlgorithmByDifference;

class QuickSortGreedyAlgorithmByDifferenceTest extends \PHPUnit_Framework_TestCase
{

    public function testIntialize()
    {
        $sampleArray = array(5, 3, 5, 1, 4, 6 ,9, 7, 5);
        $a = new QuickSortGreedyAlgorithmByDifference();
        $a->intialize($sampleArray);

        $this->assertEquals($sampleArray, $a->getArray());
    }

    public function testSort()
    {
        $sample = array(
               array("id" => 1, "weight" => 20, "length" => 10, "priorityByDifference" => 20 - 10, "priorityByRatio" => 20 / 10),
               array("id" => 2, "weight" => 40, "length" => 10, "priorityByDifference" => 40 - 10, "priorityByRatio" => 40 / 10),
               array("id" => 3, "weight" => 20, "length" => 50, "priorityByDifference" => 20 - 50, "priorityByRatio" => 20 / 50),
           );

        $a = new QuickSortGreedyAlgorithmByDifference();
        $a->intialize($sample);

        $a->quickSort();

        $this->assertEquals(true, $a->isSorted());

        echo $a->getArray()[2]["id"];

        $this->assertEquals(2,$a->getArray()[0]["id"]);
        $this->assertEquals(3,$a->getArray()[2]["id"]);
    }
}


