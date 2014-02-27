<?php

/*
 * A binary tree has smaller values to the left and larger values to the right. With this simple logic it keeps and maintains the order between nodes.
 *
 * Here I have implemented the Node with public fields so don't have to use accessors or setters.
 *
 * A symbol table implemented with a binary search tree.
 *
 * example in JAVA : http://algs4.cs.princeton.edu/32bst/BST.java.html
 *
 * explanation : http://algs4.cs.princeton.edu/32bst/
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
     * return number of key-value pairs in BST
     * @param node $node
     * @return mixed
     */
    //
    public function size_all()
    {
            $size = $this->size($this->root);
        return $size;
    }


    /**
     * return number of key-value pairs in BST rooted at $nodeX
     * @param $node
     * @return int
     */
    private function size($nodeX)
    {
        if ($nodeX == null) {
            return 0;
        }
        else {
            return $nodeX->getNum();
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
        else return $nodeX->val;
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
     *  Delete
     ***********************************************************************/

    /**
     * f the left link of the root is null, the smallest key in a BST is the key at the root;
     * if the left link is not null, the smallest key in the BST is the smallest key in the subtree rooted at the node referenced by the left link.
     * @throws NoSuchElementException
     */
    public function delete_min()
    {
        if ($this->isEmpty()) throw new NoSuchElementException("Symbol table underflow");
        $this->root = $this->delete_min_recursive($this->root);
    }

    private function delete_min_recursive($nodeX)
    {
        //todo
    }

    //todo
    /***********************************************************************
     *  Min, max, floor, and ceiling
     ***********************************************************************/

    public  function min()
    {
        if ($this->isEmpty()) return null;
        $minNode = $this->min_recursive($this->root);
        return $minNode->key;
    }

    private function min_recursive($nodeX)
    {
        if ($nodeX->left == null) {
            return $nodeX;
        }
        else {
            return $this->min_recursive($nodeX->left);
        }
    }


    public function max()
    {
        if ($this->isEmpty()) return null;
        $maxNode = $this->max_recursive($this->root);
        return $maxNode->key;
    }

    private function max_recursive($nodeX)
    {
        if ($nodeX->right == null) {
            return $nodeX;
        }
        else {
            return $this->max_recursive($nodeX->right);
        }
    }

    /**
     * find the node smaller than equal to the search key
     * @param $key
     * @return null
     */
    public function floor($key)
    {
        $nodeX = $this->floorRecursive($this->root, $key);
        if ($nodeX == null) return null;
        else return $nodeX->key;
    }

    private function floorRecursive($nodeX, $key)
    {
        if ($nodeX == null) return null;
        $cmp = $this->compareTo($key, $nodeX->key);
        if ($cmp == 0) return $nodeX;
        if ($cmp < 0) return $this->floorRecursive($nodeX->left, $key);
        $t = $this->floorRecursive($nodeX->right, $key);
        if ($t != null) return $t;
        else return $nodeX;
    }


    public function ceiling($key)
    {
        $nodeX = $this->ceilingRecursive($this->root, $key);
        if ($nodeX == null) return null;
        else return $nodeX->key;
    }


    private function ceilingRecursive($nodeX, $key)
    {
        if ($nodeX == null) return null;
        $cmp = $this->compareTo($key, $nodeX->key);
        if ($cmp == 0) return $nodeX;
        if ($cmp < 0) {
            $t = $this->ceilingRecursive($nodeX->left, $key);
            if ($t != null) return $t;
            else return $nodeX;
        }
        return $this->ceilingRecursive($nodeX->right, $key);
    }


    /***********************************************************************
     *  Rank and selection
     ***********************************************************************/

    /**
     *  select the key of rank k (the key such that precisely k other keys in the BST are smaller)
     * @param $k
     * @return null
     */
    public function select($k)
    {
        if ($k < 0 ||$k >= $this->size_all()) return null;
        $x = $this->select_recursive($this->root, $k);
        return $x->key;
    }

    private function select_recursive($nodeX, $k)
    {
        if ($nodeX == null) return null;
        $t = $this->size($nodeX->left);
        if ($t > $k) return $this->select_recursive($nodeX->left, $k);
        if ($t < $k) return $this->select_recursive($nodeX->right, $k - $t - 1);
        else    return $nodeX;
    }


    public function rank($key)
    {
        return $this->rank_recursive($key, $this->root);
    }

    private function rank_recursive($key, $nodeX)
    {
        if ($nodeX == null) return 0;
        $cmp = $this->compareTo($key, $nodeX->key);
        if ($cmp < 0) {
            return $this->rank_recursive($key, $nodeX->left);
        }
        elseif ($cmp > 0 ) {
            return 1 + $this->size($nodeX->left) + $this->rank_recursive($key, $nodeX->right);
        }
        else {
            return $this->size($nodeX->left);
        }
    }


    /***********************************************************************
     *  Range count and range search.
     ***********************************************************************/

    public function keys()
    {
        $queue = new SplQueue();
        $this->keys_recursive($this->root, $queue, $this->min(), $this->max());
        return $queue;
    }


    private function keys_recursive($nodeX, $queue, $lo, $hi)
    {
        if ($nodeX == null) return;
        $cmplo = $this->compareTo($lo, $nodeX->key);
        $cmphi = $this->compareTo($hi, $nodeX->key);
        if ($cmplo < 0) $this->keys_recursive($nodeX->left, $queue, $lo, $hi);
        if ($cmplo <= 0 && $cmphi >= 0) $queue->push($nodeX->key);
        if ($cmphi > 0) $this->keys_recursive($nodeX->right, $queue, $lo, $hi);
    }



    // check integrity of Binary Search Tree Symbol Table

    private function check()
    {
        if (!$this->isBinarySearchTreeSymbolTableRecursive($this->root, null, null)) {
            print "Not in symetric order";
            return false;
        }
        if (!$this->isSizeConsistent($this->root)) {
            print "Ranks not consistent";
            return false;
        }
        if (!$this->isRankConsistent()) {
            print "Ranks not consistent";
            return false;
        }



        // isSizeConsistent
//        isRankConsistent

        return $this->isBinarySearchTreeSymbolTableRecursive($this->root, null, null) && $this->isSizeConsistent($this->root) && $this->isRankConsistent();
//        return $this->isBinarySearchTreeSymbolTableRecursive($this->root, null, null) && $this->isSizeConsistent($this->root);
    }

    // does this binary tree satisfy symmetric order?
    // Note: this test also ensures that data structure is a binary tree since order is strict
    // is the tree rooted at x a BinarySearchTreeSymbolTable with all keys strictly between min and max
    // (if min or max is null, treat as empty constraint)
    // Credit: Bob Dondero's elegant solution
    private function isBinarySearchTreeSymbolTableRecursive($nodeX, $minKey, $maxKey)
    {
        if ($nodeX == null) return true;
        if ($minKey != null && $nodeX->getKey() <= $minKey) return false;
        if ($maxKey != null && $nodeX->getKey() >= $maxKey) return false;
        return $this->isBinarySearchTreeSymbolTableRecursive($nodeX->getLeft(), $minKey, $nodeX->getKey()) && $this->isBinarySearchTreeSymbolTableRecursive($nodeX->getRight(), $nodeX->getKey(), $maxKey);
    }


    // are the size fields correct?
    private function isSizeConsistent($nodeX)
    {
        if ($nodeX == null) return true;
        if ($nodeX->N  != $this->size($nodeX->left) + 1 + $this->size($nodeX->right)) { return false; }
        return $this->isSizeConsistent($nodeX->left) && $this->isSizeConsistent($nodeX->right);
    }


    // are the size fields correct?
    /*
     * @param Node $node
     * @return recursive
     */
//    private function isSizeConsistent($node)
//    {
//        if ($node == null) return true;
//        if ($node->getNum() != $this->size($node->getLeft()) + $this->size($node->getRight()) + 1) return false;
//        return $this->isSizeConsistent($node->getLeft()) && $this->isSizeConsistent($node->getRight());
//    }



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
    public $val;     //associated data
    public $left;      //left subtree
    public $right;     //right subtree
    public $N;         //number of nodes in subtree
    
    public function __construct($key, $val, $N) {
        $this->key = $key;
        $this->val = $val;
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
$symbolTable->put("rain", 4);
$symbolTable->put("rain", 3);
//$symbolTable->put("shine", 4);
$symbolTable->put("cloud", 5);
$symbolTable->put("cloud", 7);
//$symbolTable->put("cloud", 9);

echo "<h2>Size:" . $symbolTable->size_all() . "</h2>";
//
echo "<h2>get sun:" . $symbolTable->get("sun") . "</h2>";
echo "<h2>get rain:" . $symbolTable->get("rain") . "</h2>";
echo "<h2>get cloud:" . $symbolTable->get("cloud") . "</h2>";