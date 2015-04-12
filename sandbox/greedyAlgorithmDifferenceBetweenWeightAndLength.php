<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-03-30
 * Time: 9:41 PM
 */


$handle = fopen("./sandboxData/greedyAlgorithmTestData.txt", "r");

$jobs = array();

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (substr($line, 0, 5) == "<?php") {
            throw new \Exception("invalid data type, please use the last parameter in the url as the data string i.e. url/graphs/EdgeWeightedDiGraph.php/dijskstrasDataSmall.txt");
        }

        $line = str_replace("\n", "", $line);
        $nodes = preg_split('/\s+/', $line);

        if (!isset($nodes[1])) {
            continue;
        }
//        exit;
        $weight = $nodes[0];
        $length = $nodes[1];

        $jobs[] = array("weight" => $weight,
                        "length" => $length,
                        "priorityByDifference" => $weight - $length,
                        "priorityByRatio" => $weight / $length,
                        "weightedCompletionTime" => $weight * $length);



    }
} else {
    // error opening the file.
    exit("error opening the file.");
}
fclose($handle);

var_dump($jobs);

function calculateTotalCompletionTime($array)
{
    $total = 0;
    asset($this->isSorted());

    foreach ($array as $value) {
        $total += $value["weightedCompletionTime"];
    }
    return $total;
}


