<?php

function generateSID($length=10,$strong=false,$less_chars=false) {

	if ($less_chars){
		$chars = "abdefhiknrstyzABDEFGHKNQRSTYZ23456789";
	} elseif($strong AND !empty($strong)) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789,.@#%*";
	} else {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	}
	 
	$numChars = mb_strlen($chars);
 	$string = "";

	for ($i = 0; $i < $length; $i++) {
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	}

	if ($strong=="md5"){$string=md5($string);}

	return $string;

}

function genTCODE($length=20,$strong=''){

	generateSID($length,$strong);

}

function generatePassword($length = 8){

	return generateSID($length,'',true);

}

function generateColor($length = 6,$color_chars="AB6789"){
 
	$numChars = mb_strlen($color_chars);
 	$string = "";

	 for ($i = 0; $i < $length; $i++) {
   		$string .= substr($color_chars, rand(1, $numChars) - 1, 1);
 	}

	 return $string;
}
  
function genUniColor($arr_size=2,$length=6,$color_chars="AB6789"){
	
	$gen_color=generateColor($length,$color_chars);
	$used_color[$gen_color]=$gen_color;

	for ($i = 0; $i < $arr_size-1; $i++) {
        while(in_array($gen_color=generateColor($length,$color_chars),$used_color)){;}
        $used_color[$gen_color]=$gen_color;
	}

	return $used_color;
}

?>
