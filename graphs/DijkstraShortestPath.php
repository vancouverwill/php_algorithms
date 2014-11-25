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

        $this->distTo = new SplFixedArray($G->getV());
        $this->directedEdge = new SplFixedArray($G->getV());

        for ($v = 0; $v < $G->getV(); $v++) {
            $this->distTo[$v] = INF;
        }
        $this->distTo[$s] = 0;

        $this->pq = new IndexedMinPriorityQueueBinaryHeap($G->getV());
        $this->pq->insert($s, $this->distTo[$s]);

        while(!$this->pq->isEmpty()) {
            $v = $this->pq->delMin();
            foreach ($G->adj($v) AS $edge) {
                $this->relax($edge);
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