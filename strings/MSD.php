<?php
/**
 * most significant digit first
 */

namespace PHP_Algorithms\strings;

class MSD
{
    private static $R = 256;
    private static $cutoff = 3;  /**  @var int cutoff for small arrays **/
    private static $aux; /** @var array auxillary array for distribution **/


    /**
     * @param String $s
     * @param int position
     * @return int
     */
    private static function charAt($s, $d)
    {
        if ($d < strlen($s)) {
            return ord($s{$d});
        } else {
            return -1;
        }
    }


    public static function sort($a)
    {
        $n = count($a);
        self::$aux = new \SplFixedArray($n);
        self::sortRecursive($a, 0, $n - 1, 0);
        return $a;
    }


    /**
     * Sort from a[lo] to a[hi], starting at the dth character.
     *
     * @param $a
     * @param $lo
     * @param $hi
     * @param $d
     */
    private static function sortRecursive(&$a, $lo, $hi, $d)
    {
        if ($hi <= $lo + self::$cutoff) {
            self::insertionSort($a, $lo, $hi, $d);
            return;
        }

        // compute frequency counts
        $count = new \splFixedArray(self::$R + 2);
        for ($i = $lo; $i <= $hi; $i++) {
            $c = self::charAt($a[$i], $d);
            $count[$c + 2] = $count[$c + 2] + 1;
        }

        // Transform counts to indices.
        for ($r = 0; $r < self::$R + 1; $r++) {
            $count[$r + 1] = $count[$r + 1] + $count[$r];
        }

        //distribute
        for ($i = $lo; $i <= $hi; $i++) {
//            $temp = $a[$i];
//            $temp1 = $a[$i]{$d};
//            $temp2 = $count[ord($a[$i]{$d})];
//            $aux[$count[ord($a[$i]{$d}) + 1]] =
//                $a[$i];
//            $count[ord($a[$i]{$d})] = $count[ord($a[$i]{$d})] + 1;



            $c = self::charAt($a[$i], $d);
            if ($c + 1 >= count($count) || $c + 1 < 0) {
                $temp = 2 + 2;
            }
            if ($count[$c + 1] >= count(self::$aux) || $count[$c + 1] < 0) {
                $temp = 2;
            }
            if ($i >= count($a) || $i < 0) {
                $temp = 2;
            }
//            if (!isset($a[$i])) {
//                $temp = 2;
//            }
            self::$aux[$count[$c + 1]]
                = $a[$i];
            $count[$c + 1] = $count[$c + 1] + 1;
        }

        self::checkNothingNull($a);

        //copy back
        for ($i = $lo; $i <= $hi; $i++) {
            $a[$i] = self::$aux[$i - $lo];
        }

        // recursively sort for each character value
        for ($r = 0; $r < self::$R; $r++) {
            self::sortRecursive($a, $lo + $count[$r], $lo + $count[$r + 1] - 1, $d + 1);
        }
        $temp = 1;
//        return $a;
    }


    private static function insertionSort(&$a, $lo, $hi, $d)
    {
        if ($lo == 5 && $hi == 6 && $d == 1) {
            $temp = "error";
        }
        for ($i = $lo; $i <= $hi; $i++)
        {
            for ($j = $i; $j > $lo && self::less($a[$j], $a[$j - 1], $d); $j--) {
                $a = self::exch($a, $j, $j - 1);
            }
        }

        self::checkNothingNull($a);
//        return $a;
    }

    private static function exch($a, $i, $j)
    {
        $temp = $a[$i];
        $a[$i] = $a[$j];
        $a[$j] = $temp;

        return $a;
    }

    private static function less($a, $b, $d)
    {
        $temp = $d;
        $temp1 = $a{$d};
        $temp2 = ord($a{$d});

        $tempA = $d;
        $tempA1 = $b{$d};
        $tempA2 = ord($b{$d});

        return strcmp(substr($a, $d), substr($b, $d)) < 0;


//        if (ord($a{$d}) < ord($b{$d})) {
//            return true;
//        } else {
//            return false;
//        }
    }

    private static function checkNothingNull($a)
    {
        foreach ($a AS $element) {
            if ($element == null) {
                $temp= "sketchy";
            }
        }
    }
}


$students = array("Johny", "Kathy", "Chary", "Willy", "Billy", "James");

$array = MSD::sort($students, 5);

var_dump($array);


