<?php
namespace PHP_Algorithms\graphs;

use SebastianBergmann\Exporter\Exception;

/**
*
* Useful for joining and keeping track of disconnected components
*
**/
class WeightedQuickUnionUF
{
    private $id; // @array of integers parent of i
    private $sz; // @array number of objects in subtree rooted at i
    private $count; // int number of components

    private $allowedExpansion;

    private $startingIndex;

    public function createFixedSize($N, $startingIndex = 0, $allowedExpansion = false)
    {
        $this->allowedExpansion = $allowedExpansion;
        $this->startingIndex = $startingIndex;
        $this->count = $N;
        $this->id = new \SplFixedArray($N + $startingIndex);
        $this->sz = new \SplFixedArray($N + $startingIndex);
        for ($i = $this->startingIndex; $i < ($N + $this->startingIndex); $i++) {
            $this->id[$i] = $i;
            $this->sz[$i] = 1;
        }
    }

    public function reset()
    {
        $this->count = 0;
        $this->id = null;
        $this->sz = null;
    }


    public function addNewVertice($i)
    {
        if ($this->find($i)) {
            return false;
        }
        $this->count++;
        $this->id[$i] = $i;
        $this->sz[$i] = 1;
    }

    public function countComponents()
    {
        return $this->count;
    }


    public function countPoints()
    {
        return count($this->id);
    }

    /**
     * Returns the component identifier for the component containing site
     * Worse case O(n)
     * @param p the integer representing one site
     * @return the component identifier for the component containing site
     */
    public function find($p)
    {
        if (!isset($this->id[$p])) {
            if ($this->allowedExpansion == false) { throw new Exception("union find out of range"); }
            return false;
        }

        while ($p != $this->id[$p]) {
            $p = $this->id[$p];
        }
        return $p;
    }

    public function connected($p, $q)
    {
        return $this->find($p) === $this->find($q);
    }

    /** 
    * Worse case O(n)
    */
    public function union($p, $q)
    {
        $rootP = $this->find($p);
        $rootQ = $this->find($q);
        if ($rootP == $rootQ) {
            return false;
        }

        // make smaller root point to larger one
        if ($this->sz[$rootP] < $this->sz[$rootQ]) {
            $this->id[$rootP] = $rootQ;
            $this->sz[$rootQ] += $this->sz[$rootP];
        } else {
            $this->id[$rootQ] = $rootP;
            $this->sz[$rootP] += $this->sz[$rootQ];
        }
        $this->count--;

        return true;
    }
}
