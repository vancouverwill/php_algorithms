<?php


namespace PHP_Algorithms\tests\graphs;

use PHP_Algorithms\graphs\BoggleGame;

class BoggleGameTest extends \PHPUnit_Framework_TestCase
{

    public function test_CoordinatesIntoDiceNumber_ReturnsTrue()
    {
        $a = new BoggleGame(3, 3);
        $this->assertEquals($a->coordinatesIntoDiceNumber(0, 0), 0);
        $this->assertEquals($a->coordinatesIntoDiceNumber(2, 2), 8);
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_CoordinatesIntoDiceNumber_throwsInvalidArgumentException()
    {
        $a = new BoggleGame(3, 3);
        $a->coordinatesIntoDiceNumber(3, 3);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetReachableDiceAsIterator()
    {
        $a = new BoggleGame(4, 4);
        $a->getReachableDiceAsIterator(5, 3);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_getReachableDiceAsIteratorThrowsExceptionLargerThanXAxis()
    {
        $a = new BoggleGame(4, 4);
        $a->getReachableDiceAsIterator(5, 3);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_getReachableDiceAsIterator_ThrowsException_NegativeX()
    {
        $a = new BoggleGame(4, 4);
        $a->getReachableDiceAsIterator(-1, 3);
    }


    public function test_getReachableDiceAsIterator_returnsIteratorCorrectSize()
    {
        $a = new BoggleGame(4, 4);
        $this->assertEquals(count($a->getReachableDiceAsIterator(0, 0)), 3);
        $this->assertEquals(count($a->getReachableDiceAsIterator(3, 3)), 3);
        $this->assertEquals(count($a->getReachableDiceAsIterator(0, 3)), 3);
        $this->assertEquals(count($a->getReachableDiceAsIterator(3, 0)), 3);
    }




}




