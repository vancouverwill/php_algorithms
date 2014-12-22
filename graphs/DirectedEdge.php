<?php
namespace PHP_Algorithms\graphs;

class DirectedEdge
{
    private $to;
    private $from;
    private $weight;

    public function __construct($from, $to, $weight = 1)
    {
        $this->from = $from;
        $this->to = $to;
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }
}
