<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class BinarySearchTreeSymbolTable {
    private $root;
    
    public function isEmpty()
    {
        if ($this->size() == 0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    private function size($x)
    {
        
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
    
    public function get($nodeX, $key)
    {
        if ($nodeX == null) return null;
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
    
    
    
}