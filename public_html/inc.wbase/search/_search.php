<?php

if (isset($_POST['reset'])){
	unset($_SESSION['adb_search']); 
	unset($_SESSION['onsale']);
	unset($_SESSION['side_a']);
	unset($_SESSION['side_b']);
	unset($_SESSION['side_in']);
	unset($_SESSION['side_out']);
	unset($_SESSION['ctype']);
	unset($_SESSION['type']);
	unset($_SESSION['area']);
	unset($_POST);
}

if (isset($_POST['ss'])){

	if (!empty($_POST['ss'])){

		$ssup=mb_strtoupper($_POST['ss']);
		$s_string=trim(htmlspecialchars(strip_tags($_POST['ss'])));

		if (!empty($s_string)){$_SESSION['adb_search']=$s_string;}

	} else {unset($_SESSION['adb_search']);}

} elseif (isset($_SESSION['adb_search']) AND !empty($_SESSION['adb_search'])){

	$s_string=$_SESSION['adb_search'];

}

if (isset($s_string)){

	if (empty($qcitywhere)){$qcitywhere=" AND ";}
	else {$qcitywhere.=" AND ";}

	if (isset($PageTitle) AND !empty($PageTitle)){$PageTitle.=" Поиск: ".$s_string;}
	else {$PageTitle=" Поиск: ".$s_string;}
	
    $s_arr=explode(" ",$s_string);

	while (list($sk,$sv)=each($s_arr)){
	
        if(!empty($sv)){
			$lower_sv=mb_strtoupper($sv);
			$qcity_search[]="UPPER(surfuls.ADDRESS) LIKE '%".$lower_sv."%'";
		}
	}
	
    if (sizeof($qcity_search)>1){
	
        $qcitysearch=implode(" OR ",$qcity_search);
	
    } else {
		$qcitysearch=implode("",$qcity_search);
	
    }
	
    $qcitywhere.="(".$qcitysearch.")";

}

// Только в продаже

if (isset($_POST['onsale']) AND $_POST['onsale']=="onsale"){

    if (isset($qcitywhere)){$qcitywhere.=" AND (surfen.seid IS NOT NULL)";}
	else {$qcitywhere=" AND (surfen.seid IS NOT NULL)";}

    $_SESSION['onsale']=" selected";

} elseif(isset($_POST['onsale']) AND $_POST['onsale']=="all"){

    unset($_SESSION['onsale']);

} elseif(isset($_SESSION['onsale']) AND $_SESSION['onsale']==" selected") {

    if (isset($qcitywhere)){$qcitywhere.=" AND (surfen.seid IS NOT NULL)";}
	else {$qcitywhere=" AND (surfen.seid IS NOT NULL)";}

}

// стороны

if (isset($_POST['side'])) {

    if ($_POST['side']=="A"){

        if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%A%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%А%')";}
		else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%A%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%А%')";}
		$_SESSION['side_a']=" selected";
		unset($_SESSION['side_b']);
		unset($_SESSION['side_in']);
		unset($_SESSION['side_out']);

    } elseif ($_POST['side']=="B"){

        if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%B%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%Б%')";}
		else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%B%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%Б%')";}
		$_SESSION['side_b']=" selected";
		unset($_SESSION['side_a']);
		unset($_SESSION['side_in']);
		unset($_SESSION['side_out']);

    } elseif ($_POST['side']=="IN"){

        if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%')";}
		else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%')";}
		$_SESSION['side_in']=" selected";
		unset($_SESSION['side_a']);
		unset($_SESSION['side_b']);
		unset($_SESSION['side_out']);

    } elseif ($_POST['side']=="OUT"){

        if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%')";}
		else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%')";}
		$_SESSION['side_out']=" selected";
		unset($_SESSION['side_a']);
		unset($_SESSION['side_b']);
		unset($_SESSION['side_in']);

    } elseif($_POST['side']=="all"){
		unset($_SESSION['side_a']);
		unset($_SESSION['side_b']);
		unset($_SESSION['side_in']);
		unset($_SESSION['side_out']);
	}

} elseif(isset($_SESSION['side_a']) AND $_SESSION['side_a']==" selected"){

    if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%A%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%А%')";}
	else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%A%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%А%')";}

} elseif(isset($_SESSION['side_b']) AND $_SESSION['side_b']==" selected"){

    if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%B%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%Б%')";}
	else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%B%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%Б%')";}

} elseif(isset($_SESSION['side_in']) AND $_SESSION['side_in']==" selected"){

    if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%')";}
	else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНУТР%')";}

} elseif(isset($_SESSION['side_out']) AND $_SESSION['side_out']==" selected"){

    if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%')";}
	else {$qcitywhere=" AND (UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%' OR UPPER(SIDE.SIDE_LETTER) LIKE '%ВНЕШ%')";}

}

// конструкции

