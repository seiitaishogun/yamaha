<?php
class TripleDES {
	function encrypt3DES($text, $key) {
		$text =$this->pkcs5_pad($text, 8);  // AES?16????????
		$size = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($size, MCRYPT_RAND);
		$bin = pack('H*', bin2hex($text));
		$encrypted = mcrypt_encrypt(MCRYPT_3DES, $key, $bin, MCRYPT_MODE_ECB, $iv);
		$encrypted = bin2hex($encrypted);
		return $encrypted;
	}

	function pkcs5_pad($text, $blocksize) {
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	function decrypt3DES($text, $key) {
        $str = $this->hex2bin($text);
        $size = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($size, MCRYPT_RAND);
        $decrypted = mcrypt_decrypt(MCRYPT_3DES, $key, $str, MCRYPT_MODE_ECB, $iv);
        $info = rtrim($this->pkcs5_unpad($decrypted));
        return $info;
    }

	function hex2bin($str) {
        $bin = "";
        $i = 0;
        do {
            $bin .= chr ( hexdec ( $str {$i} . $str {($i + 1)} ) );
            $i += 2;
        } while ( $i < strlen ( $str ) );
        return $bin;
    }
	
	 function pkcs5_unpad($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
        return substr($text, 0, -1 * $pad);
    }
}