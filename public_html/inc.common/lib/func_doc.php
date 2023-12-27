<?php

function genTCODE($length,$strong=""){
	if (!empty($strong)){
		$chars = "abdefhiknrstyzABDEFGHKNQRSTYZ234567891234567890,.@#%*";
	}else{
		$chars = "abdefhiknrstyzABDEFGHKNQRSTYZ23456789";
	}
	$numChars = strlen($chars);
	$string = "";
	for ($i = 0; $i < $length; $i++) {
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	}
	return $string;
}

function generatePassword($length = 8){
 $chars = "abdefhiknrstyzABDEFGHKNQRSTYZ23456789";
 $numChars = strlen($chars);
 $string = "";
 for ($i = 0; $i < $length; $i++) {
   $string .= substr($chars, rand(1, $numChars) - 1, 1);
 }
 return $string;
}

function generateSID($length=10){
 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 $numChars = strlen($chars);
 $string = "";
 for ($i = 0; $i < $length; $i++) {
   $string .= substr($chars, rand(1, $numChars) - 1, 1);
 }
 return $string;
}

function generateColor($length = 6,$color_chars="AB6789"){
 
	$numChars = strlen($color_chars);
 	$string = "";

	 for ($i = 0; $i < $length; $i++) {
   		$string .= substr($color_chars, rand(1, $numChars) - 1, 1);
 	}

	 return $string;
}
  
function genUniColor($arr_size=1,$length=6,$color_chars="AB6789"){
	
	$gen_color=generateColor($length,$color_chars);
	$used_color[$gen_color]=$gen_color;

	for ($i = 0; $i < $arr_size-1; $i++) {
        while(in_array($gen_color=generateColor(),$used_color)){;}
        $used_color[$gen_color]=$gen_color;
	}

	return $used_color;
}

function NormStr($input,$case=""){
	$next=str_replace(","," ",trim($input));
	$next=str_replace("/"," ",trim($next));
	$next=str_replace("\\"," ",trim($next));
	$next=str_replace("|"," ",trim($next));
	$next=str_replace("."," ",trim($next));
	$next=str_replace(";"," ",trim($next));
	$next=str_replace(":"," ",trim($next));
	$next=str_replace("{"," ",trim($next));
	$next=str_replace("}"," ",trim($next));
	$next=str_replace("["," ",trim($next));
	$next=str_replace("]"," ",trim($next));
	$next=str_replace("("," ",trim($next));
	$next=str_replace(")"," ",trim($next));
	$next=str_replace("\"","",trim($next));
	$next=str_replace("\`","",trim($next));
	$next=str_replace("!"," ",trim($next));
	$next=str_replace("«","",trim($next));
	$next=str_replace("»","",trim($next));
	$next=str_replace("\$"," ",trim($next));
	$next=str_replace("%"," ",trim($next));
	$next=str_replace("\^"," ",trim($next));
	$next=str_replace("*"," ",trim($next));
	$next=str_replace("~","",trim($next));
	$next=str_replace("\?"," ",trim($next));
	$next=str_replace("\""," ",trim($next));
	$next=str_replace("\&"," ",trim($next));
	$next=str_replace("#"," ",trim($next));
	$next=htmlspecialchars(strip_tags($next));
	$next=str_replace("_","",trim($next));
	$next=str_replace("-"," ",trim($next));
	$next=str_replace("   "," ",trim($next));
	$next=str_replace("  "," ",trim($next));
	$next=str_replace(" ","",trim($next));
	if(!empty($case)){$result=mb_strtoupper($next);}
	else {$result=mb_strtolower($next);}
	return $result;
}

