<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-11
 * Time: 4:13 PM
 *
 * all n nodes are seperate, we could consider at this stage as n clusters each with a size of 1
 * to find the next cluster we look for the edge with smallest weight/length, we need to check these two points are not already joined and join these two nodes/clusters together
 * when two separate clusters are joined, number of clusters is reduced by 1
 *
 * this seems like a perfect example for union find
 *
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

require_once(__DIR__ . "/../../../vendor/autoload.php");

//require_once("/vendor/autoload.php");

//use PHP_Algorithms\collections\priorityQueues\IndexedMinPriorityQueueBinaryHeap;



$handle = fopen("./", "r");

$nodes = 0;
$edges = array();
$clusters = array();


if ($handle) {
    while (($line = fgets($handle)) !== false) {
//        if (substr($line, 0, 5) == "<?php") {
//            throw new \Exception("invalid data type, please use the last parameter in the url as the data string i.e. url/graphs/EdgeWeightedDiGraph.php/dijskstrasDataSmall.txt");
//        }

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
            "priorityByDifference" => $weight - $length,
            "weight" => $edgeWeight);



    }
} else {
    // error opening the file.
    exit("error opening the file.");
}
fclose($handle);

echo "finished";
//$heap = new IndexedMinPriorityQueueBinaryHeap(count($edges));

//foreach ($edges as $key => $edge) {
//    $heap->insert($key, $edge["weight"]);
//}

echo "finished";