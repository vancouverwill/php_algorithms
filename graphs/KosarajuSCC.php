<?php
/**
 * Here we will Kosaraju’s Two-­‐Pass Algorith
 * to calculate strongly connected componenets
 * Strongly connected components in a directed graph are directed cycles within the graph
 *
 * let grev = G with all arcs reversed
 *
 * run dfs loop on Grev
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

require_once("./DiGraph.php");
require_once("./DepthFirstOrder.php");
//require_once("./DepthFirstOrderNonRecursive.php");
 
class KosarajuSCC
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
        $order = new DepthFirstOrder($reverseGraph);
//        $order = new DepthFirstOrderNonRecursive($reverseGraph);


        $this->currentComponentSize = 0;
        $this->stronglyConnectedComponents = new \SplMaxHeap();

        foreach ($order->reversePostOrder() as $s) {
            if (!$this->marked[$s]) {
                $this->dfs($G, $s);
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




function testKosarajuSCC($filename) {

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


    $kosaraju = new KosarajuSCC($digraph);


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
//$filename = "KosarajuSCCLargeDataSet.txt";

testKosarajuSCC($filename);