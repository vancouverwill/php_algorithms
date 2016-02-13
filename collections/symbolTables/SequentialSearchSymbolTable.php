<?php
/**
 *
 * Sequential search in an unordered linked list
 *
 * In this one I tried using a node with private key, value and next as a test in using in creating a Node in PHP.
 *
 * based on the JAVA example http://algs4.cs.princeton.edu/34hash/SequentialSearchST.java.html
 *
 * This is a very inefficient implementation and just shown as the simplest possible kind of symbol table
 *
 * Created by PhpStorm.
 * User: will
 * Date: 2014-01-15
 * Time: 3:05 PM
 */

namespace PHP_Algorithms\collections\symbolTables;

class SequentialSearchSymbolTable
{
    private $N;     // int number of key-value pairs
    private $first; // Node the linked list of key-value pairs

    public function __construct()
    {
        $this->N = 0;
    }


    public function size()
    {
        return $this->N;
    }


    public function isEmpty()
    {
        if ($this->N == 0) {
            return true;
        } else {
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
            if ($key == $x->getKey()) {
                return $x->getVal();
            }
        }
        return null;
    }


    public function put($key, $value)
    {
        if ($value == null) {
            delete($key);
            return;
        }
        if ($this->N > 0) {
            for ($x = $this->first; $x != null; $x = $x->getNext()) {
                if ($key == $x->getKey()) {
                    $x->setVal($value);
                    return;
                }
            }
        }
        $this->first = new SequentialSearchNode($key, $this->first, $value);
        $this->N++;
    }


    public function delete($key)
    {

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


    public function keysValues()
    {
        $array = array();

        if ($this->N > 0) {
            for ($x = $this->first; $x != null; $x = $x->getNext()) {
                $array[$x->getkey()] = $x->getVal();
            }
        }
        return $array;
    }
}




class SequentialSearchNode
{
    private $key;
    private $val;
    private $next;

    public function __construct($key, $next, $val)
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
