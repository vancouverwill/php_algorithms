<?php
/**
 * Created by PhpStorm.
 * User: Will Melbourne
 * Date: 15-04-11
 * Time: 7:07 PM
 */

function showSampleUsage()
{
    $pq = new IndexedMinPriorityQueueBinaryHeap(5);
    $pq->insert(1, 15);
    $pq->insert(2, 175);
    $pq->insert(3, 125);
    $pq->insert(4, 25);
    $pq->insert(5, 5);

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