function NormSpace($input,$case=""){
	$next=str_replace(","," ",trim($input));
	$next=str_replace("/"," ",trim($next));
	$next=str_replace("\\"," ",trim($next));
	$next=str_replace("|"," ",trim($next));
	$next=str_replace("."," ",trim($next));
	$next=str_replace(";"," ",trim($next));
	$next=str_replace(":"," ",trim($next));
	$next=str_replace("{"," ",trim($next));
	$next=str_replace("}"," ",trim($next));
	$next=str_replace("["," ",trim($next));
	$next=str_replace("]"," ",trim($next));
	$next=str_replace("("," ",trim($next));
	$next=str_replace(")"," ",trim($next));
	$next=str_replace("\`","",trim($next));
	$next=str_replace("!"," ",trim($next));
	$next=str_replace("\$"," ",trim($next));
	$next=str_replace("%"," ",trim($next));
	$next=str_replace("\^"," ",trim($next));
	$next=str_replace("*"," ",trim($next));
	$next=str_replace("~","",trim($next));
	$next=str_replace("\?"," ",trim($next));
	$next=str_replace("\""," ",trim($next));
	$next=str_replace("\&"," ",trim($next));
	$next=str_replace("#"," ",trim($next));
	$next=htmlspecialchars(strip_tags($next));
	$next=str_replace("_"," ",trim($next));
	$next=str_replace("-"," ",trim($next));
	$next=str_replace("   "," ",trim($next));
	$next=str_replace("  "," ",trim($next));
	if(!empty($case)){$result=mb_strtoupper($next);}
	else {$result=mb_strtolower($next);}
	return $result;
}

function NormStrComma($input,$case=""){
	$next=str_replace(" ,",",",trim($input));
	$next=str_replace(", ",",",trim($next));
	$next=str_replace("/"," ",trim($next));
	$next=str_replace("\\"," ",trim($next));
	$next=str_replace("|"," ",trim($next));
	$next=str_replace("."," ",trim($next));
	$next=str_replace(";"," ",trim($next));
	$next=str_replace(":"," ",trim($next));
	$next=str_replace("{"," ",trim($next));
	$next=str_replace("}"," ",trim($next));
	$next=str_replace("["," ",trim($next));
	$next=str_replace("]"," ",trim($next));
	$next=str_replace("("," ",trim($next));
	$next=str_replace(")"," ",trim($next));
	$next=str_replace("\`","",trim($next));
	$next=str_replace("!"," ",trim($next));
	$next=str_replace("\$"," ",trim($next));
	$next=str_replace("%"," ",trim($next));
	$next=str_replace("\^"," ",trim($next));
	$next=str_replace("*"," ",trim($next));
	$next=str_replace("~","",trim($next));
	$next=str_replace("\?"," ",trim($next));
	$next=str_replace("\""," ",trim($next));
	$next=str_replace("\&"," ",trim($next));
	$next=str_replace("#"," ",trim($next));
	$next=str_replace(",",", ",trim($next));
	$next=htmlspecialchars(strip_tags($next));
	$next=str_replace("   "," ",trim($next));
	$next=str_replace("  "," ",trim($next));
	$next=str_replace("_","",trim($next));
	$next=str_replace("-","",trim($next));
	$next=str_replace(" ","",trim($next));
	if(!empty($case)){$result=mb_strtoupper($next);}
	else {$result=mb_strtolower($next);}
	return $result;
}

function NormUnderline($input,$case=""){
	$next=str_replace(","," ",trim($input));
	$next=str_replace("/"," ",trim($next));
	$next=str_replace("\\"," ",trim($next));
	$next=str_replace("|"," ",trim($next));
	$next=str_replace("."," ",trim($next));
	$next=str_replace(";"," ",trim($next));
	$next=str_replace(":"," ",trim($next));
	$next=str_replace("{"," ",trim($next));
	$next=str_replace("}"," ",trim($next));
	$next=str_replace("["," ",trim($next));
	$next=str_replace("]"," ",trim($next));
	$next=str_replace("("," ",trim($next));
	$next=str_replace(")"," ",trim($next));
	$next=str_replace("\`","",trim($next));
	$next=str_replace("!"," ",trim($next));
	$next=str_replace("\$"," ",trim($next));
	$next=str_replace("%"," ",trim($next));
	$next=str_replace("\^"," ",trim($next));
	$next=str_replace("*"," ",trim($next));
	$next=str_replace("~","",trim($next));
	$next=str_replace("\?"," ",trim($next));
	$next=str_replace("\""," ",trim($next));
	$next=str_replace("\&"," ",trim($next));
	$next=str_replace("#"," ",trim($next));
	$next=htmlspecialchars(strip_tags($next));
	$next=str_replace("   "," ",trim($next));
	$next=str_replace("  "," ",trim($next));
	$next=str_replace("-","_",trim($next));
	$next=str_replace(" ","_",trim($next));
	if(!empty($case)){$result=mb_strtoupper($next);}
	else {$result=mb_strtolower($next);}
	return $result;
}

