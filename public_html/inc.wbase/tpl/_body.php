<?php
# номер поверхности
	$res.="<tr><td class=rlong><a href=?cedit=";
	$ConsLink=$adbase_tmp['ID'];
	if ($SessLogged=="OK" AND (isset($ConsID[$AD_TempCUID]) AND !empty($ConsID[$AD_TempCUID]))){
		if (isset($ConsID[$AD_TempCUID]) AND !empty($ConsID[$AD_TempCUID])){
			$ConsLinkColor="";
			$ConsLink.="&cn=".$ConsID[$AD_TempCUID];
		} else {
			$ConsLinkColor="<font color=red>";
		}
	} else {
		$ConsLinkColor="<font color=black>";
	}
	$mapinfolink[$AB_N_BILL[$adbase_tmp['ID']]]="?cedit=".$ConsLink;
	$res.=$ConsLink;
	$res.=$syearlnk;
#	$res.=" title='".$AD_TempCUID."/".$ConsID[$AD_TempCUID]."' alt='".$AD_TempCUID."/".$ConsID[$AD_TempCUID]."'";
	$res.=">".$ConsLinkColor;
	$res.=$AB_N_BILL[$adbase_tmp['ID']];
	$res.="</font></a></td>";
	if (isset($ConsCoord[$AD_TempCUID])){
	$mapfillcontent[$AB_N_BILL[$adbase_tmp['ID']]]=$AB_N_BILL[$adbase_tmp['ID']].": ";
}
# тип конструкции

	$res.="<td class=long>".$AB_BILLTYPE[$adbase_tmp['ID']]."</td>";

	if ($SessLogged=="OK") {
		$res.="<td class=long><a href=?saler=sl".$AB_ID_SALER[$adbase_tmp['ID']].">".$AB_SALER[$adbase_tmp['ID']]."</a></td>";
	}

# город/населеный пункт

	$res.="<td class=long>";
	if (isset($AddrCity[$AD_TempCUID])){
		$res.="<span";
		$res.=" title='";
		$res.=$AB_CITY[$adbase_tmp['ID']]."'";
		$res.=" alt='";
		$res.=$AB_CITY[$adbase_tmp['ID']]."'";
		$res.=">";
		$res.=$AddrCity[$AD_TempCUID];
		$res.="</span>";
		if (isset($Temp_GisCity[$AddrCity[$AD_TempCUID]]) AND !empty($Temp_GisCity[$AddrCity[$AD_TempCUID]])){
			$Temp2gisCity=$Temp_GisCity[$AddrCity[$AD_TempCUID]];
		} else {$Temp2gisCity="vladivostok";}
	} else {
		$res.=$AB_CITY[$adbase_tmp['ID']];
		$Temp2gisCity=$Temp_GisCity[$AB_CITY[$adbase_tmp['ID']]];
	}
	$res.="</td>";

# выбор конструкции
	$res.="<td class=clong align=center width=15px><input type=checkbox name='ch_surfs[]' value='#".$adbase_tmp['ID']."' checked></td>";
