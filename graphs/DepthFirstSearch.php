<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-06-08
 * Time: 10:03 PM
 */

class DepthFirstSearch
{
    /** @var  boolean[] */
    private $marked;
    /** @var  SplInt */
    private $count;



    /**
     * @param $G MyGraph
     * @param $s SplInt
     */
    public function __construct( $G, $s)
    {
        $this->marked = new SplFixedArray($G.V());
        $this->dfs($G, $s);
    }

    /**
     * @param $G MyGraph
     * @param $v SplInt
     */
    private function dfs($G, $v)
    {
        $this->count++;
        $this->marked[$v] = true;

        /** @var [] $adjacentArray */
        $adjacentArray = $G->adj($v);


        foreach ($adjacentArray AS $w) {
            if (!$this->marked[$w]) {
                $this->dfs($G, $w);
            }
        }
    }


    /**
     * @return \SplInt
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return \booean[]
     */
    public function getMarked()
    {
        return $this->marked;
    }

}
