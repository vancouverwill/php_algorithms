<?php

namespace PHP_Algorithms\strings;

class Student
{
    public $name;
    public $key;


    public function __construct($name, $key)
    {
        $this->name = $name;
        $this->key = $key;
    }

    public function key()
    {
        return $this->key;
    }
}


/**
* @var array $a
* @var array $r
 * @return array
*
**/
function keyIndexedCounting($a, $R)
{
    $N = count($a);
    $aux = new \splFixedArray($N);
    $count = new \splFixedArray($R + 1);

    foreach ($count AS $index => $value) {
        $count[$index] = 0;
    }


    // Compute frequency counts.
    for ($i = 0; $i < $N; $i++) {
        $temp = $a[$i]->key();
        $count[$a[$i]->key() + 1] = $count[$a[$i]->key() + 1] + 1;
    }

    // Transform counts to indices.
    for ($r = 0; $r < $R; $r++) {
        $count[$r + 1] += $count[$r];
    }

    // Distribute the records.
    for ($i = 0; $i < $N; $i++) {
        $aux[$count[$a[$i]->key()]] = $a[$i];

        $count[$a[$i]->key()] = $count[$a[$i]->key()] + 1;
    }

    // Copy back.
    for ($i = 0; $i < $N; $i++) {
        $a[$i] = $aux[$i];
    }

    return $a;
}

$students = array(new Student("James", 5), new Student("Will", 1), new Student("Bill", 1));

$array = keyIndexedCounting($students, 6);

var_dump($array);

