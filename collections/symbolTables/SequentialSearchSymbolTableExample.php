<?php

require_once(__DIR__ . "/SequentialSearchSymbolTable.php");
$testObject = new PHP_Algorithms\collections\symbolTables\SequentialSearchSymbolTable();
echo "Initial size is " . $testObject->size();
$testObject->put(1, "orange");
$testObject->put(2, "red");
$testObject->put(3, "yellow");
$testObject->put(4, "blue");
$testObject->put(5, "white");
$testObject->put(5, "sdfdsf");
$testObject->put(5, "jljk");
$testObject->put(5, "sdfduiouisf");

echo "<br/>";
echo "<br/>";
echo "<br/>";

echo "<h2>keys</h2><br/>";

foreach ($testObject->keys() as $key) {
    echo $key . "<br/>";
}

echo "<h2>keys and values</h2><br/>";


foreach ($testObject->keysValues() as $key => $value) {
    echo $key . '-' . $value . "<br/>";
}

echo "<h2>keys and values post updating 5</h2><br/>";


$testObject->put(5, "white");

foreach ($testObject->keysValues() as $key => $value) {
    echo $key . '-' . $value . "<br/>";
}

echo "<h2>values</h2><br/>";


foreach ($testObject->values() as $value) {
    echo $value . "<br/>";
}





