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


class DepthFirstSearch
{
    /** @var  booean[] */
    private $marked;
    /** @var  SplInt */
    private $count;



    /**
     * @param $G MyGraph
     * @param $s SplInt
     */
    public function __construct( $G, $s)
    {
        $this->marked = new SplFixedArray($G.V());
        $this->dfs($G, $s);
    }

    /**
     * @param $G MyGraph
     * @param $v SplInt
     */
    private function dfs($G, $v)
    {
        $this->count++;
        $this->marked[$v] = true;

        /** @var [] $adjacentArray */
        $adjacentArray = $G->adj($v);


        foreach ($adjacentArray AS $w) {
            if (!$this->marked[$w]) {
                $this->dfs($G, $w);
            }
        }
    }


    /**
     * @return \SplInt
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return \booean[]
     */
    public function getMarked()
    {
        return $this->marked;
    }

}


class BreathFirstSearch {
    private $marked;        // Is a shortest path to this vertex known?
    private $edgeTo;        // last vertex on known path to this vertex
    private $s;             // source


    public function  BreathFirstPaths(MyGraph $graph, $s)
    {
        for ($i = 0; $i < $graph->getV(); $i++) {
            $this->marked = FALSE;
        }

        $this->s = $s;
    }


    private function bfs(MyGraph $graph, $s)
    {
        $queue = new SplQueue();
        $this->marked[$s] = true;
        $queue->enqueue($s);

        while ($queue->count() > 0) {
            $v = $queue->dequeue();

            foreach ($graph->adj($v) AS $w) {
                if (!$this->marked[$w]);
                $this->marked[$w] = true;
                $this->edgeTo[$w] = $v;
                $queue->enqueue($w);
            }
        }
    }

    public function hasPathTo($v)
    {
        return $this->marked[$v];
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

new DepthFirstSearch($graph, $graph->getV());