if (isset($_POST['ctype'])) {

	if($_POST['ctype']=='all'){

		unset($_SESSION['ctype']);
		unset($_SESSION['type']);

	} elseif(!empty($_POST['ctype'])){

		if (getpost_intval('ctype')>0) {

			$_SESSION['ctypeid']=getpost_intval('ctype');

			$get_typebyid="SELECT * FROM CTYPES WHERE ID='".getpost_intval('ctype')."'";
			$types=mysqli_query($odb,$get_typebyid);

			while ($row=mysqli_fetch_array($types)){
				$type_name_orig=$row['NAME'];
				$type_name=mb_strtoupper($row['NAME']);
			}

			if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(surfuls.BILL_TYPE) LIKE '%".$type_name."%')";}
			else {$qcitywhere=" AND (UPPER(surfuls.BILL_TYPE) LIKE '%".$type_name."%')";}

			$_SESSION['ctype']=$type_name_orig;

		} elseif(getpost_string('ctype')=='digital'){

			$select_address=mb_strtoupper('(цифра-медиа)');

			if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(surfuls.ADDRESS) LIKE '%".$select_address."%')";}
			else {$qcitywhere=" AND (UPPER(surfuls.ADDRESS) LIKE '%".$select_address."%')";}

			$_SESSION['ctype']='digital';

		}

	}

} elseif(isset($_SESSION['ctype'])){

	$type_name=mb_strtoupper($_SESSION['ctype']);

	if ($type_name=='DIGITAL'){

		$select_address=mb_strtoupper('(цифра-медиа)');

		if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(surfuls.ADDRESS) LIKE '%".$select_address."%')";}
		else {$qcitywhere=" AND (UPPER(surfuls.ADDRESS) LIKE '%".$select_address."%')";}

	} else {

        if (isset($qcitywhere)){$qcitywhere.=" AND (UPPER(surfuls.BILL_TYPE) LIKE '%".$type_name."%')";}
		else {$qcitywhere=" AND (UPPER(surfuls.BILL_TYPE) LIKE '%".$type_name."%')";}

    }

}

// Город, район поиска

if (isset($_POST['area'])) {

	if($_POST['area']=='all'){

		unset($_SESSION['area']);

	} elseif(!empty($_POST['area'])){

		$_SESSION['area']=getpost_string('area');

		$area_full=explode("#",$_SESSION['area']);

		$area_arr=explode(" ",$area_full[0]);

		$area_name=mb_strtoupper($area_arr[0]);
		
		if (isset($area_arr[1])) {

			$add_area=mb_strtoupper($area_arr[1]);
			$add=" OR (UPPER(surfuls.AREA) LIKE '%".$add_area."%' OR UPPER(surfuls.ADDRESS) LIKE '%".$add_area."%' OR UPPER(CONS.CITY) LIKE '%".$add_area."%')";
		
        } else {$add="";$add_area="";}

		if (isset($qcitywhere)){
            $qcitywhere.=" AND ((UPPER(surfuls.AREA) LIKE '%".$area_name."%' OR UPPER(surfuls.ADDRESS) LIKE '%".$area_name."%' OR UPPER(CONS.CITY) LIKE '%".$area_name."%')".$add.")";
        } else {
            $qcitywhere=" AND ((UPPER(surfuls.AREA) LIKE '%".$area_name."%' OR UPPER(surfuls.ADDRESS) LIKE '%".$area_name."%' OR UPPER(CONS.CITY) LIKE '%".$area_name."%')".$add.")";
        }


	}

} elseif(isset($_SESSION['area'])){

	$area_full=explode("#",$_SESSION['area']);

    $area_arr=explode(" ",$area_full[0]);

    $area_name=mb_strtoupper($area_arr[0]);
    
    if (isset($area_arr[1])) {

        $add_area=mb_strtoupper($area_arr[1]);
        $add=" OR (UPPER(surfuls.AREA) LIKE '%".$add_area."%' OR UPPER(surfuls.ADDRESS) LIKE '%".$add_area."%' OR UPPER(CONS.CITY) LIKE '%".$add_area."%')";
    
    } else {$add="";$add_area="";}

	if (isset($qcitywhere)){
        $qcitywhere.=" AND (UPPER(surfuls.AREA) LIKE '%".$area_name."%' OR UPPER(surfuls.ADDRESS) LIKE '%".$area_name."%' OR UPPER(CONS.CITY) LIKE '%".$area_name."%')";
    } else {
        $qcitywhere=" AND (UPPER(surfuls.AREA) LIKE '%".$area_name."%' OR UPPER(surfuls.ADDRESS) LIKE '%".$area_name."%' OR UPPER(CONS.CITY) LIKE '%".$area_name."%')";
    }

}

/*
echo "\n<!-- SEARCH \n";
echo $qcitywhere;
echo "\n===\n";
echo $ad_qcitywhere;
echo "\n -->\n";
*/

?>