<?php
require_once("../../vendor/autoload.php");

/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 2015-02-26
 * Time: 8:17 AM
 */

use PHP_Algorithms\graphs\DiGraph;
use PHP_Algorithms\graphs\DepthFirstOrderNonRecursive;

function exampleDepthFirstOrderNonRecursive()
{
    $filename = "../DiGraphTestData1.txt";
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

    $example = new DepthFirstOrderNonRecursive($digraph);


    foreach ($example->preOrder() as $item) {
        echo $item . " ";
    }

    echo "<br/>";
    echo "<br/>";

    foreach ($example->postOrder() as $item) {
        echo $item . " ";
    }
}

exampleDepthFirstOrderNonRecursive();
