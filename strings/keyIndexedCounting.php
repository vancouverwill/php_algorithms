<?php
/**
 *
 * key indexed counting is an extremely effective way to sort where there is a small size set of keys to sort over.
 * It is 4 linear passes of the data
 *
 * 1 - count number of each key
 * 2 - starting from 0 progressively go through each key and assign each keys starting index by adding count of that key to previous key's starting index
 * 3 - distribute keys into a temporary auxiliary array, by putting key at index determined in step 2 then adding one to that index so the next time the same key comes up it will be in correct place
 * 4 - copy back to original array
 *
 *
 * key indexed counting works well with a small set of keys and thus works well for sorting characters or strings because with ASCII characters there are only 256 characters
 */

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
* @var array $r number of keys
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

