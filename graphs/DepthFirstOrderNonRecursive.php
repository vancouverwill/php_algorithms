<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2014-11-12
 * Time: 9:47 PM
 */

require_once("./DiGraph.php");

class DepthFirstOrderNonRecursive
{

    private $marked;    /** @var SplFixedArray boolean  */

    private $pre;       /** @var SplFixedArray int pre[v] = preorder  number of v */
    private $post;      /** @var SplFixedArray int post[v] = postorder number of v */

    private $preOrder;       /** @var SplQueue int preorder vertices in preorder */
    private $postOrder;      /** @var SplQueue int postorder vertices in postorder */

    private $preCounter;    /** @var int counter for preorder numbering */
    private $postCounter;    /** @var int counter for postorder numbering */

    private $reversePost;    /** @var SplStack int vertices in reverse postorder  */

    private $dfsStack;


    public function DepthFirstOrderNonRecursive(DiGraph $G)
    {
        $this->pre = new SplFixedArray($G->getV());
        $this->post = new SplFixedArray($G->getV());
        $this->preOrder = new SplQueue();
        $this->postOrder = new SplQueue();
        $this->reversePost = new SplStack();
        $this->marked = new SplFixedArray($G->getV());

        $this->dfsStack = new SplStack();

        for ($v = 0; $v < $G->getV(); $v++) {
//        for ($v = $G->getV() - 1; $v >= 0; $v--) {
            if (!$this->marked[$v]) {
                $this->dfs2($G, $v);
//                $this->dfsStack->push($v);
            }
        }

//        $this->dfsStack->rewind();
//        while ($this->dfsStack->valid() && !$this->dfsStack->isEmpty()) {
//
////            $wPeek = $this->dfsStack->pee
////            $w = $this->dfsStack->current();
//            $w = $this->dfsStack->pop();
//
//            if ($this->marked[$w]) {
////                if (!isset($this->post[$w])) {
////                    $this->postOrder->enqueue($w);
////                    $this->post[$w] = $this->postCounter++;
////                }
//                continue;
//            }
//            $this->marked[$w] = true;
//            $this->pre[$w] = $this->preCounter++;
//            $this->preOrder->enqueue($w);
//
////            foreach($G->adj($w) as $index => $x) {
//            foreach($G->reverseAdj($w) as $index => $x) {
////                if (!$this->marked[$x]) {
////                    $this->marked[$x] = true;
//                    $this->dfsStack->push($x);
////                }
//            }
//
////            $temp = $this->dfsStack->pop();
//
////            $this->postOrder->enqueue($w);
////            $this->post[$w] = $this->postCounter++;
//        }
    }


    public function dfs1($G, $v) {


        $this->dfsStack->push($v);

        $this->dfsStack->rewind();

        while ($this->dfsStack->valid() && !$this->dfsStack->isEmpty()) {

//            $w = $this->dfsStack->current();
            $w = $this->dfsStack->pop();

            if ($this->marked[$w]) {

                continue;
            }
            $this->marked[$w] = true;
            $this->pre[$w] = $this->preCounter++;
            $this->preOrder->enqueue($w);

            foreach($G->reverseAdj($w) as $index => $x) {
//                if (!$this->marked[$x]) {
//                    $this->marked[$x] = true;
                $this->dfsStack->push($x);
//                }
            }

//            $temp = $this->dfsStack->pop();

            $this->postOrder->enqueue($w);
            $this->post[$w] = $this->postCounter++;
        }
    }


    public function dfs2($G, $v) {


        $this->dfsStack->push($v);

        $this->dfsStack->rewind();

        $this->marked[$v] = true;

        while ($this->dfsStack->valid() && !$this->dfsStack->isEmpty()) {

            $w = $this->dfsStack->top();


//            $w = $this->dfsStack->pop();

//            if ($this->marked[$w]) {
//
//                continue;
//            }
//            $this->marked[$w] = true;

            $this->marked[$w] = true;

            if (!isset($this->pre[$w])) {
                $this->pre[$w] = $this->preCounter++;
                $this->preOrder->enqueue($w);
            }

            $count = 0;

            foreach($G->reverseAdj($w) as $index => $x) {
                if (!$this->marked[$x]) {
//                    $this->marked[$x] = true;
                    $this->dfsStack->push($x);
                    $count ++;
                }
            }

            if ($count == 0) {
                $temp = $this->dfsStack->pop();

                if (!isset($this->post[$w])) {
                    $this->postOrder->enqueue($w);
                    $this->post[$w] = $this->postCounter++;
                }
            }

//            $temp = $this->dfsStack->top();

//            $temp = $this->dfsStack->pop();


        }
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




function exampleDepthFirstOrder()
{
    $filename = "DiGraphTestData1.txt";
//$filename = "KosarajuSCCLargeDataSet.txt";



    $handle = fopen($filename, "r");
    $uniqueNumbers = array();
    if ($handle) {
        while (($line = fgets($handle)) !== false) {

            $vertices = explode(" ", $line);
            foreach($vertices AS $vertice) {
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

            $vertices = explode(" ", $line);
            $digraph->addEdge((int)$vertices[0] - 1, (int)$vertices[1] - 1);
        }
    } else {
        // error opening the file.
        "no file exists";
    }
    fclose($handle);

    $example = new DepthFirstOrderNonRecursive($digraph);


    foreach ($example->preOrder() AS $item) {
        echo $item . " ";
    }

    echo "<br/>";
    echo "<br/>";

    foreach ($example->postOrder() AS $item) {
        echo $item . " ";
    }
}

exampleDepthFirstOrder();