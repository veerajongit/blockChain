<?php
/**
 * Created by PhpStorm.
 * User: veerajshenoy
 * Date: 08/11/17
 * Time: 9:58 AM
 */


include_once "blockchain.php";

$saveCoin = new blockChain();

$arr = array();
$arr["amount"] = 5;
$saveCoin->addBlock(new block(1, "08/11/2017", $arr));

$arr = array();
$arr["amount"] = 10;
$saveCoin->addBlock(new block(2, "08/11/2017", $arr));

echo json_encode($saveCoin);


echo "<hr><hr><hr><hr>";
//Checking validation of block chain
echo "Is block chain valid? " . ($saveCoin->isChainValid() ? "Yes" : "No");


echo "<hr><hr><hr><hr>";
//Temparing with the block chain
$arr = array();
$arr["amount"] = 25;
$saveCoin->chain[1]->data = $arr;
$saveCoin->chain[1]->Hash = $saveCoin->chain[1]->calculateHash();


//Checking validation of block chain
echo "Is block chain valid? " . ($saveCoin->isChainValid() ? "Yes" : "No");