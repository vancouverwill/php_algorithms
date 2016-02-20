<?php
namespace PHP_Algorithms\graphs;

class Graph
{
    /** @var  int */
    private $V;     // number of vertices
    /** @var  int */
    private $E;     // number of edges
    /** @var  [][] */
    private $adj;   // adjacency lists


    /**
     * @param $v int
     */
    public function __construct($v)
    {
        $this->V = $v;
        $this->E = 0;

        $this->adj = new \SplFixedArray($v);
        for ($i = 0; $i < $this->getV(); $i++) {
            $this->adj[$i] = new \SplStack();
        }
    }


    public function addEdge($v, $w)
    {
        if (!isset($this->adj[$v])) {
            exit("v is " . $v);
        }
        if ($v < 0 || $v > $this->V) {
            throw new \InvalidArgumentException("v is out of bounds");
        }
        if ($w < 0 || $w > $this->V) {
            throw new \InvalidArgumentException("w is out of bounds");
        }

        $this->adj[$v]->push($w);
        $this->adj[$w]->push($v);
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
        if ($v < 0 || $v >= $this->V) {
            throw new \InvalidArgumentException();
        }
        return $this->adj[$v];
    }
}





