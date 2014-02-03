<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-02-02
 * Time: 6:29 PM
 */
/**
 * Class Stack
 *
 * todo create iterator
 */

class Stack {

    private $N; //int
    private $first; //Node

public function isEmpty() {
    return $this->first == null;
}

public function size()
{
    return $this->N;
}


    /**
     * @param $item
     *
     * // Add item to top of stack.
     */
    public function push($item)
    {
        $oldfirst = $this->first;
        $this->first = new Node();
        $this->first->item = $item;
        $this->first->next = $oldfirst;
        $this->N++;
    }

    // Remove item from top of stack.

    public function pop()
    {
//        var_dump($this->first);
        $item = $this->first->item;
        $this->first = $this->first->next;
        $this->N--;
        return $item;
    }

}


class Node {
    public $item;
    public $next;
}

$stack = new Stack();

$stack->push("red");
$stack->push("orange");
$stack->push("yellow");

echo $stack->size() . '<br/>';
echo $stack->isEmpty() . '<br/>';


while(!$stack->isEmpty()) {
    echo '' . $stack->pop() . '<br/>';
}
