

# Purpose:
Maintain a possibly evolving SET of stuff.

## Most important functions
- insert
- delete
-lookup (check a particular record exists)

## Load Factor of hash table
- alpha (α) = # of objects in hash table / # of buckets in hash table

1.) = O(1) is necessary condition for operations to run in constant time.
2.) with open addressing, need << 1

For good hash table performance need to control load factor and need a good hash function.

Ideal super-clever hash function that is guaranteed to spread out data evenly.

HOWEVER does not exist! For every hash function there is a pathological data set

## examples
- transactions
- people + associated data
- IP addresses
- symbol tables in compilers
- blocking network traffic etc

## Amazing guarantee: All operations in O(1) time! provided it is properly implemented and provided non-pathological data.

An input (or set of inputs) is said to be pathological if it causes atypical behavior from the algorithm, such as a violation of its average case complexity, or even its correctness



## Goal : Remove Duplicates
i.e. Great for storing unique objects

e.g. report unique visitors to website

solution when new object arrives
    - lookup x in hash table H
    - if not found, Insert x into H

## Application Two sum problem

input: unsorted array of integers. Target sum t.

Goal: determine whether or not there are two numbers x,y in A with x + y = t

Naive Solution : O(n^2)

Better solution:
1. Sort A O(nlogn) time
2. then for each x look for y (which is t - x) with binary search which is also O(nlogn)

Amazing:
1. insert all elements of A into hash table H O(n) time
2. for each x in A, lookup t-x


## Resolving Conflicts

### Solution 1 (Separate) Chaining
-keep linked list in each bucket
- given a key/object x, perform insert/delete/lookup in the list A[h(x)]

### Solution 2 Open Addressing / Linear Probing
- hash function now specifies probe sequence h1(x), h2(x)...
-

