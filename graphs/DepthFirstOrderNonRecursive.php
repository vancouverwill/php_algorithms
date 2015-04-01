<?php

namespace PHP_Algorithms\graphs;

require_once("./DiGraph.php");

class DepthFirstOrderNonRecursive
{
    private $debug = false;

    private $marked;    /** @var SplFixedArray boolean  */

    private $pre;       /** @var SplFixedArray int pre[v] = preorder  number of v */
    private $post;      /** @var SplFixedArray int post[v] = postorder number of v */

    private $preOrder;       /** @var SplQueue int preorder vertices in preorder */
    private $postOrder;      /** @var SplQueue int postorder vertices in postorder */

    private $preCounter;    /** @var int counter for preorder numbering */
    private $postCounter;    /** @var int counter for postorder numbering */

    private $reversePost;    /** @var SplStack int vertices in reverse postorder  */

    private $dfsStack;


    public function __construct(DiGraph $G)
    {
        $this->pre = new \SplFixedArray($G->getV());
        $this->post = new \SplFixedArray($G->getV());
        $this->preOrder = new \SplQueue();
        $this->postOrder = new \SplQueue();
        $this->reversePost = new \SplStack();
        $this->marked = new \SplFixedArray($G->getV());

        $this->dfsStack = new \SplStack();

        for ($v = 0; $v < $G->getV(); $v++) {
//        for ($v = $G->getV() - 1; $v >= 0; $v--) {
            if (!$this->marked[$v]) {
                $this->dfs($G, $v);
//                $this->dfsStack->push($v);
            }
        }

    }


    public function dfs($G, $v)
    {


        $this->dfsStack->push($v);

        $this->dfsStack->rewind();

        $this->marked[$v] = true;

        while ($this->dfsStack->valid() && !$this->dfsStack->isEmpty()) {
            $this->dumpStack();
            $w = $this->dfsStack->top();


            $this->marked[$w] = true;

            if (!isset($this->pre[$w])) {
                $this->pre[$w] = $this->preCounter++;
                $this->preOrder->enqueue($w);
            }

            $count = 0;

            foreach ($G->reverseAdj($w) as $index => $x) {
                if (!$this->marked[$x]) {
//                    $this->marked[$x] = true;
                    $this->dfsStack->push($x);
                    $count ++;
                }
            }

            if ($count == 0) {
                if (!isset($this->post[$w])) {
                    $this->postOrder->enqueue($w);
                    $this->post[$w] = $this->postCounter++;
                }
            }
        }
    }

    public function dumpStack()
    {
        if ($this->debug == false) {
            return;
        }

        foreach ($this->dfsStack as $stack) {
            echo $stack . ", ";
        }
        echo "<br/>";
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

