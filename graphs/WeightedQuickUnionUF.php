<?php
namespace PHP_Algorithms\graphs;

class WeightedQuickUnionUF
{
    private $id; // @array of integers parent of i
    private $sz; // @array number of objects in subtree rooted at i
    private $count; // int number of components

    public function createFixedSize($N)
    {
        $this->count = $N;
        $this->id = new \SplFixedArray($N);
        $this->sz = new \SplFixedArray($N);
        for ($i = 0; $i < $N; $i++) {
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
     * @param p the integer representing one site
     * @return the component identifier for the component containing site
     */
    public function find($p)
    {
        if (!isset($this->id[$p])) {
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

    public function union($p, $q)
    {
        $rootP = $this->find($p);
        $rootQ = $this->find($q);
        if ($rootP == $rootQ) {
            return;
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
    }
}
