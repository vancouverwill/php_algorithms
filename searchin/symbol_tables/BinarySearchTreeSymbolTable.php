<?php

/*
 * A binary tree has smaller values to the left and larger values to the right.
 *
 * Here I have implemented the Node with public fields so don't have to use accessors or setters.
 *
 * A symbol table implemented with a binary search tree.
 *
 * http://algs4.cs.princeton.edu/32bst/BST.java.html
 *
 */
class BinarySearchTreeSymbolTable {
    private $root; // Node
    
    public function isEmpty()
    {
        if ($this->size_all() == 0) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * @param node $node
     * @return mixed
     */
    public function size_all()
    {
            return $this->size($this->root);
    }

    private function size($node)
    {
        if ($node == null) {
            return 0;
        }
        else {
            return $node->getNum();
        }
    }


    /***********************************************************************
     *  Search BST for given key, and return associated value if found,
     *  return null if not found
     ***********************************************************************/
    public function contains($key)
    {
        if ($this->get($key) != null) {
            return true;
        }
        else {
            return false;
        }
    }

    // return value associated with the given key, or null if no such key exists
    public function get($key)
    {
        return $this->get_recursive($this->root, $key);
    }


//    private function get_recursive($nodeX = 'root', $key)
    private function get_recursive($nodeX, $key)
    {
//        if ($nodeX == 'root') { $this->get_recursive($this->root, $key) } // might be able to use this to get away with out to get funciton
        if ($nodeX == null) { return null; }
        $cmp = $this->compareTo($key, $nodeX->getKey());
        if ($cmp < 0) return $this->get_recursive($nodeX->left, $key);
        if ($cmp > 0) return $this->get_recursive($nodeX->right, $key);
        else return $nodeX->value;
    }


    /***********************************************************************
     *  Insert key-value pair into BST
     *  If key already exists, update with new value
     ***********************************************************************/
    public function put($key, $val) {
        if ($val == null) {
            $this->delete($key);
            return;
        }
        $this->root = $this->put_recursive($this->root, $key, $val);
        assert($this->check());
    }


    private function put_recursive($nodeX, $key, $val)
    {
        if ($nodeX == null) { return new Node($key, $val, 1); }
        $cmp = $this->compareTo($key, $nodeX->getKey());
        if ($cmp < 0) $nodeX->left = $this->put_recursive($nodeX->left, $key, $val);
        if ($cmp > 0) $nodeX->right = $this->put_recursive($nodeX->right, $key, $val);
        else $nodeX->val = $val;

        $nodeX->N = 1 + $this->size($nodeX->left) + $this->size($nodeX->right);

        return $nodeX;

    }


    /***********************************************************************
     *  Rank and selection
     ***********************************************************************/


    public function select($k)
    {
        if ($k < 0 || $k >= $this->size_all()) return null;
        $x = $this->select_recursive($this->root, $k);
        return $x->key;
    }

    private function select_recursive($nodeX, $k)
    {
        if ($nodeX == null) return null;
        $t = $this->size($nodeX->left);
        if ($t > $k) return $this->select($nodeX->left, $k);
        if ($t < $k) return $this->select($nodeX->right, $k - $t - 1);
        else    return $nodeX;
    }


    public function rank($key)
    {
        $this->rank_recursive($key, $this->root);
    }

    private function rank_recursive($key, $nodeX)
    {
        if ($nodeX == null) return 0;
        $cmp = $this->compareTo($key, $nodeX->key);
        if ($cmp < 0) {
            return $this->rank_recursive($key, $nodeX->left);
        }
        elseif ($cmp > 0 ) {
            return 1 + $this->size($nodeX->left) + $this->rank($key, $nodeX->right);
        }
        else {
            return $this->size($nodeX->left);
        }
    }



    // check integrity of Binary Search Tree Symbol Table

    private function check()
    {
        if (!$this->isBinarySearchTreeSymbolTableRecursive($this->root, null, null)) {
            print "Not in symetric order";
            return false;
        }
        // isSizeConsistent
//        isRankConsistent

        return $this->isBinarySearchTreeSymbolTableRecursive($this->root, null, null);
    }

    // does this binary tree satisfy symmetric order?
    // Note: this test also ensures that data structure is a binary tree since order is strict
    // is the tree rooted at x a BinarySearchTreeSymbolTable with all keys strictly between min and max
    // (if min or max is null, treat as empty constraint)
    // Credit: Bob Dondero's elegant solution
    private function isBinarySearchTreeSymbolTableRecursive($node, $minKey, $maxKey)
    {
        if ($node == null) return true;
        if ($minKey != null && $node->getKey() <= $minKey) return false;
        if ($maxKey != null && $node->getKey() >= $maxKey) return false;
        return $this->isBinarySearchTreeSymbolTableRecursive($node->getLeft(), $minKey, $node->getKey()) && $this->isBinarySearchTreeSymbolTableRecursive($node->getRight(), $node->getKey(), $maxKey);
    }


    // are the size fields correct?
    /*
     * @param Node $node
     * @return recursive
     */
    private function isSizeConsistent($node)
    {
        if ($node == null) return true;
        if ($node->getNum() != $this->size($node->getLeft()) + $this->size($node->getRight()) + 1) return false;
        return $this->isSizeConsistent($node->getLeft()) && $this->isSizeConsistent($node->getRight());
    }



    /**
     *
     * check that ranks are consistent
     */
    private function isRankConsistent() {
        for ($i = 0; $i < $this->size_all(); $i++) {
            if ($i != $this->rank($this->select($i))) return false;
        }
        foreach ($this->keys() AS $key) {
            if ($this->compareTo($key, $this->select($this->rank($key))) != 0) return false;
        }
        return true;
    }

    /**
     *
     * Compares this object with the specified object for order.  Returns a
     * negative integer, zero, or a positive integer as this object is less
     * than, equal to, or greater than the specified object.
     *
     * todo check this
     */
    private function compareTo($thisKey, $thatKey)
    {
        if ($thisKey < $thatKey) return -1;
        elseif ($thisKey > $thatKey) return +1;
        else return 0;
    }
}


class Node {
    public $key;       //assorted by key
    public $value;     //associated data
    public $left;      //left subtree
    public $right;     //right subtree
    public $N;         //number of nodes in subtree
    
    public function __construct($key, $value, $N) {
        $this->key = $key;
        $this->value = $value;
        $this->N = $N;
    }

    public function getNum(){
        return $this->N;
    }

    public function getKey(){
        return $this->key;
    }

    public function getLeft(){
        return $this->left;
    }


    public function getRight(){
        return $this->right;
    }

    public function getValue(){
        return $this->value;
    }


}

//Example Usage

$symbolTable = new BinarySearchTreeSymbolTable();

$symbolTable->put("snow", 1);
$symbolTable->put("sun", 2);
$symbolTable->put("rain", 3);
$symbolTable->put("shine", 4);
$symbolTable->put("cloud", 5);
$symbolTable->put("cloud", 7);

echo $symbolTable->size_all();