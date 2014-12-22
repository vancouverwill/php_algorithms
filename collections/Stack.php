<?php
/**
 * Class Stack
 *
 * todo create iterator
 */

namespace PHP_Algorithms\collections;

require_once(__DIR__ . "/../vendor/autoload.php");

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
}




?>

