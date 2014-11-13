<?php
/**
 * this was how I first envisioned doing the contraction algorithm with an adjacency list being an array of vertices each listing an array of edges
 *
 * Contraction Algorithm using two Adjacency Lists
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

        if (count($this->vertices[$a]) == 0) {
            unset($this->vertices[$a]);
        }

        foreach ($this->vertices[$b] AS $k => $edge) {
            if ($edge->equals($a, $b)) {
                unset($this->vertices[$b][$k]);
            }
        }

        if (count($this->vertices[$b]) == 0) {
            unset($this->vertices[$b]);
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


    public function getNumberEdgesLeft()
    {
        return count($this->edges);
    }

    public function randomContractionAlogrithm()
    {
        //While there are more than 2 vertices:
        while(count($this->vertices) > 2) {
//           pick a remaining edge (u,v) uniformly at random
            $key = array_rand($this->edges);

//            $key = 1;

//            $edgeLo;

//            merge (or “contract” ) u and v into a single vertex
//            remove self-loops
            $this->deleteEdgesBetweenVertices($this->edges[$key]->lo, $this->edges[$key]->hi);

            $this->deleteEdgeFromEdges($this->edges[$key]->lo, $this->edges[$key]->hi);

            /* if both vertics have at least 1 edge start reassigning points

                find vertice with most edges off of it, set as $hi and the other as $lo

               for each edge off of $lo {
                    $other = reassign whichever point which was set to low to set to hi (return in functon other end and label $other)
                    add an edge on to high vertice from $hi to $other
                    get vertice at $other and find any edge which points to lo and reassgin to point to hi
                }
            }
            */




//            find vertex which is free hanging by looking for the vertex with least edges
            // find the vertex from this edge which has the fewest edges touching it and call this lo and the other one hi
            /*if (count($this->vertices[$this->edges[$key]->lo]) < count($this->vertices[$this->edges[$key]->hi])) {
                $lo = $this->edges[$key]->lo;
                $hi = $this->edges[$key]->hi;
            }
            else {
                $hi = $this->edges[$key]->lo;
                $lo = $this->edges[$key]->hi;
            }*/

            // all the edges incident to lo, update their vertex from lo to hi
//            foreach($this->edges[$lo] AS $key => $edge) {
//                $otherEnd = $edge->other($lo);
//                foreach($this->edges[$otherEnd] AS $key => $otherEdge) {
//                    $otherEdge->updatePoint($lo, $hi);
//                }
//                $edge->updatePoint($lo, $hi);
//            }

            /*foreach($this->edges AS $key => $edge) {
                $edge->updatePointIfExists($lo, $hi);
            }

            foreach($this->vertices[$lo] AS $edge) {
                $opposingPoint = $edge->other($lo);


                foreach($this->vertices[$opposingPoint] AS $opposingEdge) {
                    $edge->updatePointIfExists($lo, $hi);
                }
            } */

            //  now delete that free hanging vertex with no edges (lo)
            /*($this->vertices[$lo] = null;*/
            //finally remove the edge off the edge array


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


    /**
     *
     * Point end of edge to new point
     *
     * @param $old
     * @param $new
     * @return bool
     */
    public function updatePointIfExists($old, $new)
    {
        if ($this->lo == $old) {
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
        if ($this->lo == $a) {
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

$ContractionAlgorithm->addTwoVertices(0, 1);
$ContractionAlgorithm->addTwoVertices(0, 2);
$ContractionAlgorithm->addTwoVertices(0, 3);
$ContractionAlgorithm->addTwoVertices(3, 2);


$ContractionAlgorithm2 = new ContractionAlgorithm();

$ContractionAlgorithm2->addTwoVertices(2, 1);
$ContractionAlgorithm2->addTwoVertices(0, 2);
$ContractionAlgorithm2->addTwoVertices(0, 3);
$ContractionAlgorithm2->addTwoVertices(3, 1);



/* $handle = fopen("kargerMinCutPractice.txt", "r");
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
fclose($handle); */

//$var = 20;

//$ContractionAlgorithm->deleteEdgeFromEdges(2, 3);
//$ContractionAlgorithm->deleteEdgesBetweenVertices(2, 3);
//
//$ContractionAlgorithm->deleteEdgeFromEdges(0, 1);
//$ContractionAlgorithm->deleteEdgesBetweenVertices(0, 1);

$ContractionAlgorithm2->randomContractionAlogrithm();
//
$var = 20;

echo ($ContractionAlgorithm2->getNumberEdgesLeft());