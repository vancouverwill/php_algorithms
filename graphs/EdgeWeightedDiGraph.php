<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 2014-11-12
 * Time: 9:55 PM
 */

require_once("./DirectedEdge.php");

class EdgeWeightedDiGraph
{
    private $v; /** @var  int */
    private $e; /** @var  int */
    private $adj; /** @var SplFixedArray fixed array of ??? */


    public function EdgeWeightedDiGraph($v)
    {
        $this->v = $v;
        $this->e = 0;
        $this->adj = new SplFixedArray($v);
        for($i = 0; $i < $this->v; $i++) {
            $this->adj[$i] = new SplStack();
        }
    }


    public function getV()
    {
        return $this->v;
    }


    public function getE()
    {
        return $this->v;
    }


    public function addEdge(DirectedEdge $e)
    {
        $v = $e->getFrom();
        $before = count($this->adj[$v]);
        $this->adj[$v]->push($e);
        $after = count($this->adj[$v]);
//        $temp = $this->adj[$v]->pop();
//        $temp2 = $this->adj[$v]->next();
    }


    /**
     * Return the edges incident from vertex v as an Iterable.
     * @param $v
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function adj($v)
    {
        if ($v < 0 || $v >= $this->v) throw new InvalidArgumentException();
        return $this->adj[$v];
    }

    public function edges()
    {
        $edges = new SplStack();

        for ($v = 0; $v < $this->v; $v++) {
            foreach($this->adj($v) as $key => $edge) {
                $edges->push($edge);
            }
        }

        return $edges;
    }
}


function test() {

    $REQUEST_URI = $_SERVER['REQUEST_URI'];

    $pathVariables = explode("/", $REQUEST_URI);

    $lastElementInArray = $pathVariables[count($pathVariables) - 1];

    if (strpos($lastElementInArray, "?") != FALSE) {
        $lastElementInArrayWithoutGetVariables = explode("?", $lastElementInArray)[0];
    }
    else {
        exit;
    }

    var_dump($lastElementInArrayWithoutGetVariables);


    $handle = fopen($lastElementInArrayWithoutGetVariables, "r");

    $uniqueNumbers = array();

    if ($handle) {
        while (($line = fgets($handle)) !== false) {

            $nodes = explode(" ", $line);

            foreach ($nodes AS $node) {
                $nodeInfo = explode(",", $node);

                $nodeIndex = $nodeInfo[0];
                if (!in_array($nodeIndex, $uniqueNumbers)) {
                    $uniqueNumbers[] = $nodeIndex;
                }
            }
        }
    } else {
        // error opening the file.
    }
    fclose($handle);


    $graph = new EdgeWeightedDiGraph(max($uniqueNumbers) + 1);
    $handle = fopen($lastElementInArrayWithoutGetVariables, "r");

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            // process the line read.
            $integerArray[] = (int)$line;

            $nodes = explode(" ", $line);

            $fromIndex = $nodes[0];

            for ($i = 1; $i < count($nodes); $i++) {
                $nodeInfo = explode(",", $nodes[$i]);

                $nodeIndex = $nodeInfo[0];
                $nodeWeight = (int)$nodeInfo[1];

                $edge = new DirectedEdge($fromIndex, $nodeIndex, $nodeWeight);

                $graph->addEdge($edge);
            }
        }
    } else {
        // error opening the file.
    }
    fclose($handle);

    $graph->adj(1);


    $temp = $graph->adj(1);

    //        $temp1 = (SplStack)$temp;
    $temp->rewind();

    $size = count($graph->adj(1));

    $beta = $temp->next();
    $beta = $temp->valid();
    $beta = $temp->current();
    //
    //$size = count($temp);
    //$size1 = $temp->pop();

    $graph->adj(1)->rewind();

    while ($graph->adj(1)->valid()) {
        $alpha = $graph->adj(1)->current();
        $beta = $graph->adj(1)->next();
    //    $graphamma = 1;
    }

    $size = count($graph->adj(1));

    $graph->adj(1)->rewind();

    while ($graph->adj(1)->valid()) {
        $alpha = $graph->adj(1)->current();
        $beta = $graph->adj(1)->pop();
        $graphamma = 1;
    }

    $size = count($graph->adj(1));

    $temp = $graph->adj(1);

    $temp = $graph->adj(1);

}

//test();


