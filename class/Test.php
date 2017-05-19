<?php
include 'rsa/vendor/autoload.php';


    $rijndael = new \phpseclib\Crypt\Rijndael();

    $rijndael->setKey('abcdefghijklmnop');

    $size = 10 * 1024;
    $plaintext = 'samuel';
    echo $rijndael->encrypt($plaintext)."<br>";
    echo $rijndael->decrypt($rijndael->encrypt($plaintext));
?>