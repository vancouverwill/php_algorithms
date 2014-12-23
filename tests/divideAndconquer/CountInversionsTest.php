<?php

namespace PHP_Algorithms\tests\divideAndConquer;

use PHP_Algorithms\divideAndConquer\CountInversions;

class CountInversionsTest extends \PHPUnit_Framework_TestCase
{
    public function additionProvider()
    {
        return array(
            array(array(1, 0, 0, 0, 0), 1),
            array(array(0, 1, 2, 3, 4), 0),
            array(array(4, 3, 2, 1, 0), 10),
        );
    }

    /**
     * @dataProvider additionProvider
     */
    public function testCountInversions($array, $count)
    {
        $countInversions = new CountInversions();
        $countInversions->countSortInit($array);
//        $countInversions->getTotal();
        $this->assertEquals($countInversions->getTotal(), $count);
    }


}
