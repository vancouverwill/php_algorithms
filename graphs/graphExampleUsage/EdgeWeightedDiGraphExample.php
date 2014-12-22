<?php

require_once(__DIR__ . "/../../vendor/autoload.php");

function test()
{

    $REQUEST_URI = $_SERVER['REQUEST_URI'];

    $pathVariables = explode("/", $REQUEST_URI);

    $lastElementInArray = $pathVariables[count($pathVariables) - 1];

    if (strpos($lastElementInArray, "?") != false) {
        $lastElementInArrayWithoutGetVariables = explode("?", $lastElementInArray)[0];
    } else {
        exit;
    }

    var_dump($lastElementInArrayWithoutGetVariables);


    $handle = fopen("../" . $lastElementInArrayWithoutGetVariables, "r");

    $uniqueNumbers = array();

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
        if (substr($line, 0, 5) == "<?php") {
                throw new \Exception("invalid data type, please use the last parameter in the url as the data string i.e. url/graphs/EdgeWeightedDiGraph.php/dijskstrasDataSmall.txt");
        }
            $line = str_replace("\n", "", $line);
            $nodes = preg_split('/\s+/', $line);

            foreach ($nodes as $node) {
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


    $graph = new PHP_Algorithms\graphs\EdgeWeightedDiGraph(max($uniqueNumbers) + 1);
    $handle = fopen("../" . $lastElementInArrayWithoutGetVariables, "r");

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            // process the line read.
            $integerArray[] = (int)$line;

            $line = str_replace("\n", "", $line);
            $nodes = preg_split('/\s+/', $line);

            $fromIndex = $nodes[0];

            for ($i = 1; $i < count($nodes); $i++) {
                $nodeInfo = explode(",", $nodes[$i]);

                $nodeIndex = $nodeInfo[0];
                $nodeWeight = (int)$nodeInfo[1];

                $edge = new PHP_Algorithms\graphs\DirectedEdge($fromIndex, $nodeIndex, $nodeWeight);

                $graph->addEdge($edge);
            }
        }
    } else {
        // error opening the file.
    }
    fclose($handle);

    $temp = $graph->adj(1);

    foreach ($graph->adj(1) AS $edge) {
        $tempV = $edge;
    }

}

test();

// example use
