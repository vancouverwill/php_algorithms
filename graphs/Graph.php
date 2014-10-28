<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-04-15
 * Time: 10:26 PM
 */

class MyGraph {
    /** @var  int */
    private $V;     // number of vertices
    /** @var  int */
    private $E;     // number of edges
    /** @var  [][] */
    private $adj;   // adjacency lists


    /**
     * @param $v SplInt
     */
    public function __construct($v)
    {
        $this->V = $v;
        $this->E = 0;
        $this->adj = array(array());
    }


    public function addEdge($v, $w)
    {
        $this->adj[$v] []= $w;
        $this->adj[$w] []= $v;
        $this->E++;
    }


    /**
     * @return int
     */
    public function getV()
    {
        return $this->V;
    }


    /**
     * @return int
     */
    public function getE()
    {
        return $this->E;
    }

    public function adj($v)
    {
        return $this->adj[$v];
    }
}





$graph = new MyGraph(6);

$graph->addEdge(0, 1);
$graph->addEdge(0, 2);
$graph->addEdge(0, 5);
$graph->addEdge(2, 1);
$graph->addEdge(2, 3);
$graph->addEdge(2, 4);
$graph->addEdge(3, 5);

echo $graph->getE();
echo '<br/>';
echo $graph->getV();

require_once("./DepthFirstSearch.php");
new DepthFirstSearch($graph, $graph->getV());