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
        $this->nonce = 0;
    }

    function calculateHash() {
        return hash('sha256', ($this->index . $this->previousHash . $this->timestamp . json_encode($this->data) . $this->nonce));
    }

    function mineBlock($difficulty) {
        while (substr($this->Hash, 0, $difficulty) !== str_repeat("0", $difficulty)) {
            $this->nonce++;
            $this->Hash = $this->calculateHash();
        }
    }
}


//Creating block chain
class blockChain {
    public function __construct() {
        //Block chain always starts with a dummy data. Here we initialize our first block
        $this->chain = array($this->createGenesisBlock());

        //Set the difficulty level here
        $this->difficulty = 5;
    }


    function createGenesisBlock() {
        return new block(0, '08/11/2017', "Genisis Block", 0);
    }


    function getLatestBlock() {
        return $this->chain[count($this->chain) - 1];
    }


    function addBlock($newBlock) {
        $newBlock->previousHash = $this->getLatestBlock()->Hash;
        $newBlock->mineBlock($this->difficulty);
        array_push($this->chain, $newBlock);
    }

    function isChainValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];


            if ($currentBlock->Hash != $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash != $previousBlock->Hash) {
                return false;
            }

        }
        return true;
    }
}

