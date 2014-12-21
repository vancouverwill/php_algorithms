<?php



/*
 * a min priority queue
 *
 * gives us delMin and insert in logarthimic time
 *
 * gives us min, size, is empty in constant time
 *
 * array representation
 *
 *
 *
 */
class MinPriorityQueueBinaryHeap {
    private $pq;
    private $N; //number of items on priority queue so far

    public function __construct($capacity)
    {
            $this->pq = new SplFixedArray($capacity + 1);

        $this->N = 0;
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


    /**
     *
     * Return the smallest key on the priority queue.
     * @return type
     * @throws Exception
     */
    public function min()
    {
        if ($this->isEmpty()) throw new Exception ("Priority queue underflow");
        return $this->pq[1];
    }


    /**
     * helper function to double the size of the heap array
     * @param type $capacity
     */
    private function resize($capacity)
    {
        assert($capacity > 0);
            $temp = new SplFixedArray($capacity);
            for ($i = 1; $i <= $this->N; $i++) {
                $temp[$i] = $this->pq[$i];
            }
            $this->pq = $temp;
    }


    /**
     * Add a new key to the priority queue.
     */
    public function insert($x)
    {
        // double size of array if necessary
        if ($this->N >= count($this->pq) - 1) {
            $this->resize(2 * count($this->pq));
        }

        // add x, and percolate it up to maintain heap invariant
        $this->N++;
        $this->pq[$this->N] = $x;
        $this->swim($this->N);
        assert($this->isMinHeap());
    }

    public function insertArray($array)
    {
        if (is_array($array)) {
            foreach ($array as $value) {
                $this->insert($value);
            }
        }
    }

    /**
     * Delete and return the largest key on the priority queue.
     * @throws Exception if priority queue is empty.
     */
    public function delMin()
    {
        if ($this->isEmpty()) {
            throw new Exception("Priority queue underflow");
        }
        $min = $this->pq[1];
        $this->exch(1, $this->N--);
        $this->sink(1);
        $this->pq[$this->N + 1] = null; // to avoid loiterig and help with garbage collection
        if ($this->N > 0 && $this->N == ((count($this->pq) - 1) /4)) {
            $this->resize(count($this->pq) / 2);
        }
        assert($this->isMinHeap());
        return $min;
    }

    /***********************************************************************
     * Helper functions to restore the heap invariant.
     **********************************************************************/

    private function swim($k)
    {
        while ($k > 1 && $this->less($k, floor($k/2))) {
            $this->exch($k, floor($k/2));
            $k = floor($k/2);
        }
    }


    private function sink($k)
    {
        while (2 * $k <= $this->N) {
            $j = 2 * $k;
            if ($j < $this->N && $this->less($j + 1, $j)) {
                $j++;
            }
            if (!$this->less($j, $k)) {
                break;
            }
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
    private function less($i, $j)
    {
        if ($this->pq[$i] < $this->pq[$j]) {
            return true;
        } else {
            return false;
        }
    }


    private function exch( $i, $j)
    {
        $swap = $this->pq[$i];
        $this->pq[$i] = $this->pq[$j];
        $this->pq[$j] = $swap;
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

}

function sampleUsageMinPriorityQueue()
{
    $pq = new MinPriorityQueueBinaryHeap(5);
    $pq->insert(15);
    $pq->insert(175);
    $pq->insert(125);
    $pq->insert(25);
    $pq->insert(5);

    echo "size:" . $pq->size() . "<br/>";
    echo "isMinHeap:" . $pq->isMinHeap() . "<br/>";

    echo $pq->min() . "<br/>";
    $pq->delMin();
    echo $pq->min() . "<br/>";
    $pq->delMin();
    echo $pq->min() . "<br/>";
    $pq->delMin();
    echo $pq->min() . "<br/>";
    $pq->delMin();
    echo $pq->min() . "<br/>";
    $pq->delMin();
}