// проверка правильности номера телефона
function CheckMobile($mobile=''){
    if (!empty($mobile) AND strlen($mobile)>6){
	   $mobile=str_replace(" ","",trim($mobile));
	   $mobile=str_replace("-","",trim($mobile));
	   $mobile=str_replace("(","",trim($mobile));
	   $mobile=str_replace(")","",trim($mobile));
	   $mobile=str_replace("+","",trim($mobile));
    
        if (strlen($mobile)>11){
            $mobile=intval($mobile);
        } elseif(strlen($mobile)<8){
            $mobile_number="8423".$mobile;
        } else {
            $mobile_number=$mobile;
        }
        return $mobile_number;
        
    } else {
        return false;
    }
}

// формируем ссылку; в случае неудачи - возврат исходной строки

function MakeURL($url){
	$link=$url;
	$tmp=explode(" ",$url);
	while(list($k,$v)=each($tmp)){
		$texp=explode("/",$v);
		if ($texp[0]=="http:" OR $texp[0]=="https:"){
			while(list($a,$b)=each($texp)){
				if(!empty(trim($b))){$alnk=$b;}
			}
			if (!empty($alnk)){
				$new="<a href='".$v."' target='".$alnk."'>@".$alnk."</a>";
				$link=str_replace($v,$new,$link);
			}
		}
		if (isset($b)){unset($b);}
	}
	return $link;
}

//возврат текущей даты. С параметром - в российском стандарте 
function dateNOW($rus=""){
	$get_time=time();
    if (empty($rus)){$date_stamp="Y-m-d";}
    else {$date_stamp="d.m.Y";}
	$thisdate=date($date_stamp,$get_time);
	return $thisdate;
}

// расширенный ваиант dateNOW - любая дата, включая время, российский формат
function dateSHOW($get_time="",$full_time="",$rus=""){
    if (empty($get_time)){$get_time=time();}
    if (empty($rus)){$date_stamp="Y-m-d";}
    else {$date_stamp="d.m.Y";}
	if (empty($full_time)){$stamp=$date_stamp;}
	else {$stamp=$date_stamp." H:i:s";}
	$thisdate=date($stamp,$get_time);
	return $thisdate;
}

//формирование заголовков сообщения

function mail_headers($name="",$email=""){
	
	if (empty($name) AND isset($_SESSION['uname'])){$name=$_SESSION['uname'];}
	elseif(empty($name)) {unset($name);}

	if (empty($email) AND isset($_SESSION['email'])){$email=$_SESSION['email'];}
	elseif(empty($email)){unset($email);}

	if (isset($name) AND isset($email)){
		$mailfrom="Content-Type: text/plain; charset=UTF-8; format=flowed\n";
		$mailfrom.="FROM: =?UTF-8?B?".base64_encode($name)."?= <".$email.">\n";
		$mailfrom.="Reply-TO: ".$email."\n";
		$headers=$mailfrom;
		return $headers;
	} else {
		return false;
	}
}

function is_intval($value='',$not_zero=''){
	if (isset($value) AND intval($value)>0){
		$result=intval($value);
	} elseif(isset($value) AND empty($not_zero)) {
		$result=0;
	}
	if(isset($result)){return $result;} else {return null;}
}

function is_str($value='',$not_empty=''){
	if (isset($value) AND !empty(trim(htmlspecialchars(strip_tags($value))))){
		$result=trim(htmlspecialchars(strip_tags($value)));
	} elseif(isset($value) AND empty($not_empty)) {
		$result="";
	}
	if(isset($result)){return $result;} else {return null;}
}

function get_intval($value='',$not_zero=''){

	if (isset($_GET[$value]) AND intval($_GET[$value])>0){
		$result=intval($_GET[$value]);
	} elseif(isset($_GET[$value]) AND empty($not_zero)) {
		$result=0;
	}

	if(isset($result)){return $result;} else {return null;}
}

