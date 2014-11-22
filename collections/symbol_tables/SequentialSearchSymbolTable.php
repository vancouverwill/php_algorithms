<?php
/**
 *
 * Sequential search in an unordered linked list
 *
 * In this one I tried using a node with private key, value and next as a test in using in creating a Node in PHP.
 *
 * based on the JAVA example http://algs4.cs.princeton.edu/34hash/SequentialSearchST.java.html
 *
 * Created by PhpStorm.
 * User: will
 * Date: 2014-01-15
 * Time: 3:05 PM
 */

class SequentialSearchSymbolTable
{
    private $N;     // int number of key-value pairs
    private $first; // Node the linked list of key-value pairs

    function __construct()
    {
        $this->N = 0;

//        $this->first = new Node(3, $this->first, 'red');
//        $this->N++;
//        echo $this->first->getKey();
    }


    public function size()
    {
        return $this->N;
    }


    public function isEmpty()
    {
        if ($this->N == 0) {
            return true;
        }
        else {
            return false;
        }
    }


    public function contains($key)
    {
        return $this->get($key) != null;
    }


    public function get($key)
    {
        for ($x = $this->first; $x != null; $x = $x->getNext()) {
            if ($key == $x->getKey()) return $x->getVal();
        }
        return null;
    }


    public function put($key, $value) {
        if ($value == null) { delete($key); return; }
        if ($this->N > 0) {
            for ($x = $this->first; $x != null; $x = $x->getNext()) {
                if ($key == $x->getKey()) {
                    $x->setVal($value);
                    return; }
            }
        }
        $this->first = new Node($key, $this->first, $value);
        $this->N++;
    }


    public function delete($key) {

    }

    public function keys()
    {
        $array = array();

        if ($this->N > 0) {
            for ($x = $this->first; $x != null; $x = $x->getNext()) {
                array_push($array, $x->getkey());
            }
        }
        return $array;
    }


    public function values()
    {
        $array = array();

        if ($this->N > 0) {
            for ($x = $this->first; $x != null; $x = $x->getNext()) {
                array_push($array, $x->getVal());
            }
        }
        return $array;
    }

    public function keys_values()
    {
        $array = array();

        if ($this->N > 0) {
            for ($x = $this->first; $x != null; $x = $x->getNext()) {
//                array_push($array, $x->getVal());
                $array[$x->getkey()] = $x->getVal();
            }
        }
        return $array;
    }
}




class Node {
    private $key;
    private $val;
    private $next;

    function __construct($key, $next, $val)
    {
        $this->key = $key;
        $this->next = $next;
        $this->val = $val;
    }


    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @return mixed
     */
    public function getVal()
    {
        return $this->val;
    }

    /**
     * @param mixed $val
     */
    public function setVal($val)
    {
        $this->val = $val;
    }




}

?>

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
$temp = new SequentialSearchSymbolTable();
echo "size is " . $temp->size();
$temp->put(1, "orange");
$temp->put(2, "red");
$temp->put(3, "yellow");
$temp->put(4, "blue");
$temp->put(5, "white");
$temp->put(5, "sdfdsf");
$temp->put(5, "jljk");
$temp->put(5, "sdfduiouisf");

echo "<br/>";
echo "<br/>";
echo "<br/>";

echo "<h2>keys</h2><br/>";

foreach($temp->keys() AS $key) {
    echo $key . "<br/>";
}

echo "<h2>keys and values</h2><br/>";


foreach($temp->keys_values() AS $key => $value) {
    echo $key . '-' . $value . "<br/>";
}

echo "<h2>keys and values</h2><br/>";


$temp->put(5, "white");

foreach($temp->keys_values() AS $key => $value) {
    echo $key . '-' . $value . "<br/>";
}

echo "<h2>values</h2><br/>";


foreach($temp->values() AS $value) {
    echo $value . "<br/>";
}

//echo $temp->size();



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
