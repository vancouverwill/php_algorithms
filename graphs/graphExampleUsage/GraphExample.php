<?php

require_once(__DIR__ . "/../../vendor/autoload.php");


$graph = new PHP_Algorithms\graphs\Graph(6);

$graph->addEdge(0, 1);
$graph->addEdge(0, 2);
$graph->addEdge(0, 5);
$graph->addEdge(2, 1);
$graph->addEdge(2, 3);
//$graph->addEdge(2, 4);
$graph->addEdge(3, 5);

echo $graph->getE();
echo '<br/>';
echo $graph->getV();
echo '<br/>';

echo (int)count($graph->adj(0));
echo '<br/>';

foreach ($graph->adj(0) as $w) {
    echo $w . ",";
}

$dfs = new PHP_Algorithms\graphs\DepthFirstSearch($graph, 0);

echo '<br/>';

echo $dfs->getCount();
