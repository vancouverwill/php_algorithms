<?php


namespace PHP_Algorithms\tests\graphs;

use PHP_Algorithms\graphs\DepthFirstSearch;
use PHP_Algorithms\graphs\Graph;

class GraphTest extends \PHPUnit_Framework_TestCase
{

    public function testGraphConstructor()
    {
        $graph = new Graph(4);
        $this->assertEquals($graph->getV(), 4);
    }

    public function testGraphAddEdges()
    {
        $graph = new Graph(4);
        $graph->addEdge(0, 1);
        $graph->addEdge(1, 2);
        $graph->addEdge(2, 3);
        $this->assertEquals($graph->getE(), 3);
    }

    public function testAdj()
    {
        $graph = new Graph(4);
        $graph->addEdge(0, 1);
        $graph->addEdge(0, 2);
        $graph->addEdge(0, 3);
        $graph->addEdge(2, 3);
        $this->assertEquals((int)count($graph->adj(0)), 3);
    }
}
