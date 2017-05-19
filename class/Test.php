<?php
include 'rsa/vendor/autoload.php';


    $rijndael = new \phpseclib\Crypt\Rijndael();

    $rijndael->setKey('abcdefghijkaslmnop');

    $size = 10 * 1024;
    $plaintext = 'samuel';
    echo base64_encode($rijndael->encrypt($plaintext))."<br>";
    echo $rijndael->decrypt($rijndael->encrypt($plaintext));
?>