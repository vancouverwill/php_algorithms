<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-04-14
 * Time: 9:39 PM
 */

class Stack {
    private $first;
    private $size;


    function __construct()
    {

    }


    function push($value)
    {
        $oldFirst = $this->first;
        $this->first = new StackNode($value, $oldFirst);
        $this->size++;

    }

    function size()
    {
        return $this->size;
    }

    function isEmpty()
    {
        if ($this->size > 0) {
            return false;
        }
        else {
            return true;
        }
    }


//    function push_slow($value)
//    {
//        if ($this->first == null) {
//            $this->first = new StackNode($value, null);
//            $this->size = 1;
//        }
//        else {
//            $node = $this->first;
//            while ($node->next != null) {
//
//            }
//        }
//    }

    function pop()
    {
        $oldFirst = $this->first;
        $this->first = $oldFirst->next;
        $this->size--;
        return $oldFirst;
    }
}

class StackNode {
    public $value;
    public $next;

    function   __construct($value, $next)
    {
        $this->value = $value;
        $this->next = $next;
    }
}

$stack = new Stack();

$stack->push("red");
$stack->push("orange");
$stack->push("yellow");
$stack->push("blue");

echo $stack->size() . '<br/>';
echo $stack->isEmpty() . '<br/>';


while(!$stack->isEmpty()) {
    echo '' . $stack->pop()->value . '<br/>';
}