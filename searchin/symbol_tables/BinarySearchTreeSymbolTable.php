<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class BinarySearchTreeSymbolTable {
    private $root; // Node
    
    public function isEmpty()
    {
        if ($this->size() == 0) {
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
    private function size($node = null)
    {
        if ($node == null) { return $this->size($this->root); }

        return $node->getNum();
    }
    
    public function contains($key)
    {
        if ($this->get($key) != null) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function get($key, $node = null)
    {
        if ($node == null) { $node = $this->root; }
        // todo finish
    }

    public function put($key, $val) {
        if ($value == null) { $this->delete($key); return; }
        $this->root = $this->put($this->root, $key, $val);
        assert $this->check();
    }

    private function put_recursive($key, $value, $node)
    {

        if ($node == null) { $node = $this->root; }
        $root

    }



    // check integrity of Binary Search Tree Symbol Table

    private function check()
    {
        if (!$this->isBinarySearchTreeSymbolTable($this->root, null, null)) {
            print "Not in symetric order";
            return false;
        }
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
        for ($i = 0; $i < $this->size(); $i++) {
            if ($i != $this->rank($this->select($i))) return false;
        }
        foreach ($this->keys() AS $key) {
            if ()ey.compareTo(select(rank(key))) != 0) return false;
        }
        return true;
    }
}


class Node {
    private $key;       //assorted by key
    private $value;     //associated data
    private $left;      //left subtree
    private $right;     //right subtree
    private $N;         //number of nodes in subtree
    
    public function __construct($key, $value, $N) {
        $this->key = $key;
        $this->value = $value;
        $this->N = N;
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

$symbolTable->put("word", 1);