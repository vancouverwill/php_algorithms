<?php
/**
 *
 * Run :
 *
 * php KosarajuSCCnonRecursive.php
 *
 *
 * Here we will Kosaraju’s Two-­‐Pass Algorithm
 * to calculate strongly connected components
 * Strongly connected components in a directed graph are directed cycles within the graph
 *
 * let gRev = G with all arcs reversed
 *
 * run dfs loop on gRev
 * starting with highest number node and working down
 * goal : compute "magical ordering" of nodes
 * let f(V) = "finishing time" of each v in V
 *
 *
 * run dfs loop on G
 * goal discover the SCCs one-by-one
 * processing nodes in decreasing order of finishing times
 *
 * [SCCs = nodes with the same “leader” ]
 *
 * Created by PhpStorm.
 *
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 2014-11-30
 * Time: 10:03 PM
 */
namespace PHP_Algorithms\graphs;

require_once(__DIR__ . "/../vendor/autoload.php");


class KosarajuSCCnonRecursive
{
    private $marked; /** @var SplFixedArray */
    private $id;   /** @var SplFixedArray */
    private $count; /** @var int */

    public $stronglyConnectedComponents; /** @var splStack */
    private $currentComponentSize;  /** @var SplMaxHeap */


    public function __construct(DiGraph $G)
    {
        $this->marked = new \SplFixedArray($G->getV());
        $this->id = new \SplFixedArray($G->getV());
        $this->count = 0;
        $reverseGraph = $G->reverse();
        ;
        $order = new DepthFirstOrderNonRecursive($reverseGraph);


        $this->dfsStack = new \SplStack();


        $this->currentComponentSize = 0;
        $this->stronglyConnectedComponents = new \SplMaxHeap();

        foreach ($order->reversePostOrder() as $s) {
            if (!$this->marked[$s]) {
                $this->dfsNonRecursive($G, $s);
                $this->stronglyConnectedComponents->insert($this->currentComponentSize);
                $this->count++;
                $this->currentComponentSize = 0;
            }
        }
    }


    /**
     * DFS on graph
     */
    public function dfs($G, $v)
    {
        $this->marked[$v] = true;
        $this->currentComponentSize++;
        $this->id[$v] = $this->count;

        $G->adj($v)->rewind();
        while ($G->adj($v)->valid()) {
            $w = $G->adj($v)->current();
            if (!$this->marked[$w]) {
                $this->dfs($G, $w);
            }
            $G->adj($v)->next();
        }
    }


    public function dfsNonRecursive($G, $v)
    {
        $this->dfsStack->push($v);

        $this->dfsStack->rewind();

        $this->marked[$v] = true;

        while ($this->dfsStack->valid() && !$this->dfsStack->isEmpty()) {
            $w = $this->dfsStack->pop();

            $this->marked[$w] = true;
            if (!isset($this->id[$w])) {
                $this->currentComponentSize++;
                $this->id[$w] = $this->count;
            }

            $G->adj($w)->rewind();
            while ($G->adj($w)->valid()) {
                $x = $G->adj($w)->current();
                if (!$this->marked[$x]) {
                    $this->dfsStack->push($x);
                }
                $G->adj($w)->next();
            }


        }
    }


    public function stronglyConnected($v, $w)
    {
        return $this->id[$v] == $this->id[$w];
    }


    public function id($v)
    {
        return $this->id[$v];
    }


    public function count()
    {
        return $this->count;
    }
}




function testKosarajuSCCnonRecursive($filename) {

    $handle = fopen($filename, "r");
    $uniqueNumbers = array();
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $line = str_replace("\n", "", $line);
            $vertices = preg_split('/\s+/', $line);
            foreach ($vertices as $vertice) {
                $uniqueNumbers[(int)$vertice] = true;
            }
        }
    } else {
        // error opening the file.
        "no file exists";
    }
    fclose($handle);

    echo 'we have ' . count($uniqueNumbers) . ' unique numbers' . PHP_EOL;

    $digraph = new DiGraph(count($uniqueNumbers));



    $handle = fopen($filename, "r");

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $line = str_replace("\n", "", $line);
            $vertices = preg_split('/\s+/', $line);
            $digraph->addEdge((int)$vertices[0] - 1, (int)$vertices[1] - 1);
        }
    } else {
        // error opening the file.
        "no file exists";
    }
    fclose($handle);


    $kosaraju = new KosarajuSCCnonRecursive($digraph);


    echo "count is " . $kosaraju->count() . "<br/>" . "<br/>";

    $count = 0;

    foreach ($kosaraju->stronglyConnectedComponents as $stronglyConnectedComponents) {
        echo $stronglyConnectedComponents . ",";

        if ($count > 5) {
            break;
        }
    }
}


$filename = "DiGraphTestData1.txt";
$filename = "DiGraphTestData1.txt";
//$filename = "KosarajuSCCLargeDataSet.txt";

testKosarajuSCCnonRecursive($filename);
