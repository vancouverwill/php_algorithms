<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-11
 * Time: 4:13 PM
 *
 * Glossary :
 * Cluster a collection of nodes with one or more
 *
 * we have a graph where all n nodes are distinct, we could consider at this stage as n clusters each with a size of 1
 * to find the next cluster we look for the edge with smallest weight/length, we need to check these two points are not already joined and join these two nodes/clusters together
 * when two separate clusters are joined, number of clusters is reduced by 1
 *
 * this seems like a perfect example for union find
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


require_once(__DIR__ . "/../../vendor/autoload.php");

use PHP_Algorithms\collections\priorityQueues\IndexedMinPriorityQueueBinaryHeap;
use PHP_Algorithms\graphs\WeightedQuickUnionUF;



//$handle = fopen("./ClusterAlgorithmData.txt", "r");
$handle = fopen("./ClusterAlgorithmData2.txt", "r");

$nodes = 0;
$edges = array();
$clusters = array();


if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $line = str_replace("\n", "", $line);
        $data = preg_split('/\s+/', $line);

        if (!isset($data[1])) {
            $nodes = $data[0];
            continue;
        }
        $edgeA = $data[0];
        $edgeB = $data[1];
        $edgeWeight = $data[2];

        $edges[] = array("start" => $edgeA,
            "end" => $edgeB,
            "weight" => $edgeWeight);

    }
} else {
    // error opening the file.
    exit("error opening the file.");
}
fclose($handle);

//var_dump($edges);

$heap = new IndexedMinPriorityQueueBinaryHeap(count($edges));

foreach ($edges as $key => $edge) {
    $heap->insert($key, $edge["weight"]);
}

$unionFind = new WeightedQuickUnionUF();
$unionFind->createFixedSize($nodes);

$clusterAmount = 3;
$clusterArray = array(2,3,4);

while ($heap->size() > 0) {
    $edgeKey = $heap->delMin();
    if ($unionFind->union($edges[$edgeKey]["start"],  $edges[$edgeKey]["end"])) {
//        if ($unionFind->countComponents() <= $clusterAmount) {
        if ( in_array($unionFind->countComponents(), $clusterArray)) {
            echo "<br/>number of clusters " . $unionFind->countComponents() . "   size of smallest distance left  " .  $heap->minKey();
//            break;
        }
    }
}



//echo "<br/>number of clusters " . $clusterAmount;
//echo "<br/>" . $heap->minKey();
//echo "<br/>" . $heap->minIndex();
//
//echo "<br/>" . $heap->size();
//
//$number = 0;
//
//while (true) {
//    if ($heap->size() <= 1) {
//        break;
//    }
//    $number = $heap->delMin();
//
//}
//
//
//echo "<br/>" . $number;



