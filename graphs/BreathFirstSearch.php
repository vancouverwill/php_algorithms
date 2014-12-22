<?php

namespace PHP_Algorithms\graphs;

class BreathFirstSearch
{
    private $marked;        // Is a shortest path to this vertex known?
    private $edgeTo;        // last vertex on known path to this vertex
    private $s;             // source


    public function breathFirstPaths(MyGraph $graph, $s)
    {
        for ($i = 0; $i < $graph->getV(); $i++) {
            $this->marked = false;
        }

        $this->s = $s;
    }


    private function bfs(MyGraph $graph, $s)
    {
        $queue = new \SplQueue();
        $this->marked[$s] = true;
        $queue->enqueue($s);

        while ($queue->count() > 0) {
            $v = $queue->dequeue();

            foreach ($graph->adj($v) as $w) {
                if (!$this->marked[$w]) {
                }
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
