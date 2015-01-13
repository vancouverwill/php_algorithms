<?php


class StackNode
{
    public $item;
    public $next;

    public function __construct($item, $next)
    {
        $this->item = $item;
        $this->next = $next;
    }
}
