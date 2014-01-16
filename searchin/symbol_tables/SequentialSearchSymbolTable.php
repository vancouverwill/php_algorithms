<?php
/**
 *
 * Sequential search in an unordered linked list
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


    public function put($key, $value) {
        if ($value == null) { delete($key); return; }
        for ($x = $this->first; $x != null; $x = $x->getNext()) {

        }
        $this->first = new Node()
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

