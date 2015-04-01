<?php
/**
 * Based on the traditional boggle game
 *
 * coordinates start from bottom left same as a regular graph
 *
 *  y |
 *    |
 *    |____
 *         x
 *
 * eg
 *   y
 *   2  6 7 8
 *   1  3 4 5
 *   0  0 1 2
 *      0 1 2 x
 *
 *
 */
namespace PHP_Algorithms\graphs;

require_once(__DIR__ . "/../../collections/Stack.php");
require_once(__DIR__ . "/../../collections/StackNode.php");

//use Doctrine\Instantiator\Exception\InvalidArgumentException;

class BoggleGame
{
    private $letterGrid;
    private $width;
    private $height;

    
    public function __construct($width, $height)
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

    public function addData($array)
    {
        $x = 0;
        $y = 0;
        foreach ($array AS $row) {
            foreach ($row AS $dice) {
                $this->letterGrid[$x][$y] = $dice;
                $x++;
            }
            $y++;
        }
    }


    public function addDataIndexesSet($letters)
    {
        foreach ($letters as $x => $col) {
            foreach ($col as $y => $dice) {
                $this->letterGrid[$x][$y] = $dice;
            }
        }
    }


    public function getReachableDiceAsIterator($x, $y)
    {
        $this->checkXY($x, $y);

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


        if ($x > 0 && $y > 0) {
            $dice->push($this->letterGrid[$x - 1][$y - 1]);
        }

        if ($x < $this->width - 1 && $y < $this->height - 1) {
            $dice->push($this->letterGrid[$x + 1][$y + 1]);
        }

        if ($x < $this->width - 1 && $y > 0) {
            $dice->push($this->letterGrid[$x + 1][$y - 1]);
        }

        if ($x > 0 && $y < $this->height - 1) {
            $dice->push($this->letterGrid[$x - 1][$y + 1]);
        }

        return $dice;
    }


    public function playGame($startX, $startY)
    {
        /**
         * 1. get current dice no
         * 2.
         */
        $currentPath = new Stack();
    }


    /**
     * @param $x
     * @param $y
     * @throws \InvalidArgumentException
     */
    public function coordinatesIntoDiceNumber($x, $y)
    {
        $this->checkXY($x, $y);

        $number = $y * $this->width + $x;

        return $number;
    }


    public function diceNumberIntoXCoordinate($no)
    {
        return $no % $this->width;
    }


    public function diceNumberIntoYCoordinate($no)
    {
        return ($no - ($no % $this->width)) / $this->width;
    }


    /**
     * @param $x
     * @param $y
     * @throws \InvalidArgumentException
     */
    private function checkXY($x, $y)
    {
        $this->checkX($x);
        $this->checkY($y);
    }


    private function checkX($x)
    {
        if ($x < 0 || $x >= $this->width) {
            throw new \InvalidArgumentException("x out of range for checkX({$x})");
        }
    }


    private function checkY($y)
    {
        if ($y < 0 || $y >= $this->height) {
            throw new \InvalidArgumentException("out of range for checkY({$y})");
        }
    }
}
