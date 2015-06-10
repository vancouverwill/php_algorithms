<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-11
 * Time: 4:13 PM
 *
 * Glossary :
 * Cluster - a collection of nodes with one or more nodes in it, before the graph has been clusters you could say in a graph of N nodes, there are N clusters each with a size of 1
 *
 * goal :
 * Reduce the number of clusters to a predetermined amount X left. We want to find the X clusters with the maximum spacing between the clusters
 *
 * technique:
 * we have a graph where all n nodes are distinct, we could consider at this stage as n clusters each with a size of 1
 * to find the next cluster we look for the edge with smallest weight/length,
 * we need to check these two points are not already joined and can then join these two nodes/clusters together
 * when two separate clusters are joined, number of clusters is reduced by 1
 * when we reach our desired amount of clusters X we have completed
 *
 *
 * Analysis:
 * We have lots of separate groups and we efficiently want to keep count of the number of different groups and update them easily,
 * this seems like a perfect example for union find
 *
 *
 *
 * pseudocode ----
 *
 * add all edges to heap
 *
 * create union find data structure with n nodes
 *
 * remove smallest edge from heap
 * check if two points are joined if not connect in union find
 *
 *  if unionFind->numberOfComponents <= desired cluster amounts then abort while loop
 *
 * remaining smallest edge on heap is the maximum spacing
 *
 *
 */


require_once(__DIR__ . "/../vendor/autoload.php");

use PHP_Algorithms\collections\priorityQueues\IndexedMinPriorityQueueBinaryHeap;
use PHP_Algorithms\graphs\WeightedQuickUnionUF;



$fileName = "./ClusterAlgorithmData6.txt";

$handle = fopen($fileName, "r");

$nodes = 0;
$edges = array();
$clusters = array();


if ($handle) {
    while (($line = fgets($handle)) !== false) {

        if(substr($line,0,2) == '//') continue; // ignore commented lines

        $line = str_replace("\n", "", $line);
        $data = preg_split('/\s+/', $line);

        if (!isset($data[1])) {
            $nodes = $data[0];
            continue;
        }
        $edgeA = $data[0];
        $edgeB = $data[1];
        $edgeWeight = $data[2];

        $edges[] = array(
                        "start" => $edgeA,
                        "end" => $edgeB,
                        "weight" => $edgeWeight);

    }
} else {
    // error opening the file.
    exit("error opening the file. " . $fileName);
}
fclose($handle);

// add all edges to minimum priority heap
$heap = new IndexedMinPriorityQueueBinaryHeap(count($edges));

foreach ($edges as $key => $edge) {
    $heap->insert($key, $edge["weight"]);
}

$unionFind = new WeightedQuickUnionUF();
$unionFind->createFixedSize($nodes, 1);

$clusterArray = array(3,4);

while ($heap->size() > 0) {
    $edgeKey = $heap->delMin();

    if ($heap->size() < 1) break;
    $temp = $edges[$edgeKey];
    if ($unionFind->union($edges[$edgeKey]["start"],  $edges[$edgeKey]["end"])) {

        if ( in_array($unionFind->countComponents(), $clusterArray)) {
            echo "<br/>number of clusters " . $unionFind->countComponents() . "   size of smallest distance left  " .  $heap->minKey();
        }
    }
}




