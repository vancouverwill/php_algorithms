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
    private $pre;       /** @var SplQueue int preorder */
    private $post;      /** @var SplQueue int postorder */
    private $reversePost;    /** @var SplStack int vertices in reverse postorder  */


    public function DepthFirstOrder(DiGraph $G)
    {
        $this->pre = new SplQueue();
        $this->post = new SplQueue();
        $this->reversePost = new SplStack();
        $this->marked = new SplFixedArray($G->getV());

        for ($v = 0; $v < $G->getV(); $v++) {
            if (!$this->marked[$v]) {

            }
        }
    }


    public function dfs(DiGraph $G, $v)
    {
        $this->pre->enqueue($v);

        $this->marked[$v] = true;

        for ($G->adj($v) AS $w) {

    }
    }

}