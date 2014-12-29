<?php


namespace PHP_Algorithms\tests\graphs;

use PHP_Algorithms\graphs\DepthFirstSearch;
use PHP_Algorithms\graphs\Graph;

class DepthFirstSearchTest extends \PHPUnit_Framework_TestCase
{
    public function testDFS()
    {
        $graph = new Graph(6);

        $graph->addEdge(0, 1);
        $graph->addEdge(0, 2);
        $graph->addEdge(0, 5);
        $graph->addEdge(2, 1);
        $graph->addEdge(2, 3);
//        $graph->addEdge(2, 4);
        $graph->addEdge(3, 5);

        echo $graph->getE();
        echo '<br/>';
        echo $graph->getV();

//        require_once("./DepthFirstSearch.php");
        $dfs = new DepthFirstSearch($graph, 0);

        $this->assertEquals($dfs->getCount(), 5);
    }
}
