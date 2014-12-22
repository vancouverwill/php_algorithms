<?php

namespace PHP_Algorithms\graphs;

require_once("../vendor/autoload.php");

class DepthFirstOrder
{

    private $marked;    /** @var SplFixedArray boolean  */

    private $pre;       /** @var SplFixedArray int pre[v] = preorder  number of v */
    private $post;      /** @var SplFixedArray int post[v] = postorder number of v */

    private $preOrder;       /** @var SplQueue int preorder vertices in preorder */
    private $postOrder;      /** @var SplQueue int postorder vertices in postorder */

    private $preCounter;    /** @var int counter for preorder numbering */
    private $postCounter;    /** @var int counter for postorder numbering */

    private $reversePost;    /** @var SplStack int vertices in reverse postorder  */


    public function __construct(DiGraph $G)
    {
            $this->pre = new \SplFixedArray($G->getV());
        $this->post = new \SplFixedArray($G->getV());
        $this->preOrder = new \SplQueue();
        $this->postOrder = new \SplQueue();
        $this->reversePost = new \SplStack();
        $this->marked = new \SplFixedArray($G->getV());

        for ($v = 0; $v < $G->getV(); $v++) {
            if (!$this->marked[$v]) {
                $this->dfs($G, $v);
            }
        }
    }


    public function dfs(DiGraph $G, $v)
    {
        $this->marked[$v] = true;
        $this->pre[$v] = $this->preCounter++;
        $this->preOrder->enqueue($v);

        $stack = $G->adj($v);


        foreach ($G->adj($v) as $index => $w) {
            if (!$this->marked[$w]) {
                $this->dfs($G, $w);
            }
        }

        $this->postOrder->enqueue($v);
        $this->post[$v] = $this->postCounter++;
    }

    public function preOrder()
    {
        return $this->preOrder;
    }


    public function postOrder()
    {
        return $this->postOrder;
    }

    /**
     * return vertices in reverse postorder as an Iterable
     */
    public function reversePostOrder()
    {
        $reverse = new \SplStack();

        $this->postOrder->rewind();
        while ($this->postOrder->valid()) {
            $vertice = $this->postOrder->current();
            $reverse->push($vertice);
            $this->postOrder->next();
        }

        return $reverse;
    }
}


function exampleDepthFirstOrder()
{
    $filename = "DiGraphTestData1.txt";
//$filename = "KosarajuSCCLargeDataSet.txt";



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

    $example = new DepthFirstOrder(($digraph));

    foreach ($example->preOrder() as $item) {
        echo $item . " ";
    }

    echo "<br/>";
    echo "<br/>";

    foreach ($example->postOrder() as $item) {
        echo $item . " ";
    }
}

//exampleDepthFirstOrder();
