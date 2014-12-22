<?php
namespace PHP_Algorithms\graphs;

require_once(__DIR__ . "/../vendor/autoload.php");

use PHP_Algorithms\graphs;

class EdgeWeightedDiGraph
{
    private $v; /** @var  int */
    private $e; /** @var  int */
    private $adj; /** @var SplFixedArray fixed array of ??? */


    public function __construct($v)
    {
        $this->v = $v;
        $this->e = 0;
        $this->adj = new \SplFixedArray($v);
        for ($i = 0; $i < $this->v; $i++) {
            $this->adj[$i] = new \SplStack();
        }
    }


    public function getV()
    {
        return $this->v;
    }


    public function getE()
    {
        return $this->v;
    }


    public function addEdge(DirectedEdge $e)
    {
        $v = $e->getFrom();
        $before = count($this->adj[$v]);
        $this->adj[$v]->push($e);
        $after = count($this->adj[$v]);

    }


    /**
     * Return the edges incident from vertex v as an Iterable.
     * @param $v
     * @return SplStack
     * @throws InvalidArgumentException
     */
    public function adj($v)
    {
        if ($v < 0 || $v >= $this->v) {
            throw new InvalidArgumentException();
        }
        return $this->adj[$v];
    }

    public function edges()
    {
        $edges = new \SplStack();

        for ($v = 0; $v < $this->v; $v++) {
            foreach ($this->adj($v) as $key => $edge) {
                $edges->push($edge);
            }
        }

        return $edges;
    }
}
