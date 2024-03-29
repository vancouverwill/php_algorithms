<?php
/**
 * Class Stack
 *
 * the most efficient way to push or pull a node is swapping the start. The alternative is to add on to the end of list.
 * This seems simpler logically but requires the user to loop through all the nodes from the start to the end.
 * Once we have the end we can either add onto the end or remove the last node on the path.
 * Comparing these is a case of 1 transaction to access the start or the size of the linked list N transactions to find the end.
 *
 * todo create iterator
 */


class Stack
{

    private $N; /** @var  int */
    private $first; /** @var StackNode */

    public function __construct()
    {
        $this->first = null;
    }

    public function isEmpty()
    {
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
        $this->first = new StackNode($item, $oldfirst);
        $this->N++;
    }


    /**
     * Remove item from top of stack.
     * */
    public function pop()
    {
        $item = $this->first->item;
        $this->first = $this->first->next;
        $this->N--;
        return $item;
    }

    public function iterator()
    {

    }
}


