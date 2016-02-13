<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 16-02-13
 * Time: 6:37 PM
 */

namespace PHP_Algorithms\tests\collections\symbolTables;

require_once(__DIR__ . "/../../../vendor/autoload.php");

use PHP_Algorithms\collections\symbolTables\BinarySearchTreeSymbolTable;

class BinarySearchTreeSymbolTableTest extends  \PHPUnit_Framework_TestCase
{
    /**
     * @var BinarySearchTreeSymbolTable
     */
    private $symbolTable;

    public function setUp() {
        $this->symbolTable = new BinarySearchTreeSymbolTable();
        $this->symbolTable->put(1, "snow");
        $this->symbolTable->put(2, "sun");
        $this->symbolTable->put(3, "rain");
        $this->symbolTable->put(4, "fog");
        $this->symbolTable->put(5, "sleet");
    }

    public function testConstructorIsEmpty() {
        $symbolTable = new BinarySearchTreeSymbolTable();
        $this->assertEquals(true, $symbolTable->isEmpty());
    }

    public function testConstructorAndAddingElements() {;
        $this->assertEquals(5, $this->symbolTable->sizeAll());
    }

    public function testContains() {
        $this->assertEquals(true, $this->symbolTable->contains(3));
    }

    public function testDoesntContains() {
        $this->assertEquals(false, $this->symbolTable->contains(7));
    }

    public function testGet() {
        $this->assertEquals("snow", $this->symbolTable->get(1));
    }

    public function testMin() {
        $this->assertEquals(1, $this->symbolTable->min());
        $this->symbolTable->deleteMin();
        $this->assertEquals(2, $this->symbolTable->min());
    }

    public function testMax() {
        $this->assertEquals(5, $this->symbolTable->max());
        $this->symbolTable->deleteMax();
        $this->assertEquals(4, $this->symbolTable->max());
        $this->symbolTable->deleteMax();
        $this->assertEquals(3, $this->symbolTable->max());
    }

    public function testFloor() {
        $this->symbolTable->put(8, "storm");
        $this->assertEquals(5, $this->symbolTable->floor(6));
    }

    public function testCeiling() {
        $this->symbolTable->put(8, "storm");
        $this->assertEquals(8, $this->symbolTable->ceiling(6));
    }

    public function testRank() {
        $this->symbolTable->put(8, "storm");
        $this->symbolTable->put(11, "waves");
        $this->symbolTable->put(14, "tornado");
        $this->assertEquals(0, $this->symbolTable->rank(1));
        $this->assertEquals(5, $this->symbolTable->rank(8));
    }

    public function testSelect() {
        $this->symbolTable->put(8, "storm");
        $this->symbolTable->put(11, "waves");
        $this->symbolTable->put(14, "tornado");
        $this->assertEquals(1, $this->symbolTable->select(0));
    }
}
 
  