function get_float($value='',$not_zero=''){
	if (isset($_GET[$value]) AND floatval($_GET[$value])>0){
		$result=floatval($_GET[$value]);
	} elseif(isset($_GET[$value]) AND empty($not_zero)) {
		$result=0;
	}
	if(isset($result)){return $result;} else {return null;}
}

function get_string($value='',$not_empty=''){
	if (isset($_GET[$value]) AND !empty(trim(htmlspecialchars(strip_tags($_GET[$value]))))){
		$result=trim(htmlspecialchars(strip_tags($_GET[$value])));
	} elseif(isset($_GET[$value]) AND empty($not_empty)) {
		$result="";
	}
	if(isset($result)){return $result;} else {return null;}
}

function getpost_intval($value='',$not_zero=''){
	if (isset($_POST[$value]) AND strlen($_POST[$value])<13 AND intval($_POST[$value])>0){
		$result=intval($_POST[$value]);
	} elseif(isset($_POST[$value]) AND empty($not_zero)) {
		$result=0;
	}
	if(isset($result)){return $result;} else {return null;}
}

function getpost_float($value='',$not_zero=''){
	if (isset($_POST[$value]) AND floatval($_POST[$value])>0){
		$result=floatval($_POST[$value]);
	} elseif(isset($_POST[$value]) AND empty($not_zero)) {
		$result=0.0;
	}
	if(isset($result)){return $result;} else {return null;}
}

function getpost_string($value='',$not_empty=''){
	if (isset($_POST[$value]) AND !empty(trim(htmlspecialchars(strip_tags($_POST[$value]))))){
		$result=trim(htmlspecialchars(strip_tags($_POST[$value])));
	} elseif(isset($_POST[$value]) AND empty($not_empty)) {
		$result="";
	}
	if(isset($result)){return $result;} else {return null;}
}

function ChkStr($value=''){
	if (!empty(trim(htmlspecialchars(strip_tags($value))))){return true;}
	else {return false;}
}

function ChkInt($value='0'){
	if (intval($value)>0){return $value;}
	else {return false;}
}

function ChkArr($value){
	if (isset($value) AND is_array($value) AND sizeof($value)>0){return sizeof($value);}
	else {return false;}
}

function Translit($value,$direct=''){
	$SideNameRu=array("А","Б","В","Г","Д","Е","Ж","З","И","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х");
	$SideNameEn=array("A","B","C","G","D","E","J","З","I","K","L","M","N","O","P","R","S","T","U","F","H");
	if (empty($direct)){
		$result=str_replace($SideNameRu,$SideNameEn,mb_strtoupper($value));
	}else{
		$result=str_replace($SideNameEn,$SideNameRu,mb_strtoupper($value));	
	}
	return $result;
}

function showIcon($arr_long,$arr_img,$val,$size=20,$title=""){
	$code='<img src="/comm/img/'.$arr_img[$val].'.png" height='.$size.'px border=0 title="'.$title.$arr_long[$val].'" alt="'.$title.$arr_long[$val].'">';
	return $code;
}


function AddLog($file,$txt) {
    $LogFile=fopen($file,"a+");
    fputs($LogFile,$txt);
    fclose($LogFile);
}

function addZero($input,$f_len=4){
	$t_len=mb_strlen(trim($input));
	if ($t_len<$f_len){
		$r_len=$f_len-$t_len;
		$out=str_repeat("0",$r_len).trim($input);
		unset($r_len);
		unset($r_len);
		unset($r_len);
	} else {
		$out=trim($input);
	}
	return $out;
}

function doTAG($val="",$back=""){
	if (!empty($val)){
		if (empty($back)){
			$new_tag="<".trim($val).">";
		} else {
			$new_tag="</".trim($val).">";
		}
	} else {$new_tag="";}
	
	return $new_tag;
}

function LoggedUser(){
	if(isset($_SESSION['userid']) AND intval($_SESSION['userid'])>0){
		$logged_user=intval($_SESSION['userid']);
		return $logged_user;
	} else {
		return false;
	}
}

function lastInArray($source_array){
	if (is_array($source_array)){
		$last_item=$source_array[sizeof($source_array)-1];
		return $last_item;
	} else {return FALSE;}
}

?>
