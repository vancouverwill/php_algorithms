<?php


function multiplicationWithOutOperator($productA, $productB)
{
    $results = 0;
    for ($i = 0; $i < $productB; $i++) {
        $results += $productA;
    }

    return $results;
}

function recursiveMultiplicationWithOutOperator($productA, $productB)
{
    if ($productB <= 0) {
        return 0;
    }
    $results = recursiveMultiplicationWithOutOperator($productA, $productB - 1);
    $results += $productA;

    return $results;
}

function recursiveDivisionWithOutOperator($numerator, $denominator)
{
    //keep subtracting from $denominator until lower than $denominator
    //pass a counter which is returned as

    if ($numerator < $denominator) {
        return 0;
    }

    $count = recursiveDivisionWithOutOperator($numerator - $denominator, $denominator);
    $count++;

    return $count;
}

function test() {
    echo multiplicationWithOutOperator(5, 9);
    echo recursiveMultiplicationWithOutOperator(5, 9);

    echo recursiveDivisionWithOutOperator(29, 5, 0);
}


