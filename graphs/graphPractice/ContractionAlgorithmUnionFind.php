<?php
/**
 *
 * input: an undirected graph with parallel edges allowed
 *
 * output: compute a cut with the minimum number of crossing edges i.e. a min cut
 *
 * The Contraction alrgorithm finds the mimimum cut by randomly removing edges from a graph until there are only two nodes left
 * If after removing an edge between two nodes there are any self loops then they are removed automatically
 * The algorithm isn't guaranteed to reach the minimum cut on the first try so it must be run multiple times recording each result and then using the smallest found overall.
 *
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-06-07
 * Time: 11:47 AM
 */
require_once("../WeightedQuickUnionUF.php");

class ContractionAlgorithmUnionFind {

    private $edges; // @array
    private $points; // @unionfind

    public function __construct()
    {
        $this->edges = array();
        $this->points = new WeightedQuickUnionUF();
        $this->points->intialize_with_variable_size();
    }

//    public function addEdge($lo, $hi)
//    {
//
//    }

    public function addTwoVertices($a, $b)
    {
        $edge = new Edge($a, $b);
        $this->addEdge($edge);

        $this->points->add_new_vertice($a);
        $this->points->add_new_vertice($b);
//        $this->addEdgeToVertice($a, $edge);
//        $this->addEdgeToVertice($b, $edge);
    }


    public function addEdge(Edge $edge)
    {
        if (!in_array($edge, $this->edges))
        {
            $this->edges[] = $edge;
        }
    }

    public function shuffleEdges()
    {
        shuffle($this->edges);
    }

    public function contract()
    {
        // while there are two seperate roots in union find
        // randomly choose an edge from an array
        // check edge points don't have the same uniondfind root
        // if they have the same root then delete the edge so we don't have to search it again
        // remove the edge from the list
        // join edge lo and edge hi points together in the $points
        while ($this->points->count() > 2) {
            $randEdgeKey = array_rand($this->edges);
//            $randEdgeA = $randEdge
            $randEdgeA = $this->edges[$randEdgeKey]->lo;
            $randEdgeB = $this->edges[$randEdgeKey]->hi;

            if ($this->points->connected($randEdgeA, $randEdgeB)) {
                unset($this->edges[$randEdgeKey]);
            }
            else {
                $this->points->union($randEdgeA, $randEdgeB);
                unset($this->edges[$randEdgeKey]);
            }
        }

        // create counter to start counting remaining edges
        // while there are edges left
        // take random edge
        // if edge points are connected then delete edge
        // if edges points are unconnected then add to counter
        // return counter as this is the mincut
        $count = 0;
        while (count($this->edges) > 0) {
            $randEdgeKey = array_rand($this->edges);

            $randEdgeA = $this->edges[$randEdgeKey]->lo;
            $randEdgeB = $this->edges[$randEdgeKey]->hi;

            if ($this->points->connected($randEdgeA, $randEdgeB)) {
                unset($this->edges[$randEdgeKey]);
            }
            else {
//                $this->points->union($randEdgeA, $randEdgeB);
                unset($this->edges[$randEdgeKey]);
                $count++;
            }
        }

        return $count;
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
}
echo "<pre>";
$integerArray = array();

$ContractionAlgorithm = new ContractionAlgorithmUnionFind();

//$handle = fopen("kargerMinCutPractice.txt", "r");
$handle = fopen("kargerMinCut.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $integerArray[] = (int)$line;

//        $pieces = explode(" ", $line);
        $pieces = explode("\t", $line);

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

echo $ContractionAlgorithm->contract() . "<br/>";

//for($i = 0; $i < 1; $i++) {
//    $temp = clone $ContractionAlgorithm;
//    $temp->shuffleEdges();
//    echo $temp->contract() . "<br/>";
//}
