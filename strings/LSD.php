<?php
/**
* LSD - Least Significant Digit string sorting algorithm
 *
 * sort an array of strings where each string has equal length
 * start on least significant digit and use key indexed sorting on the last digit of every string
 * then progressively move in one character at a time to we get to the first character.
 *
 * this works ONLY because key indexed counting is a STABLE sorting algorithm
 *
*
**/

namespace PHP_Algorithms\strings;

class LSD
{

    /**
    *  Sort $a[] on leading $W characters.
     * @param array $a
     * @param int $W
    *
    **/
    public static function sort($a, $W)
    {
        $N = count($a);
        $R = 256;
        $aux = new \splFixedArray($N);

        // sort by key-indexed counting on the dth character
        for ($d = $W - 1; $d >= 0; $d--) {
            $count = new \splFixedArray($R + 1);
            // compute frequency counts
            for ($i = 0; $i < $N; $i++) {
                $count[ord($a[$i]{$d}) + 1] = $count[ord($a[$i]{$d}) + 1] + 1;
            }

            // transform counts to indices
            for ($r = 0; $r < $R; $r++) {
                $count[$r + 1] = $count[$r + 1] + $count[$r];
            }

            //distribute
            for ($i = 0; $i < $N; $i++) {
                $aux[$count[ord($a[$i]{$d})]] =
                    $a[$i];
                $count[ord($a[$i]{$d})] = $count[ord($a[$i]{$d})] + 1;
            }

            //copy back
            for ($i = 0; $i < $N; $i++) {
                $a[$i] = $aux[$i];
            }
        }

        return $a;
    }
}

$string = "enclycopedia";

//exit;

$students = array("James", "Kathy", "Chary", "Willy", "Billy", "Johny");

$array = LSD::sort($students, 5);

var_dump($array);


