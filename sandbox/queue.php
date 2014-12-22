<?php

namespace PHP_Algorithms\sandbox;

class Queue
{
    private $first;
    private $size;

    public function pop()
    {
        $oldFirst = $this->first;
        $this->first = $oldFirst->next;
        $this->size--;
        return $oldFirst;
    }

    public function push($value)
    {
        if ($this->first == null) {
            $this->first = new Node($value, null);
            $this->size++;
            return;
        } else {
            $node = $this->first;

            while ($node->next != null) {
                $node = $node->next;
            }

            $node->next = new Node($value, null);
            $this->size++;
        }
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
}


class Node
{
    public $value;
    public $next;

    public function __construct($value, $next)
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


while (!$queue->isEmpty()) {
    echo '' . $queue->pop()->value . '<br/>';
}
