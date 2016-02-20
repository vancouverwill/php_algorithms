<?php

function isPalindrome($a)
{
$aWithOutSpaces = str_replace(" ", "", $a);
$aWithOutPeriods = str_replace(".", "", $aWithOutSpaces);
$aLowerCase = strtolower($aWithOutPeriods);

$a = preg_replace("/[^A-Za-z0-9 ]/", '', $a);

echo $a;

if (strrev($aLowerCase) == $aLowerCase) {
return 1;
} else {
return 0;
}
}


echo isPalindrome("A Toyota.");