Binary Heap or Heap Data Structure

Used to calculate min or max and to keep priority order.

A binary heap only guarantees that elements on lower levels have smaller values for max-heap and higher values for min-heap.

Complete tree. Perfectly balanced, except for bottom level.

Property - Height of complete tree with N nodes is lg N

For a balanced tree height only increases when N is a power of 2

Binary Heap - Parents keys no smaller than children's keys

### Background:

The most simple way to code a priority queue would be on a one dimensional array (ordered or unordered) or one dimensional linked-list.

- An unordered array would have a o(1) cost of insertion but o(n) cost for removing the maximum

- An ordered array would have a o(n) cost of insertion but would be quick to remove the maximum at o(n)

- If we used a linked-list we could modify a stack and either find at the point of pop or order at the point of push. This would give the same spread of order of growth as on an array


## Heap representation