# адрес конструкции

	$addrlink="";
	$res.="<td class=long>";
	if (isset($ConsID[$AD_TempCUID]) AND !empty($ConsID[$AD_TempCUID])){
		$res.="<a href=?sedit=".$adbase_tmp['ID'].$syearlnk.">";		
		$addrlink="1";
	}
	$res_adr="";
	if (isset($AddrStr1[$AD_TempSUID])){
		$res_adr.=$AddrStr1[$AD_TempSUID];
	}
	if (isset($AddrNum1[$AD_TempSUID])){
		$res_adr.=$AddrNum1[$AD_TempSUID];
	}
	if (isset($AddrStr2[$AD_TempSUID])){
		$res_adr.=$AddrStr2[$AD_TempSUID];
	}
	if (isset($AddrNum2[$AD_TempSUID])){
		$res_adr.=$AddrNum2[$AD_TempSUID];
	}
	if (isset($AddrOrient[$AD_TempSUID])){
		$res_adr.=$AddrOrient[$AD_TempSUID];
	}
	if (isset($SideOrient[$AD_TempSUID])){
		$res_adr.=$SideOrient[$AD_TempSUID];
	}
	if (isset($AddrAdd1[$AD_TempSUID])){
		$res_adr.=$AddrAdd1[$AD_TempSUID];
	}
	if (isset($AddrAdd2[$AD_TempSUID])){
		$res_adr.=$AddrAdd2[$AD_TempSUID];
	}
	if (isset($SidePrizm[$AD_TempSUID])){
		$res_adr.=$SidePrizm[$AD_TempSUID];
	}
	if (isset($ConsCoord[$AD_TempCUID])){
		$mapfillcontent[$AB_N_BILL[$adbase_tmp['ID']]].=$res_adr;
	}
	if (isset($ConsID[$AD_TempCUID]) AND isset($UseBefore[$ConsID[$AD_TempCUID]]) AND $UseBefore[$ConsID[$AD_TempCUID]]<date("Y-m-d",time())){
		$res.=" <span style='text-decoration:line-through;'";
		$res.=" alt='снято с продажи ".$UseBefore[$ConsID[$AD_TempCUID]]."'";
		$res.=" title='снято с продажи ".$UseBefore[$ConsID[$AD_TempCUID]]."'";
		$res.=">";
		$res.=$AB_ADDRESS[$adbase_tmp['ID']];
		$res.="</text>";
		$iy++;
	} elseif (empty($res_adr)){
		$res.=$AB_ADDRESS[$adbase_tmp['ID']];
		$res.=" <span";
		$res.=" alt='нет в базе'";
		$res.=" title='нет в базе'";
		$res.=">";
		$res.="<font color=red>(!)</font></span>";
		$iy++;
	} else {
		$res.=$AB_ADDRESS[$adbase_tmp['ID']];
	}
	if ($addrlink=="1") {$res.="</a>";}
	$res.="</td>";

# сторона/поверхность

	$res.="<td class=clong>";
	if (isset($SideLett[$adbase_tmp['ID']]) AND trim($SideLett[$adbase_tmp['ID']])) {
		$res.="<a href=?sedit=".$adbase_tmp['ID'].">";
		$res.=$SideLett[$adbase_tmp['ID']];
		if (isset($SurfNum[$adbase_tmp['ID']])){
			$res.="/".$SurfNum[$adbase_tmp['ID']];
		}
		$res.="</a>";
	} elseif (isset($AB_SIDE[$adbase_tmp['ID']]) AND trim($AB_SIDE[$adbase_tmp['ID']])) {
		$res.="<a href=?sedit=".$adbase_tmp['ID'].">";
		$res.=$AB_SIDE[$adbase_tmp['ID']];
		if (isset($SurfNum[$adbase_tmp['ID']])){
			$res.="/".$SurfNum[$adbase_tmp['ID']];
		}
		$res.="</a>";
		} else {$res.="&nbsp";}
	$res.="</td>";

# освещение

	$res.="<td class=long>";
		if (isset($AB_LIGHT[$adbase_tmp['ID']]) AND trim($AB_LIGHT[$adbase_tmp['ID']])=="Есть"){
		$res.="<font color=#CCCC00><b>OK</b></font>";
		} else {$res.="&nbsp;";}

		$res.="</td>";

		if ($SessLogged=="OK") {
			$res.="<td class=rlong>".$AB_COST[$adbase_tmp['ID']]."</td>";
			$res.="<td class=rlong>".$AB_NET_COST[$adbase_tmp['ID']]."</td>";
		}

