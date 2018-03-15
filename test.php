<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'src/PubPriSign.php';
use Qqes\PPSign\PubPriSign;

list($x509_pub_key, $pub_key,  $pri_key) = PubPriSign::getNewPubAndPriKey(true);

$msg = "Hello im a msg";

$signature = PubPriSign::signByPriKey($pri_key, $msg);

var_dump(PubPriSign::checkSignWitPubKey($pub_key, $msg, $signature));
