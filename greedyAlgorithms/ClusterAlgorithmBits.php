<?php
/**
 *
 * The cluster algorithm is a greedy algorithm which progressively looks for the next smallest gap and joins two clusters together across that gap
 *
 * In this particular exercise we are looking at binary numbers and using the hamming distance between them to determine their distance between each other on the graph.
 * We are trying to find what is the maximum number of clusters you can have while still ensuring the number of bits different is more than two or at least three
 *
 * We are given a very large set of numbers and
 *
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-20
 * Time: 8:47 PM
 */



function generateOneBitCombinations($bits) {

    $oneBitCombinations = array();

    for ($i = 0; $i < $bits; $i ++) {
        $number = '';
        $x = 0;

        while ($x < $bits) {
            if ($x == $i) {
                $number .= 1;
            }
            else {
                $number .= 0;
            }
            $x++;
        }

        $oneBitCombinations[] = $number;
    }

    return $oneBitCombinations;
}



function generateTwoBitCombinations($bits) {
$twoBitCombinations = array();

for ($i = 0; $i < $bits; $i ++) {
    for ($j = $i + 1; $j < $bits; $j ++) {

        $number = '';
        $x = 0;

        while ($x < $bits) {
            if ($x == $i || $x == $j) {
                $number .= 1;
            }
            else {
                $number .= 0;
            }
            $x++;
        }

    $twoBitCombinations[] = $number;
    }
}
    return $twoBitCombinations;
}

$bits = 4;

$oneBitCombinations = generateOneBitCombinations($bits);
$twoBitCombinations = generateTwoBitCombinations($bits);
echo "oneBitCombinations";
var_dump($oneBitCombinations);
echo "twoBitCombinations";
var_dump($twoBitCombinations);
$oneBitCombinationsPlustwentyFourChooseTwo = array_merge($oneBitCombinations, $twoBitCombinations);

echo "oneBitCombinationsPlustwentyFourChooseTwo";
var_dump($oneBitCombinationsPlustwentyFourChooseTwo);





$handle = fopen("./ClusterAlgorithmBitsData1.txt", "r");
$lineNum = 0;
$nodes = 0;
$numberOfBitsPerNode = 0;
$nodeArray = array();
//$clusters = array();


if ($handle) {
    while (($line = fgets($handle)) !== false) {

        if(substr($line,0,2) == '//') continue; // ignore commented lines

        $line = str_replace("\n", "", $line);
        $data = preg_split('/\s+/', $line);

        if ($lineNum == 0) {
            $nodes = $data[0];
            $numberOfBitsPerNode = $data[1];
//            continue;
        }
        else {
            $node = '';

            for ($i = 0; $i < $numberOfBitsPerNode; $i++) {
                $node .= $data[$i];
            }

            $nodeArray[] = $node;
        }
//        $edgeA = $data[0];
//        $edgeB = $data[1];
//        $edgeWeight = $data[2];
//
//        $edges[] = array("start" => $edgeA,
//            "end" => $edgeB,
//            "weight" => $edgeWeight);
        $lineNum++;
    }
} else {
    // error opening the file.
    exit("error opening the file.");
}
fclose($handle);

echo "nodeArray";
var_dump($nodeArray);


$testNumbers = array();

foreach ($nodeArray AS $testNumber) {
    foreach ($oneBitCombinationsPlustwentyFourChooseTwo AS $hammingDistance) {
        $requiredNumber = $hammingDistance ^ $testNumber;
        $requiredNumber2 = (int)$hammingDistance ^ (int)$testNumber;
        if (in_array($requiredNumber, $testNumbers)) {
                // this is what we are looking for
        }
    }
}