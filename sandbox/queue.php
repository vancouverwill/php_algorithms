<?php
/**
 * the most efficient way to push or pull a node is swapping the start. The alternative is to add on to the end of list.
 * This seems simpler logically but requires the user to loop through all the nodes from the start to the end.
 * Once we have the end we can either add onto the end or remove the last node on the path.
 * Comparing these is a case of 1 transaction to access the start or the size of the linked list N transactions to find the end.
 */
namespace PHP_Algorithms\sandbox;

class Queue
{
    private $first;
    private $size;

    public function dequeue()
    {
        $oldFirst = $this->first;
        $this->first = $oldFirst->next;
        $this->size--;
        return $oldFirst->value;
    }

    public function enqueue($value)
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

//$queue = new Queue();
//
//$queue->enqueue("red");
//$queue->enqueue("orange");
//$queue->enqueue("yellow");
//$queue->enqueue("blue");
//
//echo $queue->size() . '<br/>';
//echo $queue->isEmpty() . '<br/>';
//
//
//while (!$queue->isEmpty()) {
//    echo '' . $queue->dequeue() . '<br/>';
//}
