<?php



/*
 * an indexed min priority queue
 *
 * as well as the normal functions from a min priority queue we now get delete at index and change key at index functionality
 *
 * gives us delMin and insert in logarthimic time and min, size, is empty in constant time
 *
 * array representation
 *
 *
 *
 */
class IndexedMinPriorityQueueBinaryHeap {
    private $pq;  /** @var  SplFixedArray int - binary heap using 1-based indexing */
    private $qp;  /** @var  SplFixedArray int - inverse of pq - qp[pq[i]] = pq[qp[i]] = i */
    private $keys;  /** @var  SplFixedArray object - keys[i] = priority of i */
    private $NMAX; // max number of elements on priority queue
    private $N; //number of items on priority queue so far
    private $debug = TRUE;


    public function __construct($capacity)
    {
        $this->NMAX = $capacity;
        $this->pq = new SplFixedArray($capacity + 1);
        $this->qp = new SplFixedArray($capacity + 1);
        $this->keys = new SplFixedArray($capacity + 1);
        $this->N = 0;

        for ($i = 0; $i <= $this->NMAX; $i++) $this->qp[$i] = -1;
    }


    public function size()
    {
        return $this->N;
    }


    public function isEmpty()
    {
        if ($this->N == 0) {
            return true;
        }
        else {
            return false;
        }
    }


    public function contains($i)
    {
        if ($i < 0 || $i >= $this->NMAX) {
            throw new InvalidArgumentException("Out of bounds");
        }
        return ($this->qp[$i] != -1);
    }


    /**
     *
     * Return the index associated with the smallest key on the priority queue.
     * @return type
     * @throws Exception
     */
    public function minIndex()
    {
        if ($this->isEmpty()) throw new Exception ("Priority queue underflow");
        return $this->pq[1];
    }


    /**
     *
     * Return the index associated with the smallest key on the priority queue.
     * @return type
     * @throws Exception
     */
    public function minKey()
    {
        if ($this->isEmpty()) throw new Exception ("Priority queue underflow");
        return $this->keys[$this->pq[1]];
    }


    /**
     * helper function to double the size of the heap array
     * @param type $capacity
     */
    private function resize($capacity)
    {
        assert($capacity > 0);
        if ($this->debug = FALSE) {
            $temp = new SplFixedArray($capacity);
            for ($i = 1; $i <= $this->N; $i++) {
                $temp[$i] = $this->pq[$i];
            }
            $this->pq = $temp;
        }
        else {

        }
    }


    /**
     * Add a new $key with index $i to the priority queue.
     */
    public function insert($i, $key)
    {
        // double size of array if necessary
//        if ($this->N >= count($this->pq) - 1) {
//            $this->resize(2 * count($this->pq));
//        }

        // add x, and percolate it up to maintain heap invariant
        $this->N++;
        $this->qp[$i] = $this->N;
        $this->pq[$this->N] = $i;
        $this->keys[$i] = $key;
        $this->swim($this->N);
        assert($this->isMinHeap());

        $temp = $this->isMinHeap();
    }


//    public function insert_array($array)
//    {
//        if (is_array($array)) {
//            foreach($array AS $value) {
//                $this->insert($value);
//            }
//        }
//    }


    /**
     * Delete and return the largest key on the priority queue.
     * @throws Exception if priority queue is empty.
     */
    public function delMin()
    {
        if ($this->isEmpty()) { throw new Exception("Priority queue underflow"); }
        $min = $this->pq[1];
        $this->exch(1, $this->N--);
        $this->sink(1);
        $this->pq[$this->N + 1] = -1; // to avoid loiterig and help with garbage collection
        $this->qp[$min] = -1; // to avoid loiterig and help with garbage collection

        assert($this->isMinHeap());
        return $min;
    }


