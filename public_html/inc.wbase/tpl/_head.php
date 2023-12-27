<?php

$res_head="<tr><td>";
$res_head.="<div  style='position:fixed;left:0px;top:270px;right:".$tright."px;bottom:60px;overflow:auto;'>";
$res_head.="<table align=center border=1 id=\"rounded-corner\" width=100%>\n";
$res_head.="<thead>\n<tr>\n";
$res_head.='
<th scope="col" align="center" width="35"><a href="?sort='.$lsort.'crt'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['adb'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['adb'].$alTitleS[$lsort].'">'.$iTitle['adb'].$finTit['adb'].'</a></th>
<th scope="col" align="center" width="110"><a href="?sort='.$lsort.'cnm'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['type'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['type'].$alTitleS[$lsort].'">'.$iTitle['type'].$finTit['type'].'</a></th>
';
if ($SessLogged=="OK") {$res_head.='
	<th scope="col" align="center" width="110"><a href="?sort='.$lsort.'cnm'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['cont'].$alTitleS[$lsort].'" title="'.
	$alTitleS['n'].$alTitle['cont'].$alTitleS[$lsort].'">'.$iTitle['cont'].$finTit['cont'].'</a></th>
';
}
$res_head.='
<th scope="col" align="left" width="110"><a href="?sort='.$lsort.'cnm'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['city'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['city'].$alTitleS[$lsort].'">'.$iTitle['city'].$finTit['city'].'</a></th>
<th scope="col" align="center" width="15px">
<input type=checkbox checked onClick="toggle_check(\'all\',this)" />
</th>
<th scope="col" align="left"><a href="?sort='.$lsort.'chn'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['addr'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['addr'].$alTitleS[$lsort].'">'.$iTitle['addr'].$finTit['addr'].'</a></th>
<th scope="col" align="center" width="40"><a href="?sort='.$lsort.'col'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['side'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['side'].$alTitleS[$lsort].'">'.$iTitle['side'].$finTit['side'].'</a></th>
<th scope="col" align="center" width="30"><a href="?sort='.$lsort.'cnm'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['lght'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['lght'].$alTitleS[$lsort].'">'.$iTitle['lght'].$finTit['lght'].'</a></th>
';
if ($SessLogged=="OK") {$res_head.='
	<th scope="col" align="center"><a href="?sort='.$lsort.'cnm'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['price'].$alTitleS[$lsort].'" title="'.
	$alTitleS['n'].$alTitle['price'].$alTitleS[$lsort].'">'.$iTitle['price'].$finTit['price'].'</a></th>
	<th scope="col" align="center"><a href="?sort='.$lsort.'cnm'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['nprice'].$alTitleS[$lsort].'" title="'.
	$alTitleS['n'].$alTitle['nprice'].$alTitleS[$lsort].'">'.$iTitle['nprice'].$finTit['nprice'].'</a></th>
';
}
if (isset($sel_mnth) AND !isset($sel_mnth['all'])){
	reset ($sel_mnth);
	asort($sel_mnth);
	while (list($kmon,$vmon)=each($sel_mnth)) {
		if (strlen($NumMonth[$kmon])<2){
			$tmon="0".$NumMonth[$kmon];
		} else {$tmon=$NumMonth[$kmon];}
		$res_head.='
<th scope="col" align="center" width=18><a href="?sort='.$lsort.'plc'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle[$tmon].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle[$tmon].$alTitleS[$lsort].'">'.$iTitle[$tmon].$finTit[$tmon].'</a></th>
';
	}
}
elseif (isset($sel_mnth['all'])) {
	reset ($NumMonth);
	asort($NumMonth);
	while (list($kmon,$vmon)=each($NumMonth)) {
		if (trim($NumMonth[$kmon]) AND strlen($NumMonth[$kmon])<2){
			$tmon="0".$NumMonth[$kmon];
		} elseif (trim($NumMonth[$kmon])) {
			$tmon=$NumMonth[$kmon];
		} else {$tmon="";}
		if (trim($tmon)){
$res_head.='
<th scope="col" align="center" width="18"><a href="?sort='.$lsort.'plc'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle[$tmon].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle[$tmon].$alTitleS[$lsort].'">'.$iTitle[$tmon].$finTit[$tmon].'</a></th>
';
		}
	}
}
$res_head.='
<th scope="col" align="center" width="30"><a href="?sort='.$lsort.'col'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['map'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['map'].$alTitleS[$lsort].'">'.$iTitle['map'].$finTit['map'].'</a></th>
<th scope="col" align="center" width="30"><a href="?sort='.$lsort.'col'.$xSelect.$xcShow.$compq.'" alt="'.$alTitleS['n'].$alTitle['web'].$alTitleS[$lsort].'" title="'.
$alTitleS['n'].$alTitle['web'].$alTitleS[$lsort].'">'.$iTitle['web'].$finTit['web'].'</a></th>
';

$res_head.="</tr>\n</thead>\n";
$res_head.="<tbody>\n";
?>