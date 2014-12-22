<?php

namespace PHP_Algorithms\tests\collections;

use PHP_Algorithms\collections\Stack;

class StackTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorCreateEmpty()
    {
        $a = new Stack();
        $this->assertEquals(true, $a->isEmpty());
    }

    public function testStackSize()
    {
        $a = new Stack();

        $a->push(rand());
        $a->push(rand());
        $a->push(rand());
        $a->push(rand());

        $this->assertEquals(4, $a->size());
    }

    public function testPopReturnsLastElement()
    {
        $a = new Stack();

        $a->push(1);
        $a->push(2);
        $a->push(3);

        $this->assertEquals(3, $a->pop());
    }
}
