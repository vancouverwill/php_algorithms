<?php
/**
 * this was second version of the contraction algorithm with an adjacency list being an array of vertices each listing an array of edges
 * this worked correctly but took too long to run
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

            if ($pointIndex == $stayingVertex) continue; // ignore if pointing back to itself as is self loop

            //remove removedVertex as one of the points from this vertex
            unset($this->vertices[$pointIndex][$removedVertex]);
            // replace removedVertex with stayingVertex in this points edge set
            $this->addPointToVertice($pointIndex, $stayingVertex, $numberConnections);
            // add this point to array of points in stayingVertices edge set
            $this->addPointToVertice($stayingVertex, $pointIndex, $numberConnections);
        }
        unset($this->vertices[$stayingVertex][$removedVertex]);
        unset($this->vertices[$removedVertex]);

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


    /**
     * when you get down to two remaining vertices find either first point
     * and then first point coming from it and that is the number of connections
     *
     * @return int
     */
    public function getNumberConnectionLeft()
    {
        if (count($this->vertices) > 2) throw exception();
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

            $this->removeOneConnectingPoints($this->getRenamedName($this->edges[$key]->lo), $this->getRenamedName($this->edges[$key]->hi));

            $this->deleteEdgeFromEdges($this->edges[$key]->lo, $this->edges[$key]->hi);

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


//$ContractionAlgorithm2 = new ContractionAlgorithmSimplified();

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
//                $ContractionAlgorithm->addTwoVertices($a, (int)$pieces[$i]);
            }
        }


    }
} else {
    // error opening the file.
}
fclose($handle);


$n = $ContractionAlgorithm->getNumberVerticesLeft();

$n = 1;

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
