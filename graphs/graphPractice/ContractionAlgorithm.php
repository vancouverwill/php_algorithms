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
        $this->addEdge($edge);
        $this->addEdgeToVertice($a, $edge);
        $this->addEdgeToVertice($b, $edge);
    }


    public function addEdge(Edge $edge)
    {
        if (!in_array($edge, $this->edges))
        {
            $this->edges[] = $edge;
        }
    }


    public function addEdgeToVertice($vertice, Edge $edge)
    {
        if (isset($this->vertices[$vertice])) {
            if (!in_array($edge, $this->vertices[$vertice])) {
                $this->vertices[$vertice][] = $edge;
            }
        }
        else {
            $this->vertices[$vertice][] = $edge;
        }
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


    public function deleteEdgesBetweenVertices($a, $b)
    {

        // need  to loop through all edges at a vertice so we delete any self loops
        foreach ($this->vertices[$a] AS $k => $edge) {
            if ($edge->equals($a, $b)) {


                unset($this->vertices[$a][$k]);
            }
        }
    }

    public function deleteEdgeFromEdges($a, $b)
    {
        foreach ($this->edges AS $k => $edge) {
            if ($edge->equals($a, $b)) {


                unset($this->edges[$k]);
            }
        }
    }

    public function randomContractionAlogrithm()
    {
        //While there are more than 2 vertices:
        while(count($this->vertices > 2)) {
//           pick a remaining edge (u,v) uniformly at random
            $key = array_rand($this->edges);

            $key = 1;

//            merge (or “contract” ) u and v into a single vertex
//            remove self-loops
            $this->deleteEdgesBetweenVertices($this->edges[$key]->lo, $this->edges[$key]->hi);
//            find vertex which is free hanging by looking for the vertex with just one loop
            // find the vertex from this edge which has the fewest edges touching it and call this lo and the other one hi
            if (count($this->vertices[$this->edges[$key]->lo]) < count($this->vertices[$this->edges[$key]->hi])) {
                $lo = $this->edges[$key]->lo;
                $hi = $this->edges[$key]->hi;
            }
            else {
                $hi = $this->edges[$key]->lo;
                $lo = $this->edges[$key]->hi;
            }

            // all the edges incident to lo, update their vertex from lo to hi
            foreach($this->edges[$lo] AS $key => $edge) {
                $otherEnd = $edge->other($lo);
                foreach($this->edges[$otherEnd] AS $key => $otherEdge) {
                    $otherEdge->updatePoint($lo, $hi);
                }
                $edge->updatePoint($lo, $hi);
            }
            //  now delete that free hanging vertex with no edges (lo)
            $this->vertices[$lo] = null;
            //finally remove the edge off the edge array
            //            delete edge off of edges list
            $this->

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


    public function updatePoint($old, $new)
    {
        if ($this->low == $old) {
            $this->old = $new;
        }
        elseif ($this->hi == $old) {
            $this->hi = $new;
        }
        else {
            return false;
        }
    }


    public function other($a) {
        if ($this->low == $a) {
            return $this->old;
        }
        elseif ($this->hi == $a) {
            return $this->hi;
        }
        else {
            return false;
        }
    }
}

$integerArray = array();

$ContractionAlgorithm = new ContractionAlgorithm();

$handle = fopen("kargerMinCutPractice.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $integerArray[] = (int)$line;

        $pieces = explode(" ", $line);

        $a = (int)$pieces[0];

        if (count($pieces) > 1) {
            for ($i = 1; $i < count($pieces); $i++ ) {
                $ContractionAlgorithm->addTwoVertices($a, (int)$pieces[$i]);
            }
        }


    }
} else {
    // error opening the file.
}
fclose($handle);

$var = 20;

$ContractionAlgorithm->deleteEdge(1, 3);


$var = 20;