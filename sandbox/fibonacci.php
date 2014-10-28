<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-04-15
 * Time: 8:08 AM
 */

function fibonacci_setup()
{
    $n_1 = 0;
    $n_2 = 1;
    $count = 2;
    $goal = 20;

    echo "<h2>" . fibonacci_recursive($n_1, $n_2, $count, $goal) . "</h2>";
}

function fibonacci_recursive($n_2, $n_1, $count, $goal)
{
    $n = $n_2 + $n_1;
    $count++;
    echo  '<br/>' . $count . ':' . $n;

//    if ($n > 1000) exit;

    if ($count >= $goal) return $n;
    return fibonacci_recursive($n_1, $n, $count, $goal);
}

fibonacci_setup();