<?php

/**
 *
 * used to calculate shortest path in graphs with weighted edges (non negative)
 *
 * we can not just convert each weight edge into set of edges of size weight as it blows up graph too much
 *
 * p652 in Robert Sedgewick - algorithms fourth edition
 *
 *
 **/

namespace PHP_Algorithms\graphs;

require_once('../vendor/autoload.php');

use PHP_Algorithms\collections\priorityQueues;
use PHP_Algorithms\graphs;

class DijkstraShortestPath
{

    private $distTo;    /** @var  SplFixedArray int  distance  of shortest s->v path */
    private $edgeTo; /** @var  SplFixedArray DirectedEdge last edge on shortest s->v path */
    private $pq;            /** @var IndexedMinPriorityQueueBinaryHeap
 * priority queue of vertices */


    public function __construct(EdgeWeightedDiGraph $G, $s)
    {
        foreach ($G->edges() as $edge) {
            if ($edge->getWeight() < 0) {
                throw new \InvalidArgumentException("edge " + e + " has negative weight");
            }
        }

        $this->distTo = new \SplFixedArray($G->getV());
        $this->edgeTo = new \SplFixedArray($G->getV());

        for ($v = 0; $v < $G->getV(); $v++) {
            $this->distTo[$v] = INF;
        }
        $this->distTo[$s] = 0;

        $this->pq = new \PHP_Algorithms\collections\priorityQueues\IndexedMinPriorityQueueBinaryHeap($G->getV());
        $this->pq->insert($s, $this->distTo[$s]);


        while (!$this->pq->isEmpty()) {
            $v = $this->pq->delMin();
            $G->adj($v)->rewind();

            while ($G->adj($v)->valid()) {
                $edge = $G->adj($v)->current();
                $this->relax($edge);
                $G->adj($v)->next();
            }

        }
    }


    // relax edge e and update pq if changed
    private function relax(DirectedEdge $e)
    {
        $v = $e->getFrom();
        $w = $e->getTo();
        if ($this->distTo[$w] > $this->distTo[$v] + $e->getWeight()) {
            $this->distTo[$w] = $this->distTo[$v] + $e->getWeight();
            $this->edgeTo[$w] = $e;

            if ($this->pq->contains($w)) {
                $this->pq->decreaseKey($w, $this->distTo[$w]);
            } else {
                $this->pq->insert($w, $this->distTo[$w]);
            }
        }
    }


    // length of shortest path from s to v
    public function distTo($v)
    {
        if (!isset($this->distTo[$v])) {
            throw new \InvalidArgumentException("this point is not on the graph, you sure this is the correct data?");
        }
        return $this->distTo[$v];
    }

    // is there a path from s to v?
    public function hasPathTo($v)
    {
        if (!isset($this->distTo[$v])) {
            throw new \InvalidArgumentException("this point is not on the graph, you sure this is the correct data?");
        }
        return $this->distTo[$v] < INF;
    }
}



$spaceSymbol = "\t";


$REQUEST_URI = $_SERVER['REQUEST_URI'];

$pathVariables = explode("/", $REQUEST_URI);


$lastElementInArray = $pathVariables[count($pathVariables) - 1];

if (strpos($lastElementInArray, "?") != false) {
    $lastElementInArrayWithoutGetVariables = explode("?", $lastElementInArray)[0];
} else {
    exit;
}



$handle = fopen($lastElementInArrayWithoutGetVariables, "r");

$uniqueNumbers = array();

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (substr($line, 0, 5) == "<?php") {
            throw new \Exception("invalid data type, please use the last parameter in the url as the data string i.e. url/graphs/EdgeWeightedDiGraph.php/dijskstrasDataSmall.txt");
        }

        $line = str_replace("\n", "", $line);
        $nodes = preg_split('/\s+/', $line);

//        exit;

        foreach ($nodes as $node) {
            $nodeInfo = explode(",", $node);

            $nodeIndex = $nodeInfo[0];
            if (!in_array($nodeIndex, $uniqueNumbers)) {
                $uniqueNumbers[] = $nodeIndex;
            }
        }
    }
} else {
    // error opening the file.
    exit("error opening the file.");
}
fclose($handle);


$graph = new \PHP_Algorithms\graphs\EdgeWeightedDiGraph(max($uniqueNumbers) + 1);
$handle = fopen($lastElementInArrayWithoutGetVariables, "r");

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $line = str_replace("\n", "", $line);
        $integerArray[] = (int)$line;

        $nodes = preg_split('/\s+/', $line);

        $fromIndex = $nodes[0];

        for ($i = 1; $i < count($nodes); $i++) {
            $nodeInfo = explode(",", $nodes[$i]);

            $nodeIndex = $nodeInfo[0];
            if (!isset($nodeInfo[1])) {
                continue; // this is the end of the row
            }
            $nodeWeight = (int)$nodeInfo[1];

            $edge = new DirectedEdge($fromIndex, $nodeIndex, $nodeWeight);

            $graph->addEdge($edge);
        }
    }
} else {
    // error opening the file.
}
fclose($handle);


$dijkstras = new DijkstraShortestPath($graph, 1);


echo $dijkstras->distTo(1);
echo ",";
echo $dijkstras->distTo(2);
echo ",";
echo $dijkstras->distTo(3);
echo ",";
echo $dijkstras->distTo(4);
echo ",";


//echo $dijkstras->distTo(7);
//echo ",";
//echo $dijkstras->distTo(37);
//echo ",";
//echo $dijkstras->distTo(59);
//echo ",";
//echo $dijkstras->distTo(82);
//echo ",";
//echo $dijkstras->distTo(99);
//echo ",";
//echo $dijkstras->distTo(115);
//echo ",";
//echo $dijkstras->distTo(133);
//echo ",";
//echo $dijkstras->distTo(165);
//echo ",";
//echo $dijkstras->distTo(188);
//echo ",";
//echo $dijkstras->distTo(197);
