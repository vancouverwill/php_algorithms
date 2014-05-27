<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-05-26
 * Time: 9:59 PM
 */

class ContractionAlgorithm {
    private $vertices; // array
    private $edges; // array

    public function __construct()
    {
        $this->vertices = array();
        $this->edges = array();
    }

    public function addTwoVertices($a, $b)
    {
        $edge = new Edge($a, $b);
        $this->edges[] = $edge;
        $this->vertices[$a][] = $edge;
        $this->vertices[$b][] = $edge;
    }

    public function findEdge($a, $b)
    {
        $edges = $this->vertices[$a];

        foreach ($edges AS $edge) {
            if ($edge->equals($a, $b)) {
                return true;
            }
        }
        return false;
    }


    public function deleteEdge($a, $b)
    {
        $edges = $this->vertices[$a];

        foreach ($edges AS $k => $edge) {
            if ($edge->equals($a, $b)) {
                unset($edges[$k]);
            }
        }
    }
}

class Edge {
    public $lo;
    public $hi;

    public function __construct($start, $end)
    {
        if ($start < $end) {
            $this->lo = $start;
            $this->hi = $end;
        }
        else {
            $this->hi = $start;
            $this->lo = $end;
        }
    }


    public function equals($start, $end)
    {
        if ($start < $end) {
            if ($this->lo == $start && $this->hi == $end) {
                return true;
            }
        }
        else {
            if ($this->hi == $start && $this->lo == $end) {
                return true;
            }
        }
        return false;
    }
}