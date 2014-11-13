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

require_once('../WeightedQuickUnionUF.php');

class ContractionAlgorithmSimplified {
    private $vertices; /** @var WeightedQuickUnionUF  */
    private $edges; /** @var array */
    private $n; /** @var int */
    private $remainingConnections; /**  @var int */
//    private $renamedPoints; /* array */

    public function __construct()
    {
        $this->vertices = new WeightedQuickUnionUF();

        $this->edges = array();
    }

    public function setN($n)
    {
        $this->n = $n;
    }


    public function addTwoVertices($a, $b)
    {
        $edge = new Edge($a, $b);
        if ($this->addEdge($edge)) {
//            $this->addPointToVertice($a, $b);
//            $this->addPointToVertice($b, $a);
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


//    public function addPointToVertice($vertex, $point, $numberConnectionsToAdd = 1)
//    {
//        if (isset($this->vertices[$vertex][$point])) {
//                $this->vertices[$vertex][$point] += $numberConnectionsToAdd;
//        }
//        else {
//            $this->vertices[$vertex][$point] = $numberConnectionsToAdd;
//        }
//    }


//    public function findEdge($a, $b)
//    {
//        $points = $this->vertices[$a];
//
//        foreach ($points AS $point) {
//            if ($points == $b) {
//                return true;
//            }
//        }
//        return false;
//    }


   /* public function removeOneConnectingPoints($a, $b)
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
        /* foreach ($this->vertices[$removedVertex] AS $pointIndex => $numberConnections ){

            if ($numberConnections < 1) continue;

            if ($pointIndex == $stayingVertex) continue;

            // find in vertices array and replace removedVertex with stayingVertex in this points edge set
            unset($this->vertices[$pointIndex][$removedVertex]);
            $this->addPointToVertice($pointIndex, $stayingVertex, $numberConnections);

            // add this point to array of points in stayingVertices edge set
            $this->addPointToVertice($stayingVertex, $pointIndex, $numberConnections);
        } */
      /*  unset($this->vertices[$stayingVertex][$removedVertex]);
        unset($this->vertices[$removedVertex]);

    }*/


    /**
     * deprecated
     * @param $a
     * @param $b
     */
//    public function deleteEdgesBetweenVertices($a, $b)
//    {
//
//        // need  to loop through all edges at a vertice so we delete any self loops
//        foreach ($this->vertices[$a] AS $k => $point) {
//            if ($point == $b) {
//                unset($this->vertices[$a][$k]);
//            }
//        }
//
//        if (count($this->vertices[$a]) == 0) {
//            unset($this->vertices[$a]);
//        }
//
//        foreach ($this->vertices[$b] AS $k => $point) {
//            if ($point == $a) {
//                unset($this->vertices[$b][$k]);
//            }
//        }
//
//        if (count($this->vertices[$b]) == 0) {
//            unset($this->vertices[$b]);
//        }
//    }


    /**
     * DEPRECATED works but way too slow
     */
    public function deleteEdgeFromEdges($a, $b)
    {
        foreach ($this->edges AS $k => $edge) {
            if ($edge->equals($a, $b)) {


                unset($this->edges[$k]);
            }
        }
    }


//    public function getNumberEdgesLeft()
//    {
//        return count($this->edges);
//    }
//
//    public function getNumberVerticesLeft()
//    {
//        return count($this->vertices);
//    }

    public function getNumberConnectionsLeft()
    {
        return $this->remainingConnections;
    }


    /**
     * get number of nodes
     * @return int
     */
    public function getN()
    {
        return $this->n;
    }

    public function getM()
    {
        return count($this->edges);
    }

//    public function getNumberConnectionLeft()
//    {
//
////        $point = array_shift(array_values($this->vertices));
//        $point = current($this->vertices);
//        $connections = current($point);
//        return $connections;
//    }

//    public function getRenamedName($pointIndex)
//    {
//        if (isset($this->renamedPoints[$pointIndex])) {
//
//            return $this->getRenamedName($this->renamedPoints[$pointIndex]);
//        }
//        else {
//            return $pointIndex;
//        }
//    }

    public function randomContractionAlogrithm()
    {
//        $this->vertices->intializeWithVariableSize();
//
//        for ($i = 0; $i <= ($this->n); $i++) {
//            $this->vertices->addNewVertice($i);
//        }

        $this->vertices->reset();
        $this->vertices->createFixedSize($this->n + 1);

        $this->remainingConnections = count($this->edges);
        // for each edge we remove we remove one point. We want to leave 2 points so remove number of points - 2
        for ($i = 0; $i < ($this->n - 2); $i++) {
//           pick a remaining edge (u,v) uniformly at random
            $key = array_rand($this->edges);
            if (($key) == null) break;
//            $this->vertices->addNewVertice($this->edges[$key]->lo);
//            $this->vertices->addNewVertice($this->edges[$key]->hi);

            $this->vertices->union($this->edges[$key]->lo, $this->edges[$key]->hi);
//            $this->deleteEdgeFromEdges($this->edges[$key]->lo, $this->edges[$key]->hi);
            unset($this->edges[$key]);
        }

        $count = 0;
        foreach ($this->edges AS $edge) {
            if ($this->vertices->connected($edge->lo, $edge->hi) == true) {
                continue;
            }
            else {
                $count++;
            }
        }

        $this->remainingConnections = $count;
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
//    public function updatePointIfExists($old, $new)
//    {
//        if ($this->lo == $old) {
//            $this->old = $new;
//        }
//        elseif ($this->hi == $old) {
//            $this->hi = $new;
//        }
//        else {
//            return false;
//        }
//    }


//    public function other($a) {
//        if ($this->lo == $a) {
//            return $this->old;
//        }
//        elseif ($this->hi == $a) {
//            return $this->hi;
//        }
//        else {
//            return false;
//        }
//    }
}

//$integerArray = array();

//$ContractionAlgorithm = new ContractionAlgorithmSimplified();

//$ContractionAlgorithm->addTwoVertices(0, 1);
//$ContractionAlgorithm->addTwoVertices(0, 2);
//$ContractionAlgorithm->addTwoVertices(0, 3);
//$ContractionAlgorithm->addTwoVertices(3, 2);
//
//
$ContractionAlgorithm = new ContractionAlgorithmSimplified(200);
//
//$ContractionAlgorithm->addTwoVertices(2, 1);
//$ContractionAlgorithm->addTwoVertices(0, 2);
//$ContractionAlgorithm->addTwoVertices(0, 3);
//$ContractionAlgorithm->addTwoVertices(3, 1);
//$ContractionAlgorithm->addTwoVertices(3, 2);
//$ContractionAlgorithm->addTwoVertices(0, 1);

@set_time_limit(60*60*24);

$startTime = microtime(true);

$handle = fopen("kargerMinCut.txt", "r");
//$handle = fopen("./kargerMinCutPracticev1ans2.txt", "r");
//$handle = fopen("./kargerMinCutPracticev2ans3.txt", "r");
//$handle = fopen("kargerMinCutPractice.txt", "r");

$uniqueNumbers = array();
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $integerArray[] = (int)$line;

        $pieces = explode("\t", $line);
//        $pieces = explode(" ", $line);

        $a = (int)$pieces[0];
        if (!in_array($a, $uniqueNumbers)) {
            $uniqueNumbers[] = $a;
        }

        if (count($pieces) > 1) {
            for ($i = 1; $i < count($pieces); $i++ ) {
                $ContractionAlgorithm->addTwoVertices($a, (int)$pieces[$i]);
                if (!in_array((int)$pieces[$i], $uniqueNumbers)) {
                    $uniqueNumbers[] = (int)$pieces[$i];
                }
            }
        }


    }
} else {
    // error opening the file.
}
fclose($handle);

$ContractionAlgorithm->setN(count($uniqueNumbers));

$n = $ContractionAlgorithm->getN();

//$n = 300;
//$ContractionAlgorithm->randomContractionAlogrithm();

$smallestAmountConnections = INF;
$temp = log($n, 2);

for ($i = 0; $i < ($n * $n * floor(log($n, 2))); $i++) {
//for ($i = 0; $i < 2; $i++) {

    $temp = clone $ContractionAlgorithm;
    $temp->randomContractionAlogrithm();

//    if (!isset($smallestAmountConnections)) {
//        $smallestAmountConnections = $temp->getNumberConnectionsLeft();
//    }
//    else {
        if ($temp->getNumberConnectionsLeft() < $smallestAmountConnections) {
            $smallestAmountConnections = $temp->getNumberConnectionsLeft();
        }
//    }

    unset($temp);
}

echo $smallestAmountConnections;
//
$var = 20;

$endTime = microtime(true);

$timeDifference = $endTime - $startTime;

echo PHP_EOL . PHP_EOL . "TimeDifference " . $timeDifference;
echo PHP_EOL . PHP_EOL . "Start Time " . $startTime;
echo PHP_EOL . PHP_EOL . "End Time " . $endTime . PHP_EOL . PHP_EOL;