    /**
     * Delete the key associated with index i
     * @param $i
     */
    public function delete($i)
    {
        if ($i < 0 || $i >= $this->NMAX) {
            throw new InvalidArgumentException("Out of bounds");
        }
        if (!$this->contains($i)) {
            throw new InvalidArgumentException("index is not in the priority queue");
        }

        $index = $this->qp[$i];
        $this->exch($index, $this->N--);
        $this->swim($index);
        $this->sink($index);
        $this->keys[$i] = null;
        $this->qp[$i] = -1;

    }

    /***********************************************************************
     * Helper functions to restore the heap invariant.
     **********************************************************************/

    private function swim($k) {
        while ($k > 1 && $this->less($k, floor($k/2))) {
            $this->exch($k, floor($k/2));
            $k = floor($k/2);
        }
    }


    private function sink($k) {
        while(2 * $k <= $this->N) {
            $j = 2 * $k;
            if ($j < $this->N && $this->less($j + 1, $j)) $j++;
            if (!$this->less($j, $k)) { break; }
            $this->exch($k, $j);
            $k = $j;
        }
    }

    /**
     *
     * @param int $i exchange number 1
     * @param int $j exhange number 2
     * @return boolean
     */
    private function less( $i, $j)
    {
        if ($this->keys[$this->pq[$i]] < $this->keys[$this->pq[$j]]){
            return true;
        }
        else {
            return false;
        }
    }


    private function exch( $i, $j)
    {
        $swap = $this->pq[$i];
        $this->pq[$i] = $this->pq[$j];
        $this->pq[$j] = $swap;

        $this->qp[$this->pq[$i]] = $i;
        $this->qp[$this->pq[$j]] = $j;
    }

    /**
     *
     *   is subtree of pq[1..N] rooted at k a max heap?
     *
     *
     */
    public function isMinHeap($k = 1)
    {
        if($k > $this->N) {return true;}
        $left = 2 * $k;
        $right = 2 * $k + 1;
        if ($left <= $this->N && $this->less($left, $k)) return FALSE;
        if ($right <= $this->N && $this->less($right, $k)) return FALSE;
        return $this->isMinHeap($left) && $this->isMinHeap($right);
    }


    public function decreaseKey($i, $key)
    {
        if ($i < 0 || $i >= $this->NMAX) {
            throw new InvalidArgumentException("Out of bounds");
        }
        if (!$this->contains($i)) {
            throw new InvalidArgumentException("index is not in the priority queue");
        }
        $this->keys[$i] = $key;
        $this->swim($this->qp[$i]);
    }


    public function increaseeKey($i, $key)
    {
        if ($i < 0 || $i >= $this->NMAX) {
            throw new InvalidArgumentException("Out of bounds");
        }
        if (!$this->contains($i)) {
            throw new InvalidArgumentException("index is not in the priority queue");
        }
        $this->keys[$i] = $key;
        $this->sink($this->qp[$i]);
    }

}


function showSampleUsage() {
    $pq = new IndexedMinPriorityQueueBinaryHeap(5);
    $pq->insert(1, 15);
    $pq->insert(2, 175);
    $pq->insert(3, 125);
    $pq->insert(4, 25);
    $pq->insert(5 , 5);

    echo "size:" . $pq->size() . "<br/>";
    echo "isMinHeap:" . $pq->isMinHeap() . "<br/>";

    echo "index:" . $pq->minIndex() . "<br/>";
    echo "key" . $pq->minKey() . "<br/>";
    $pq->delMin();

    echo "index:" . $pq->minIndex() . "<br/>";
    echo "key" . $pq->minKey() . "<br/>";
    $pq->delMin();

    echo "index:" . $pq->minIndex() . "<br/>";
    echo "key" . $pq->minKey() . "<br/>";
    $pq->delMin();

    echo "index:" . $pq->minIndex() . "<br/>";
    echo "key" . $pq->minKey() . "<br/>";
    $pq->delMin();

    echo "index:" . $pq->minIndex() . "<br/>";
    echo "key" . $pq->minKey() . "<br/>";
    $pq->delMin();
}




