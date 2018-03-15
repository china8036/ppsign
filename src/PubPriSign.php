<?php

namespace Qqes\PPSign;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rsa
 *
 * @author wang
 */
class PubPriSign {
    //put your code here

    /**
     * 
     * @param boolean $pub_x509
     * @param int $pub_exp_days
     * @return array(x509_pub, pub , pri)
     */
    public static function getNewPubAndPriKey($x509_exp_days = 36500) {
        //create new private and public key
        $private_key_res = openssl_pkey_new(array(
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ));
        openssl_pkey_export($private_key_res, $pri_key);
        $csr = openssl_csr_new(array(), $private_key_res);
        $sscert = openssl_csr_sign($csr, null, $private_key_res, $x509_exp_days);
        openssl_x509_export($sscert, $x509_pub_key);
        $pub_detail = openssl_pkey_get_details($private_key_res);
        $pub_key = $pub_detail['key'];
        return [$x509_pub_key, $pub_key, $pri_key];
    }

    /**
     * 私钥签名
     * @param type string
     * @param type $data
     */
    public static function signByPriKey($privKey, $data) {
        $pri_key_res = openssl_pkey_get_private($privKey);
        //create signature
        openssl_sign($data, $signature, $pri_key_res, "sha1WithRSAEncryption");
        return base64_encode($signature);
    }

    /**
     * 使用公钥验证签名
     * @param type $publicKey
     * @param type $data
     * @param type $signature
     * @return type
     */
    public static function checkSignWitPubKey($publicKey, $data, $signature) {
        $public_key_res = openssl_pkey_get_public($publicKey);
        return (boolean) openssl_verify($data, base64_decode($signature), $public_key_res, OPENSSL_ALGO_SHA1);
    }

}
