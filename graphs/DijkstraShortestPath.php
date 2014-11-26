<?php

/**
 *
 * p652 in Robert Sedgewick - algorithms fourth edition
 *
 *
 **/

// todo finish Dijksta notes

require_once('./DirectedEdge.php');
require_once('./../priority_queues/IndexedMinPriorityQueueBinaryHeap.php');
require_once('./EdgeWeightedDiGraph.php');


class DijkstraShortestPath {

    private $distTo;    /** @var  SplFixedArray int  distance  of shortest s->v path */
    private $directedEdge; /** @var  SplFixedArray DirectedEdge last edge on shortest s->v path */
    private $pq;            /** @var IndexedMinPriorityQueueBinaryHeap  priority queue of vertices */


    public function  DijkstraShortestPath(EdgeWeightedDiGraph $G, $s)
    {
        foreach ($G->edges() AS $edge) {
            if ($edge->getWeight() < 0) {
                throw new InvalidArgumentException("edge " + e + " has negative weight");
            }
        }

        $this->distTo = new SplFixedArray($G->getV());
        $this->directedEdge = new SplFixedArray($G->getV());

        for ($v = 0; $v < $G->getV(); $v++) {
            $this->distTo[$v] = INF;
        }
        $this->distTo[$s] = 0;

        $this->pq = new IndexedMinPriorityQueueBinaryHeap($G->getV());
        $this->pq->insert($s, $this->distTo[$s]);

        $temp = $G->adj(0);

//        $temp1 = (SplStack)$temp;

        $beta = $temp->next();

        while ($temp->valid()) {
            $alpha = $temp->current();
            $beta = $temp->next();
            $gamma = 1;
        }

        while(!$this->pq->isEmpty()) {
            $v = $this->pq->delMin();  ******* shouldn't be reuturning 0 when we have 1 -5 on graph'

            while ($G->valid()) {
                $edge1 = $G->current();
                $beta = $G->pop();
                $this->relax($edge);
            }

//            foreach (!$G->adj($v)->isEmpty()) {
//                $edge1 = $G->adj($v)->pop();
//                $this->relax($edge);
//            }
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

            if ($this->pq->contains($w)) $this->pq->decreaseKey($w,$this->distTo[$w]);
            else $this->pq->insert($w, $this->distTo[$w]);
        }
    }


    // length of shortest path from s to v
    public function distTo($v) {
        return $this->distTo[$v];
    }

    // is there a path from s to v?
    public function hasPathTo($v) {
        return $this->distTo[$v] < INF;
    }

}



$REQUEST_URI = $_SERVER['REQUEST_URI'];

$pathVariables = explode("/", $REQUEST_URI);


//var_dump($_SERVER);

$lastElementInArray = $pathVariables[count($pathVariables) - 1];

if (strpos($lastElementInArray, "?") != FALSE) {
    $lastElementInArrayWithoutGetVariables = explode("?", $lastElementInArray)[0];
}
else {
    exit;
}

var_dump($lastElementInArrayWithoutGetVariables);


$handle = fopen($lastElementInArrayWithoutGetVariables, "r");

$uniqueNumbers = array();

if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $nodes = explode(" ", $line);

        foreach ($nodes AS $node) {
            $nodeInfo = explode(",", $node);

            $nodeIndex = $nodeInfo[0];
            if (!in_array($nodeIndex, $uniqueNumbers)) {
                $uniqueNumbers[] = $nodeIndex;
            }
        }
    }
} else {
    // error opening the file.
}
fclose($handle);


$graph = new EdgeWeightedDiGraph(max($uniqueNumbers) + 1);
$handle = fopen($lastElementInArrayWithoutGetVariables, "r");

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $integerArray[] = (int)$line;

        $nodes = explode(" ", $line);

        $fromIndex = $nodes[0];

        for ($i = 1; $i < count($nodes); $i++) {
            $nodeInfo = explode(",", $nodes[$i]);

            $nodeIndex = $nodeInfo[0];
            $nodeWeight = $nodeInfo[1];

            $edge = new DirectedEdge($fromIndex, $nodeIndex, $nodeWeight);

            $graph->addEdge($edge);
        }
    }
} else {
    // error opening the file.
}
fclose($handle);

$dijkstras = new DijkstraShortestPath($graph, 0);

$temp = 2;




