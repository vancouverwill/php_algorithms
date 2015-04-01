<?php


require_once(__DIR__ . "/../../vendor/autoload.php");


$a = new PHP_Algorithms\graphs\BoggleGame(3, 3);
echo $a->coordinatesIntoDiceNumber(0, 0);
echo $a->coordinatesIntoDiceNumber(2, 2);


$a = new PHP_Algorithms\graphs\BoggleGame(4, 4);
$dice = $a->getReachableDiceAsIterator(0, 0);
$dice2 = $a->getReachableDiceAsIterator(3, 3);

var_dump($dice);

/**
 *  V  R  H  T
    J  M  L  N
    S  D  T  T
    F  T  P  H
 */

$board = array();
$board[] = array("v", "r", "h", "t");
$board[] = array("j", "m", "l", "n");
$board[] = array("s", "d", "t", "t");
$board[] = array("f", "t", "p", "h");