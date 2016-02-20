<?php

namespace PHP_Algorithms\tests\sort;

use PHP_Algorithms\sort\QuickSortFirstElementPartition;

class QuickSortFirstElementPartitionTest extends \PHPUnit_Framework_TestCase
{


    public function testIntialize()
    {
        $sampleArray = array(5, 3, 5, 1, 4, 6 ,9, 7, 5);
        $a = new QuickSortFirstElementPartition($sampleArray);

        $this->assertEquals($sampleArray, $a->getArray());
    }

    public function additionProvider()
    {
        return array(
            array(array(1)),
            array(array(1, 0, 0, 0, 0)),
            array(array(0, 0, 0, 0, 0, 0, 0)),
            array(array(1, 1, 1, 1, 1)),
            array(array(0, 1, 2, 3, 4)),
            array(array(4, 3, 2, 1, 0)),
        );
    }


    /**
     * @dataProvider additionProvider
     */
    public function testQuickSort($array)
    {
        $a = new QuickSortFirstElementPartition($array);
        $a->startSort();
        $this->assertEquals(true, $a->isSorted(0, count($array) - 1));
    }
}
