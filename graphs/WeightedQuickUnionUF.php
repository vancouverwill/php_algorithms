<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-06-07
 * Time: 12:02 PM
 */

class WeightedQuickUnionUF {
    private $id; // @array of integers parent of i
    private $sz; // @array number of objects in subtree rooted at i
    private $count; // int number of components

    public function create_fixed_size($N) {
        $this->count = $N;
        $this->id = array();
        $this->sz = array();
        for ($i = 0; $i < $N; $i++) {
            $this->id[$i] = $i;
            $this->sz[$i] = 1;
        }
    }

    public function intialize_with_variable_size()
    {
        $this->count = 0;
        $this->id = array();
        $this->sz = array();
    }

    public function add_new_vertice($i)
    {
        if ($this->find($i)) return FALSE;
        $this->count++;
        $this->id[$i] = $i;
        $this->sz[$i] = 1;
    }

    public function count()
    {
        return $this->count;
    }

    /**
     * Returns the component identifier for the component containing site
     * @param p the integer representing one site
     * @return the component identifier for the component containing site
     */
    public function find($p)
    {
        if (!isset($this->id[$p])) return FALSE;

        while($p != $this->id[$p]) {
            $p = $this->id[$p];
        }
        return $p;
    }

    public function connected($p, $q)
    {
        return $this->find($p) == $this->find($q);
    }

    public function union($p, $q)
    {
        $rootP = $this->find($p);
        $rootQ = $this->find($q);
        if ($rootP == $rootQ) return;

        // make smaller root point to larger one
        if   ($this->sz[$rootP] < $this->sz[$rootQ]) { $this->id[$rootP] = $rootQ; $this->sz[$rootQ] += $this->sz[$rootP]; }
        else                         { $this->id[$rootQ] = $rootP; $this->sz[$rootP] += $this->sz[$rootQ]; }
        $this->count--;
    }
} 