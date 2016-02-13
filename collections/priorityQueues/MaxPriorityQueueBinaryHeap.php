<?php
/**
 * a max priority queue
 *
 * using an array representation i.e. an array of all the items not connected nodes
 *
 **/

namespace PHP_Algorithms\collections\priorityQueues;

class MaxPriorityQueueBinaryHeap
{
    private $pq;
    private $N; //size

    public function __construct($capacity)
    {
        $this->pq = new \SplFixedArray($capacity + 1);

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
        } else {
            return false;
        }
    }
    
    
    /**
     *
     * Return the largest key on the priority queue.
     * @return mixed
     * @throws \Exception
     */
    public function max()
    {
        if ($this->isEmpty()) {
            throw new \Exception("Priority queue underflow");
        }
        return $this->pq[1];
    }
    
    
    /**
     * helper function to double the size of the heap array
     * @param type $capacity
     */
    private function resize($capacity)
    {
        assert($capacity > 0);
        $temp = new \SplFixedArray($capacity);
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
        assert($this->isMaxHeap());
        
        $this->isMaxHeap();
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
     * @throws \Exception if priority queue is empty.
     */
    public function delMax()
    {
        if ($this->isEmpty()) {
            throw new \Exception("Priority queue underflow");
        }
        $max = $this->pq[1];
        $this->exch(1, $this->N--); // N-- because we want to decrease the value after exchange has run
        $this->sink(1);
        $this->pq[$this->N + 1] = null; // to avoid loiterig and help with garbage collection, note N+1 because the element being removed doesn't count to the total anymore
        if ($this->N > 0 && $this->N == ((count($this->pq) - 1) /4)) {
            $this->resize(count($this->pq) / 2);
        }
        assert($this->isMaxHeap());
        return $max;
    }
    
    /***********************************************************************
    * Helper functions to restore the heap invariant.
    **********************************************************************/
    
    private function swim($k)
    {
        while ($k > 1 && $this->less(floor($k/2), $k)) {
            $this->exch($k, floor($k/2));
            $k = floor($k/2);
        }
    }
    
    
    private function sink($k)
    {
        while (2 * $k <= $this->N) {
            $j = 2 * $k;
            if ($j < $this->N && $this->less($j, $j + 1)) {
                $j++;
            }
            if (!$this->less($k, $j)) {
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
    
    
    private function exch($i, $j)
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
    public function isMaxHeap($k = 1)
    {
        if ($k > $this->N) {
            return true;
        }
        $left = 2 * $k;
        $right = 2 * $k + 1;
        if ($left <= $this->N && $this->less($k, $left)) {
            return false;
        }
        if ($right <= $this->N && $this->less($k, $right)) {
            return false;
        }
        return $this->isMaxHeap($left) && $this->isMaxHeap($right);
    }
}

function sampleUsageMaxPriorityQueue()
{
    $pq = new MaxPriorityQueueBinaryHeap(10);
    $pq->insert(15);
    $pq->insert(175);
    $pq->insert(125);
    $pq->insert(25);
    $pq->insert(5);

    echo "size:" . $pq->size() . "<br/>";
    echo "isMaxHeap:" . $pq->isMaxHeap() . "<br/>";

    echo $pq->max() . "<br/>";
    $pq->delMax();
    echo $pq->max() . "<br/>";
    $pq->delMax();
    echo $pq->max() . "<br/>";
    $pq->delMax();
    echo $pq->max() . "<br/>";
    $pq->delMax();
    echo $pq->max() . "<br/>";
    $pq->delMax();
}
