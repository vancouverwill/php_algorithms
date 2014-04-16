<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-04-14
 * Time: 9:50 PM
 */

class queue {
    private $first;
    private $size;

    function pop()
    {
        $oldFirst = $this->first;
        $this->first = $oldFirst->next;
        $this->size--;
        return $oldFirst;
    }

    function push($value)
    {
        if ($this->first == null) {
            $this->first = new Node($value, null);
            $this->size++;
            return;
        }
        else {
            $node = $this->first;

            while ($node->next != null) {
                $node = $node->next;
            }

            $node->next = new Node($value, null);
            $this->size++;
        }
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
}


class Node {
    public $value;
    public $next;

    function   __construct($value, $next)
    {
        $this->value = $value;
        $this->next = $next;
    }
}

$queue = new Queue();

$queue->push("red");
$queue->push("orange");
$queue->push("yellow");
$queue->push("blue");

echo $queue->size() . '<br/>';
echo $queue->isEmpty() . '<br/>';


while(!$queue->isEmpty()) {
    echo '' . $queue->pop()->value . '<br/>';
}