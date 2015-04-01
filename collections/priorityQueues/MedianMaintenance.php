<?php
/**
 *
 * maintain median on an array by using two binary heaps
 * a max binary heap for the lower half and a min binary heap for the top half
 *
 *
 * to maintain equilibrium
 *
 * if the lower half gets bigger than the other then take the max from the lower half and add to higher half
 *
 * if the higher half gets bigger than the lower half then take the min from the higher half and add to lower
 *
 *
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 2014-11-29
 * Time: 1:29 PM
 */
namespace PHP_Algorithms\collections\priorityQueues;

require_once(__DIR__ . "/../../vendor/autoload.php");

class MedianMaintenance
{


    private $HeapLow; /** @var MaxPriorityQueueBinaryHeap  */
    private $HeapHigh; /** @var MinPriorityQueueBinaryHeap */
    private $sumMedians;


    public function __construct($filename)
    {
        $fileNumberOfIntegers = count(file($filename));
        $this->HeapLow = new MaxPriorityQueueBinaryHeap($fileNumberOfIntegers/2);
        $this->HeapHigh = new MinPriorityQueueBinaryHeap($fileNumberOfIntegers/2);


        $handle = fopen($filename, "r");

        $this->sumMedians = 0;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (!$this->HeapLow->isEmpty() && (int)$line < $this->HeapLow->max()) {
                    $this->HeapLow->insert((int)$line);
                } elseif (!$this->HeapHigh->isEmpty() && (int)$line > $this->HeapHigh->min()) {
                    $this->HeapHigh->insert((int)$line);
                } else {
                    $this->HeapLow->insert((int)$line);
                }


                $this->balance();

//                echo $this->showMedian();
//                echo "<br/>";


                $this->sumMedians += $this->showMedian();




//                $lowSize = $this->HeapLow->size();
//                $lowMax = $this->HeapLow->max();
//                $highSize = $this->HeapHigh->size();
//                $highMin = $this->HeapHigh->min();
            }
        } else {
            // error opening the file.
            echo "no file exists";
        }
        fclose($handle);

        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo $this->sumMedians;

    }

    public function getMedian()
    {
        $median = $this->HeapLow->delMax();
        $this->balance();
        return $median;
    }

    public function showMedian()
    {
        $median = $this->HeapLow->max();
        return $median;
    }

    private function balance()
    {
        if ($this->HeapLow->size() - 1 > $this->HeapHigh->size()) {
            $temp = $this->HeapLow->delMax();
            $this->HeapHigh->insert($temp);
        } elseif ($this->HeapHigh->size() > $this->HeapLow->size()) {
            $temp = $this->HeapHigh->delMin();
            $this->HeapLow->insert($temp);
        }
    }
}

new MedianMaintenance("Median.txt");  // 1213
//new MedianMaintenance("MedianTestSet1.txt");
