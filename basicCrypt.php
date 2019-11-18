<?php

/*

Basic and safe encryption algorithm coded by Emrecan Öksüm in 19.11.2019
It's safe. Because no one will know the pad unless you give it to them.

You can download this file to your webspace and include it from other scripts
where you want encryption/decryption via BasicEncryption.

*/

function encrypt($str, $pad) {
	
	$enc = '';
	$i = 0;
	$j = 0;
	$padsum = 0;
	$padcount = count($pad);
	
	while($j < $padcount) {
	    
	    $padsum += $pad[$j];
	    $j++;
	}
	
	$padsum = $padsum / $padcount;
	
	$strsplt = str_split($str);
	$i = 0;
	foreach($strsplt as $char) {
    
		if($i >= count($pad)) {
			
			$i = 0;
		}
		
		$enc .= chr((ord($char) + $pad[$i]) + sqrt($padsum));
		$i++;
	}
	
	$enc = base64_encode($enc);
	
	return $enc;
}

function decrypt($str, $pad) {
	
	$dec = '';
	$i = 0;
	$j = 0;
	$padsum = 0;
	$padcount = count($pad);
	
	while($j < $padcount) {
	    
	    $padsum += $pad[$j];
	    $j++;
	}
	
	$padsum = $padsum / $padcount;
	
	$str = base64_decode($str);
	
	$strsplt = str_split($str);
	$i = 0;
	foreach($strsplt as $char) {
    
		if($i >= count($pad)) {
			
			$i = 0;
		}
		
		$dec .= chr((ord($char) - $pad[$i]) - sqrt($padsum));
		$i++;
	}
	
	return $dec;
}
