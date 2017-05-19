<?php
include 'rsa/vendor/autoload.php';

class Rijndael{
	private $rijndael;

	public function __construct(){
		$this->rijndael = new \phpseclib\Crypt\Rijndael();
	 }



	 public function encrypt($plaintext, $key)
	 {
	 	$this->rijndael->setKey($key);
	 	$ciphertext = base64_encode($this->rijndael->encrypt($plaintext));
	 	return $ciphertext;
	 }

	 public function decrypt($chipertext, $key)
	 {

	 	$this->rijndael->setKey($key);
	 	$plaintext = $this->rijndael->decrypt(base64_decode($chipertext));
	 	return $plaintext;
	 }
}


$Encrypt_rijndael = new Rijndael();
?>