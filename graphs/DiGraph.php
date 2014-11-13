<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 2014-11-12
 * Time: 9:55 PM
 */

class DiGraph
{
    private $v; /** @var  int */
    private $e; /** @var  int */
    private $adj; /** @var SplFixedArray fixed array of ??? */


    public function DiGraph($v)
    {
        $this->v = $v;
        $this->e = 0;
        $this->adj = new SplFixedArray($v);
        for($i = 0; $i < $this->v; $i++) {
            $this->adj[$i] = new SplStack();
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


    public function addEdge($v, $w)
    {
        $this->adj[$v]->add($w);
    }


    public function adj($v)
    {
        if ($v < 0 || $v >= $this->v) throw new InvalidArgumentException();
        return $this->adj[$v];
    }
}