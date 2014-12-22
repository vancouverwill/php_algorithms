<?php
namespace PHP_Algorithms\sandbox;

class RecursiveArraySwitchObjectOriented
{
    private $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function reverse()
    {
        $this->recursivelyReverse(0, count($this->array) - 1);
    }

    private function recursivelyReverse($lowerPointer, $higherPointer)
    {
        if ($lowerPointer >= $higherPointer) {
            return;
        }
        $lastElement = $this->array[$higherPointer];
        $this->array[$higherPointer] = $this->array[$lowerPointer];
        $this->array[$lowerPointer] = $lastElement;
        $this->recursivelyReverse($lowerPointer + 1, $higherPointer - 1);
    }

    /**
     * @return mixed
     */
    public function getArray()
    {
        return $this->array;
    }
}

$array = array(0,1,2,3,4,5,6,7);
$recursiveArraySwitchObjectOriented = new recursiveArraySwitchObjectOriented($array);
$recursiveArraySwitchObjectOriented->reverse();

var_dump($recursiveArraySwitchObjectOriented->getArray());
