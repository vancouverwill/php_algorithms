# Heaps

- A container for objects that have keys

- insert O(log(n)) - insert at end of last level then swim up until balanced
- delete O(log(n)) -
- extractMin O(log(n)) - delete root, set last leaf to be new root, sink root until balanced


applications    - sorting - HeapSort
                - event management - key is event time, object is an event. Sort on keys so we can get the next upcoming event
                - median maintenance - two heaps
                    1. HeapLow(supports getMax()) which contains keys <= median
                    2. HeapHigh(supports getMin()) which contains keys >= median


## Conceptually - think of a heap as a tree. rooted and binary (balanced) as much as possible

Min Heap Property - At every node x, Key[x] <= all keys of x's children

Max Heap is the opposite

Consequence - object at root must always have minimum value