<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-06-08
 * Time: 10:03 PM
 */

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
