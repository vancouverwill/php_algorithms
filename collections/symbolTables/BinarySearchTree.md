# Binary Search Tree

like a sorted array but + FAST (logarithmic) inserts + deletes!

## Properties

A binary search  tree is either:
・Empty.
・Two disjoint binary trees (left and right).

Symmetric order. Each node has a key, and every node’s key is:
・Larger than all keys in its left subtree. ・Smaller than all keys in its right subtree.

Binary Search Trees enforce this order, binary trees don't necessarily enforce

As keys are put on at different times there are many possible trees for a set of keys

height could be anywhere from log(n) (best case) to n (worst case)

# Functions

SEARCH                      θ(log(n)) - start at root, traverse left (key < current node) or right (key > current node) as needed, return node with key or null


MIN/MAX                     O(log(n)) - start at root and go as far left/right as you can
PRED/SUCC                   O(log(n)) - for pred - if  left subtree non empty, return max key in left subtree, other wise follow parent pointers to a key less than K ( happens first time you turn left). for successor do this the opposite way

SELECT                      O(log(n)) - for select and rank need to store size of tree at each node a = size(lTree) + size(rTree) + 1. Select position s, start at root if // todo finish this
RANK                        O(log(n))
OUTPUT IN SORTED ORDER      O(n)
INSERT                      O(log(n)) - ?????? // todo finish insert

DELETE                      O(log(n))
    Search for deleted key k
    1. If k has no children then just delete k's node from tree
    2. If k has one child (unique child swaps with position previously held by k)
    3. If k has 2 children +. Need to find k's predecessor l. get left child ptr, then right child ptr until no longer possible. swap k and l

Examples


## In-order traversal
- let r = root, with subtrees TL and TR
- recurse on TL (if exists)
- print out r (root) key
- recurse on TR (if exists)

(because of recursion(induction) it will go down to the smallest element then start out printing keys in increasing order)

## Balanced Search Tree

The worst case for most tree operations is O(n) and this only happens if the tree is completely off balance and all on one side (so forming a diagonal line down to the left or right).

A balanced search tree spreads out nodes evenly so the bottom of the tree is close to flat with an even spread. This balance ensures most functions will run in O(log(n)) (insert/delete/search/min/max/pred/succ). The most famous balanced search tree is the red black tree. Also there are others including AUL trees, splay trees, B treees

## Red Black Trees

### Red Black Tree Invariants

1. Each Node Red or Black

2. Root is black

3. No 2 reds in a row, therefore a red node must have two black children

4. Every root-NULL path has same number of black nodes

## Choosing a tree

Balanced Binary Search Tree is good if you need rich set of functions such as insertion, deletion, min, max

If you just need min OR max (but not both) then binary heap would be enough

For fast lookups ( insertion, deletion) only then use a hash table





