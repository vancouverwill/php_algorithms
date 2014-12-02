<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2014-11-12
 * Time: 9:47 PM
 */

require_once("./DiGraph.php");

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


    public function DepthFirstOrder(DiGraph $G)
    {
            $this->pre = new SplFixedArray($G->getV());
        $this->post = new SplFixedArray($G->getV());
        $this->preOrder = new SplQueue();
        $this->postOrder = new SplQueue();
        $this->reversePost = new SplStack();
        $this->marked = new SplFixedArray($G->getV());

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


        foreach($G->adj($v) as $index => $w) {
            if (!$this->marked[$w]) {
                $this->dfs($G, $w);
            }
        }

        $this->postOrder->enqueue($v);
        $this->post[$v] = $this->postCounter++;
    }

    /**
     * return vertices in reverse postorder as an Iterable
     */
    public function reversePost()
    {
        $reverse = new SplStack();

        $this->postOrder->rewind();
        while ($this->postOrder->valid()) {
            $vertice = $this->postOrder->current();
            $reverse->push($vertice);
            $this->postOrder->next();
        }

        return $reverse;
    }

}