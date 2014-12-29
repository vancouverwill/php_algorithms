<?php
/**
 * Calculate the minimum cut using the randomized contraction algorithm
 *
 *
 * We need to run the minimum cut algorithm enough times to make the chances of hitting the minimum cut sufficient.
 *
 * Contraction Algorithm using two Adjacency Lists
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-05-26
 * Time: 9:59 PM
 */
namespace PHP_Algorithms\graphs;

require_once('../WeightedQuickUnionUF.php');

class ContractionAlgorithmSimplified
{
    private $vertices; /** @var WeightedQuickUnionUF  */
    private $edges; /** @var array */
    private $n; /** @var int */
    private $remainingConnections; /**  @var int */


    public function __construct()
    {
        $this->vertices = new WeightedQuickUnionUF();

        $this->edges = array();
    }


    /**
     * set number of vertices
     *
     */
    public function setN($n)
    {
        $this->n = $n;
    }


    public function addTwoVertices($a, $b)
    {
        $edge = new Edge($a, $b);
        if ($this->addEdge($edge)) {
        }
    }


    public function addEdge(Edge $edge)
    {
        if (!in_array($edge, $this->edges)) {
            $this->edges[] = $edge;
            return true;
        }
        return false;
    }


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


    public function randomContractionAlogrithm()
    {
        $this->vertices->reset();
        $this->vertices->createFixedSize($this->n + 1);

        $this->remainingConnections = count($this->edges);

        // for each edge we remove we remove one point. We want to leave 2 points so remove number of points - 2

        $remaingPoints = $this->n;

        while ($remaingPoints > 2) {
//           pick a remaining edge (u,v) uniformly at random
            $key = array_rand($this->edges);
//            if (($key) == null) break;

            if ($this->vertices->connected($this->edges[$key]->lo, $this->edges[$key]->hi) == true) {
                continue;
            }

            $this->vertices->union($this->edges[$key]->lo, $this->edges[$key]->hi);
            unset($this->edges[$key]);

            $remaingPoints--;
        }

        $count = 0;
        foreach ($this->edges as $edge) {
            if ($this->vertices->connected($edge->lo, $edge->hi) == true) {
                continue;
            } else {
                $count++;
            }
        }

        $this->remainingConnections = $count;
    }
}


class Edge
{
    public $lo;
    public $hi;

    public function __construct($start, $end)
    {
        if ($start < $end) {
            $this->lo = $start;
            $this->hi = $end;
        } else {
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
        } else {
            if ($this->hi == $start && $this->lo == $end) {
                return true;
            }
        }
        return false;
    }
}


$ContractionAlgorithm = new ContractionAlgorithmSimplified();


@set_time_limit(60*60*24);

$startTime = microtime(true);

//$handle = fopen("kargerMinCut.txt", "r");
//$handle = fopen("./kargerMinCutPracticev1ans2.txt", "r");
//$handle = fopen("./kargerMinCutPracticev2ans3.txt", "r");
//$handle = fopen("./kargerMinCutPracticev3ans1.txt", "r");
//$handle = fopen("./kargerMinCutPracticev4ans3.txt", "r");
//$handle = fopen("./kargerMinCutPracticev5ans1.txt", "r");
$handle = fopen("kargerMinCutPractice.txt", "r");

$uniqueNumbers = array();
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $integerArray[] = (int)$line;

        $line = str_replace("\n", "", $line);
        $line = rtrim($line);

        $pieces = preg_split('/\s+/', $line);

        $a = (int)$pieces[0];
        if ($a == 0) {
            exit("we shouldn't ever have 0");
        }

        if (!in_array($a, $uniqueNumbers)) {
            $uniqueNumbers[$a] = $a;
        }

        if (count($pieces) > 1) {
            for ($i = 1; $i < count($pieces); $i++) {
                $b = (int)$pieces[$i];
                $ContractionAlgorithm->addTwoVertices($a, $b);
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

$smallestAmountConnections = INF;


for ($i = 0; $i < ($n * $n * floor(log($n, 2))); $i++) {
    $algorithmCopy = clone $ContractionAlgorithm;
    $algorithmCopy->randomContractionAlogrithm();


    if ($algorithmCopy->getNumberConnectionsLeft() < $smallestAmountConnections) {
        $smallestAmountConnections = $algorithmCopy->getNumberConnectionsLeft();
    }

    unset($algorithmCopy);
}

echo $smallestAmountConnections . "<br/>" . "<br/>";


$endTime = microtime(true);

$timeDifference = $endTime - $startTime;

echo PHP_EOL . PHP_EOL . "TimeDifference " . $timeDifference;
echo PHP_EOL . PHP_EOL . "Start Time " . $startTime;
echo PHP_EOL . PHP_EOL . "End Time " . $endTime . PHP_EOL . PHP_EOL;
