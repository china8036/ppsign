<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'src/PubPriSign.php';
use Qqes\PPSign\PubPriSign;

list($pub_key, $pri_key) = PubPriSign::getNewPubAndPriKey();

$msg = "Hello im a msg";

$signature = PubPriSign::signByPriKey($pri_key, $msg);



var_dump(PubPriSign::checkSignWitPubKey($pub_key, $msg, $signature));
