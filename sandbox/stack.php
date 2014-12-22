<?php

namespace PHP_Algorithms\sandbox;

class Stack
{
    private $first;
    private $size;


    public function __construct()
    {

    }


    public function push($value)
    {
        $oldFirst = $this->first;
        $this->first = new StackNode($value, $oldFirst);
        $this->size++;

    }

    public function size()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        if ($this->size > 0) {
            return false;
        } else {
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

    public function pop()
    {
        $oldFirst = $this->first;
        $this->first = $oldFirst->next;
        $this->size--;
        return $oldFirst;
    }
}

class StackNode
{
    public $value;
    public $next;

    public function __construct($value, $next)
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


while (!$stack->isEmpty()) {
    echo '' . $stack->pop()->value . '<br/>';
}
