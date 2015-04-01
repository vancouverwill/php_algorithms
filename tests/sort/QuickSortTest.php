<?php

namespace PHP_Algorithms\tests\sort;

use PHP_Algorithms\sort\QuickSort;

class QuickSortTest extends \PHPUnit_Framework_TestCase
{

    public function testIntialize()
    {
        $sampleArray = array(5, 3, 5, 1, 4, 6 ,9, 7, 5);
        $a = new QuickSort();
        $a->intialize($sampleArray);

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
            array(array(84, 99, 64, 45, 37))
        );
    }


    /**
     * @dataProvider additionProvider
     */
    public function testQuickSort($array)
    {
        $a = new QuickSort();
        $a->intialize($array);
        $a->quickSort();
        $this->assertEquals(true, $a->isSorted());
    }

    public function partitionProvider()
    {
        return array(
            array(array(3, 5, 2, 1, 4), 2),
            array(array(5, 3, 2, 1, 4), 4),
            array(array(5, 4, 2, 1, 3), 4),
            array(array(4, 5, 2, 1, 3), 4),
        );
    }

    /**
     * @dataProvider partitionProvider
     */
    public function testQuickSortPartition($array, $partitionIndex)
    {
        $a = new QuickSort();
        $a->intialize($array);
        $a->intialize($array);
        $temp = $a->partition(0, 4);

        $this->assertEquals($partitionIndex, $temp);
    }
}
