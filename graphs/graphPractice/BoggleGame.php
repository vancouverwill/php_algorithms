<?php

namespace PHP_Algorithms\graphs;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class BoggleGame
{
    private $letterGrid;
    private $width;
    private $height;

    
    public function __consruct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->letterGrid = new \SplFixedArray($this->width);

        for ($x = 0; $x < $this->width; $x++) {
            $this->letterGrid[$x] = new \SplFixedArray($this->height);

            for ($y = 0; $y < $this->height; $y++) {
                $this->letterGrid[$x][$y] = null;
            }
        }
    }


    public function addData($letters)
    {
        foreach ($letters as $x => $col) {
            foreach ($col as $y => $dice) {
                $this->letterGrid[$x][$y] = $dice;
            }
        }
    }


    public function getReachableDiceAsIterator($x, $y)
    {
        if ($x < 0 || $x >= $this->width || $y < 0 || $y >= $this->height) {
            throw new \InvalidArgumentException("out of range for getReachableDiceAsIterator({$x}, {$y})");
        }
        $dice = new \SplStack();
        if ($x > 0) {
            $dice->push($this->letterGrid[$x - 1][$y]);
        }
        if ($y > 0) {
            $dice->push($this->letterGrid[$x][$y - 1]);
        }
        if ($x < $this->width - 1) {
            $dice->push($this->letterGrid[$x + 1][$y]);
        }
        if ($y < $this->height - 1) {
            $dice->push($this->letterGrid[$x][$y + 1]);
        }
    }


    public function playGame($startX, $startY)
    {
        /**
         * 1. get current dice no
         * 2.
         */
    }


    public function coordinatesIntoDiceNumber($x, $y)
    {

    }


    public function diceNumberIntoXCoordinate($no)
    {

    }


    public function diceNumberIntoYCoordinate($no)
    {

    }
}
