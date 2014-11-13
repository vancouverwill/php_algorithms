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

class ContractionAlgorithmSimplified {
    private $vertices; // array
    private $edges; // array
    private $renamedPoints; /* array */

    public function __construct()
    {
        $this->vertices = array();
        $this->edges = array();
    }


    public function addTwoVertices($a, $b)
    {
        $edge = new Edge($a, $b);
        if ($this->addEdge($edge)) {
            $this->addPointToVertice($a, $b);
            $this->addPointToVertice($b, $a);
        }
    }


    public function addEdge(Edge $edge)
    {
        if (!in_array($edge, $this->edges))
        {
            $this->edges[] = $edge;
            return true;
        }
        return false;
    }


    public function addPointToVertice($vertex, $point, $numberConnectionsToAdd = 1)
    {
        if (isset($this->vertices[$vertex][$point])) {
                $this->vertices[$vertex][$point] += $numberConnectionsToAdd;
        }
        else {
            $this->vertices[$vertex][$point] = $numberConnectionsToAdd;
        }
    }


    public function findEdge($a, $b)
    {
        $points = $this->vertices[$a];

        foreach ($points AS $point) {
            if ($points == $b) {
                return true;
            }
        }
        return false;
    }


    public function removeOneConnectingPoints($a, $b)
    {
        if (!isset($this->vertices[$a][$b]) || !isset($this->vertices[$b][$a])) return;
        if ($this->vertices[$a][$b] < 1 || $this->vertices[$b][$a] < 1) return;
        // find point with least edges coming from it so we can update this one call this removedVertex
        if (count($this->vertices[$a]) < count($this->vertices[$b])) {
            $removedVertex = $a;
            $stayingVertex = $b;
        }
        else {
            $stayingVertex = $a;
            $removedVertex = $b;
        }

        $this->renamedPoints[$removedVertex] = $stayingVertex;

        // for each point coming off removedVertex
        foreach ($this->vertices[$removedVertex] AS $pointIndex => $numberConnections ){

            if ($numberConnections < 1) continue;

            if ($pointIndex == $stayingVertex) continue;

            // find in vertices array and replace removedVertex with stayingVertex in this points edge set
//             $numberConnections = $this->vertices[$point][$removedVertex];
            unset($this->vertices[$pointIndex][$removedVertex]);
            $this->addPointToVertice($pointIndex, $stayingVertex, $numberConnections);
//            if (!isset($this->vertices[$pointIndex][$stayingVertex])) {
//                $this->vertices[$pointIndex][$stayingVertex] = $numberConnections;
//            }
//            else {
//                $this->vertices[$pointIndex][$stayingVertex] = $this->vertices[$pointIndex][$stayingVertex] + $numberConnections;
//            }
            // add this point to array of points in stayingVertices edge set
//            if (!isset($this->vertices[$stayingVertex][$pointIndex])) {
//                $this->vertices[$pointIndex][$stayingVertex] = $numberConnections;
//            }
//            else {
//                $this->vertices[$pointIndex][$stayingVertex] = $this->vertices[$pointIndex][$stayingVertex] + $numberConnections;
//            }
            $this->addPointToVertice($stayingVertex, $pointIndex, $numberConnections);
        }
        unset($this->vertices[$stayingVertex][$removedVertex]);
        unset($this->vertices[$removedVertex]);

    }


    /**
     * deprecated
     * @param $a
     * @param $b
     */
    public function deleteEdgesBetweenVertices($a, $b)
    {

        // need  to loop through all edges at a vertice so we delete any self loops
        foreach ($this->vertices[$a] AS $k => $point) {
            if ($point == $b) {
                unset($this->vertices[$a][$k]);
            }
        }

        if (count($this->vertices[$a]) == 0) {
            unset($this->vertices[$a]);
        }

        foreach ($this->vertices[$b] AS $k => $point) {
            if ($point == $a) {
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

    public function getNumberVerticesLeft()
    {
        return count($this->vertices);
    }

    public function getNumberConnectionLeft()
    {

//        $point = array_shift(array_values($this->vertices));
        $point = current($this->vertices);
        $connections = current($point);
        return $connections;
    }

    public function getRenamedName($pointIndex)
    {
        if (isset($this->renamedPoints[$pointIndex])) {

            return $this->getRenamedName($this->renamedPoints[$pointIndex]);
        }
        else {
            return $pointIndex;
        }
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
//            $this->deleteEdgesBetweenVertices($this->edges[$key]->lo, $this->edges[$key]->hi);

            $this->removeOneConnectingPoints($this->getRenamedName($this->edges[$key]->lo), $this->getRenamedName($this->edges[$key]->hi));

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

$ContractionAlgorithm = new ContractionAlgorithmSimplified();

//$ContractionAlgorithm->addTwoVertices(0, 1);
//$ContractionAlgorithm->addTwoVertices(0, 2);
//$ContractionAlgorithm->addTwoVertices(0, 3);
//$ContractionAlgorithm->addTwoVertices(3, 2);
//
//
//$ContractionAlgorithm2 = new ContractionAlgorithmSimplified();
//
//$ContractionAlgorithm2->addTwoVertices(2, 1);
//$ContractionAlgorithm2->addTwoVertices(0, 2);
//$ContractionAlgorithm2->addTwoVertices(0, 3);
//$ContractionAlgorithm2->addTwoVertices(3, 1);

@set_time_limit(60*60*24);

$handle = fopen("kargerMinCut.txt", "r");
//$handle = fopen("kargerMinCutPractice.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $integerArray[] = (int)$line;

        $pieces = explode("\t", $line);
//        $pieces = explode(" ", $line);

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

//$var = 20;

//$ContractionAlgorithm->deleteEdgeFromEdges(2, 3);
//$ContractionAlgorithm->deleteEdgesBetweenVertices(2, 3);
//
//$ContractionAlgorithm->deleteEdgeFromEdges(0, 1);
//$ContractionAlgorithm->deleteEdgesBetweenVertices(0, 1);

$n = $ContractionAlgorithm->getNumberVerticesLeft();

//$ContractionAlgorithm->randomContractionAlogrithm();

$smallestAmountConnections;

for ($i = 0; $i < ($n * $n); $i++) {

    $temp = clone $ContractionAlgorithm;
    $temp->randomContractionAlogrithm();

    if (!isset($smallestAmountConnections)) {
        $smallestAmountConnections = $temp->getNumberConnectionLeft();
    }
    else {
        if ($temp->getNumberConnectionLeft() < $smallestAmountConnections) {
            $smallestAmountConnections = $temp->getNumberConnectionLeft();
        }
    }
}

echo $smallestAmountConnections;
//
$var = 20;


//echo ($ContractionAlgorithm2->getNumberEdgesLeft());