<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/bower_components/bootstrap-css/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>Hello, world!</h1>

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




/**
* public class SequentialSearchST<Key, Value>
*
* http://algs4.cs.princeton.edu/31elementary/SequentialSearchST.java.html
*
{
private Node first; // first node in the linked list
private class Node
{ // linked-list node
Key key;
Value val;
Node next;
public Node(Key key, Value val, Node next)
{
this.key = key;
this.val = val;
this.next = next;
}
}
public Value get(Key key)
{ // Search for key, return associated value.
for (Node x = first; x != null; x = x.next)
if (key.equals(x.key))
return x.val; // search hit
return null; // search miss
}
public void put(Key key, Value val)
{ // Search for key. Update value if found; grow table if new.
for (Node x = first; x != null; x = x.next)
if (key.equals(x.key))
{ x.val = val; return; } // Search hit: update val.
first = new Node(key, val, first); // Search miss: add new node.
}
}
*/


?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bower_components/bootstrap-css/js/bootstrap.min.js"></script>
</body>
</html>