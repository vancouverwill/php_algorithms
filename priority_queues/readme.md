A binary heap only guarantees that elements on lower levels have smaller values for max-heap and higher values for min-heap.


### background:

The most simple way to code a priority queue would be on a one dimensional array (ordered or unordered) or one dimensional linked-list.

- An unordered array would have a O(1) cost of insertion but o(n) cost for removing the maximum

- An ordered array would have a 0(n) cost of insertion but would be quick to remove the maximum at o(n)

- If we used a linked-list we could modify a stack and either find at the point of pop or order at the point of push. This would give the same spread of order of growth as on an array


## Heap representation