# состояние поверхности

	if (isset($sel_mnth) AND !isset($sel_mnth['all'])){
		reset ($sel_mnth);
		asort($sel_mnth);
		while (list($kmon,$vmon)=each($sel_mnth)) {
			if (strlen($NumMonth[$kmon])<2){
				$tmon="0".$NumMonth[$kmon];
			} else {$tmon=$NumMonth[$kmon];}
			$res.="<td width=20 class=r".$AB_C[$tmon][$adbase_tmp['ID']];
			$res.=" alt='".$signAlt[$AB_C[$tmon][$adbase_tmp['ID']]]."'";
			$res.=" title='".$signAlt[$AB_C[$tmon][$adbase_tmp['ID']]]."'>";
			$res.="<font size=-4 color=".$color[$AB_C[$tmon][$adbase_tmp['ID']]].">";
			$res.=$signAlt[$AB_C[$tmon][$adbase_tmp['ID']]]."</font>";
#			$res.=$sign[$AB_C[$tmon][$adbase_tmp['ID']]]."</td>";
			$res.="</td>";
		}
	} elseif (isset($sel_mnth['all'])) {
		reset ($NumMonth);
		asort($NumMonth);
		while (list($kmon,$vmon)=each($NumMonth)) {
			if (trim($NumMonth[$kmon]) AND strlen($NumMonth[$kmon])<2){
				$tmon="0".$NumMonth[$kmon];
			} elseif (trim($NumMonth[$kmon])) {
				$tmon=$NumMonth[$kmon];
			} else {$tmon="";}
			if (trim($tmon)){
				$res.="<td width=20 class=r".$AB_C[$tmon][$adbase_tmp['ID']];
				$res.=" alt='".$signAlt[$AB_C[$tmon][$adbase_tmp['ID']]]."'";
				$res.=" title='".$signAlt[$AB_C[$tmon][$adbase_tmp['ID']]]."'>";
				$res.="<font size=-4 color=".$color[$AB_C[$tmon][$adbase_tmp['ID']]].">";
				$res.=$signAlt[$AB_C[$tmon][$adbase_tmp['ID']]]."</font>";
#				$res.=$sign[$AB_C[$tmon][$adbase_tmp['ID']]]."</td>";
				$res.="</td>";
			}
		}
	}

# координаты

	$res.="<td class=clong>";
	if (isset($ConsCoord[$AD_TempCUID])){
		$res.="<a href=\"http://2gis.ru/";
		if (!isset($Temp2gisCity)){$res.="vladivostok";}
		else {$res.=$Temp2gisCity;}
		$res.="/callout/";
		$res.=$ConsCoord[$AD_TempCUID]."%2C18";
		$res.="/center/";
		$res.=$ConsCoord[$AD_TempCUID];
		$res.="/zoom/18\"";
		$res.=" target=_blank>";
		$res.="<font color=#A00000><b>К</b></font>";
		$res.="</a>";
		$coordm_tmp=explode("%2C",$ConsCoord[$AD_TempCUID]);
		$mapfillcoord[$AB_N_BILL[$adbase_tmp['ID']]]=$coordm_tmp[1].",".$coordm_tmp[0];
		$CoordX=(float)$coordm_tmp[0];
		$CoordY=(float)$coordm_tmp[1];
		if (!isset($coordXmin)){$coordXmin=$CoordX;}
		elseif ($coordXmin>$CoordX){$coordXmin=$CoordX;}
		if (!isset($coordXmax)){$coordXmax=$CoordX;}
		elseif ($coordXmax<$CoordX){$coordXmax=$CoordX;}
		if (!isset($coordYmin)){$coordYmin=$CoordY;}
		elseif ($coordYmin>$CoordY){$coordYmin=$CoordY;}
		if (!isset($coordYmax)){$coordYmax=$CoordY;}
		elseif ($coordYmax<$CoordY){$coordYmax=$CoordY;}

	} else {$res.="&nbsp;<!-- ".$AD_TempCUID." -->";}
	$res.="</td>";

# фото

	$res.="<td class=clong>";
	if (isset($SideWeb[$AD_TempSUID]) OR isset($SideWeb[$ADx_TempSUID]) OR (isset($SideAWeb[$adbase_tmp['ID']]))){
		$imgnum="";
		if (isset($SideWeb[$AD_TempSUID])){
#			$res.=$SideWeb[$AD_TempSUID];
			$imgnum=$SideWeb[$AD_TempSUID];
		} elseif (isset($SideWeb[$ADx_TempSUID])){
#			$res.=$SideWeb[$ADx_TempSUID];
			$imgnum=$SideWeb[$ADx_TempSUID];
		} else {
#			$res.=$SideAWeb[$adbase_tmp['ID']];
			$imgnum=$SideAWeb[$adbase_tmp['ID']];
		}
		$mapfilllink[$AB_N_BILL[$adbase_tmp['ID']]]=$img_main.$imgnum;
		$res.="<a href=\"".$img_main.$imgnum;
		$res.="\" target=_blank>";
		$res.="<font color=#0000A0><b>".$imgnum."</b></font>";
		$res.="</a>";
	} else {$res.="&nbsp;";}
	$imgnum="";
	$res.="</td></tr>";

?>
