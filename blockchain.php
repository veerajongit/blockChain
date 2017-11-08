<?php
/**
 * Created by PhpStorm.
 * User: veerajshenoy
 * Date: 08/11/17
 * Time: 9:57 AM
 */


//Setting individual Block
class block {
    public function __construct($index, $timestamp, $data, $previousHash = '') {
        //Initialize everything
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->Hash = $this->calculateHash();
    }

    function calculateHash() {
        return hash('sha256', ($this->index . $this->previousHash . $this->timestamp . json_encode($this->data)));
    }
}


//Creating block chain
class blockChain {
    public function __construct() {
        //Block chain always starts with a dummy data. Here we initialize our first block
        $this->chain = array($this->createGenesisBlock());
    }


    function createGenesisBlock() {
        return new block(0, '08/11/2017', "Genisis Block", 0);
    }


    function getLatestBlock(){
        return $this->chain[count($this->chain) - 1];
    }


    function addBlock($newBlock){
        $newBlock->previousHash = $this->getLatestBlock()->Hash;
        $newBlock->Hash = $newBlock->calculateHash();
        array_push($this->chain, $newBlock);
    }
}

