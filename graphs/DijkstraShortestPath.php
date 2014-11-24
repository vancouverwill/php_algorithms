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


class DijkstaShortestPath {

    private $distTo;    /** @var  SplFixedArray int  distance  of shortest s->v path */
    private $directedEdge; /** @var  SplFixedArray DirectedEdge last edge on shortest s->v path */
    private $pq;            /** @var IndexedMinPriorityQueueBinaryHeap  priority queue of vertices */

    public function DijkstaShortestPath(EdgeWeightedDiGraph $G, $s)
    {
        foreach ($G->edges() AS $edge) {
            if ($edge->getWeight() < 0) {
                throw new InvalidArgumentException("edge " + e + " has negative weight");
            }
        }
    }

}