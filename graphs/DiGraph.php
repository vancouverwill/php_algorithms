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
    private $adj; /** @var SplFixedArray fixed array of Stacks each stack storing all the vertices connected to that vertices */


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
        if (!isset($this->adj[$v])) {
            exit("v is " . $v);
        }
        $this->adj[$v]->push($w);
    }


    public function adj($v)
    {
        if ($v < 0 || $v >= $this->v) throw new InvalidArgumentException();
        return $this->adj[$v];
    }

    public function reverse()
    {
        $r = new DiGraph($this->v);
        for ($v = 0; $v < $this->v; $v++) {
            $this->adj($v)->rewind();
            while ($this->adj($v)->valid()) {
                $vertice = $this->adj($v)->current();
                $r->addEdge($vertice, $v);
                $this->adj($v)->next();
            }
        }
        return $r;
    }
}