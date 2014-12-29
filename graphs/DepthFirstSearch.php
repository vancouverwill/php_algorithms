<?php
namespace PHP_Algorithms\graphs;

class DepthFirstSearch
{
    /** @var  boolean[] */
    private $marked;
    /** @var  SplInt */
    private $count;



    /**
     * @param Graph $G Graph
     * @param int $s SplInt
     */
    public function __construct(Graph $G, $s)
    {
        $this->marked = new \SplFixedArray($G->getV());
        $this->dfs($G, $s);
    }

    /**
     * @param $G Graph
     * @param $v SplInt
     */
    private function dfs($G, $v)
    {
        $this->count++;
        $this->marked[$v] = true;

        /** @var [] $adjacentArray */
        $adjacentArray = $G->adj($v);


        foreach ($adjacentArray as $w) {
            if (!$this->marked[$w]) {
                $this->dfs($G, $w);
            }
        }
    }


    /**
     * number of vertices connected to source
     * @return \SplInt
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return \boolean[]
     */
    public function getMarked()
    {
        return $this->marked;
    }
}
