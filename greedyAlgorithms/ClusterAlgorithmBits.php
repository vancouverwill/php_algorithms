<?php
/**
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
var_dump($oneBitCombinations);
var_dump($twoBitCombinations);
$oneBitCombinationsPlustwentyFourChooseTwo = array_merge($oneBitCombinations, $twoBitCombinations);

var_dump($oneBitCombinationsPlustwentyFourChooseTwo);





$handle = fopen("./ClusterAlgorithmBitsData1.txt", "r");
$lineNu = 0;
$nodes = 0;
$numberOfBitsPerNode = 0;
$nodeArray = array();
//$clusters = array();


if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $line = str_replace("\n", "", $line);
        $data = preg_split('/\s+/', $line);

        if ($lineNu == 0) {
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
        $lineNu++;
    }
} else {
    // error opening the file.
    exit("error opening the file.");
}
fclose($handle);

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