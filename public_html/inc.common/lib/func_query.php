<?php

function URLpath(){

    $url_arr=parse_url($_SERVER['PHP_SELF']);
    echo "\n<!-- ::: ".$url_arr['path']." ::: -->\n\n";
    $URL_path=explode("/",$url_arr['path']);
    $urlpath=$URL_path[1];

    if ($urlpath=="index.php" OR $urlpath=="index2.php"){$urlpath="";}
    
    return $urlpath;
}

function parseQuery($param=""){
 
    $tqueryst=explode("&",$_SERVER['QUERY_STRING']);

    while(list($qk,$qv)=each($tqueryst)){
	
        $tq=explode("=",htmlspecialchars(strip_tags($qv)));

        if (isset($tq[1]) AND !empty(trim($tq[1]))){
            $tquery[trim($tq[0])]=trim($tq[1]);
        } else {
            $tquery[trim($tq[0])]="";
        }

    }

    if (isset($tquery[$param])){
        return $tquery[$param];
    } elseif (!empty($param) AND isset($tquery)) {
        return $tquery;
    } else {
        return FALSE;
    }

}


function parse_query($anchor=''){

	parse_str(parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY),$query);

	if (empty($anchor) AND is_array($query)){
		reset($query);
		return $query;
	} elseif (isset($query[$anchor])) {
		return "#".$query[$anchor];
	} else {return "";}

}

// nquery - массив [параметр]=значение, clear - если не пусто, формирование новой строки без учета старой 
function UrlQuery($nquery='',$clear='',$anchor=''){                  

#	global $tquery;

	if (empty($tquery)){$tquery=parse_query();}

	if (!empty($nquery)){reset($nquery);}
    
	if (isset($tquery) AND empty($clear)){

		if (!empty($nquery)){
            $tq_new=array_replace_recursive($tquery,$nquery);
        } else {$tq_new=$tquery;}
	}
    
	if (!isset($tq_new) AND !empty($nquery)) {$tq_new=$nquery;}
    
	if (isset($tq_new)){

        reset($tq_new);

        while(list($nqk,$nqv)=each($tq_new)){
			if (!empty($nqv) AND $nqv=="-"){;}
			elseif (!empty($nqv)){$tquery_new[]=$nqk."=".$nqv;}
			elseif(!empty($nqk)) {$tquery_new[]=$nqk;}
		}

        if (isset($tquery_new)){
			reset($tquery_new);
			$new_qr=implode("&",$tquery_new);
		}

        if (isset($new_qr) AND !empty($new_qr)){$newqr="?".$new_qr;}
		else {$newqr=".";}
	
	} else {$newqr=".";}
	
    if(!empty($anchor) AND $anchor_dat=parse_query($anchor)){$newqr.=$anchor_dat;}
    elseif (!empty($anchor) AND isset($tq_new[$anchor])){$newqr.="#".$tq_new[$anchor];}
    
	return $newqr;
    
}

function makeRefresh($odb=""){

    $nquery=parse_query();
    
    if(isset($nquery['q'])){

        echo "\n\n<!-- *".$nquery['q']."* ".UrlPath()." ** -->\n\n";

        $tmp_arr=explode("/",$nquery['q']);

        if ($tmp_arr[0]=='node' AND intval($tmp_arr[1])>0){

            $get_q="SELECT SIDE_ID,URL FROM SIDE WHERE URL='".intval($tmp_arr[1])."'";
        }

    } elseif(isset($nquery['ad'])){

        if (intval(trim($nquery['ad']))>0){

            $get_q="SELECT SURF_ID,ADDR_ID,LINKS.ID_SURF,LINKS.ID_SIDE FROM SURF 
                LEFT JOIN LINKS ON LINKS.ID_SURF=SURF_ID
                WHERE ADDR_ID='".intval($nquery['ad'])."'";
        }

   } else {
#        echo "\n\n<!-- *1* ".UrlPath()." *1* -->\n\n";
    }

    if (isset($get_q) AND !empty($get_q)){

        echo "\n\n<!-- get_q*".$get_q." ** -->\n\n";
        $get_side=mysqli_query($odb,$get_q);

        if(mysqli_num_rows($get_side)>0){
                
            while ($row=mysqli_fetch_array($get_side)){

                if (isset($row['SIDE_ID']) AND intval($row['SIDE_ID'])>0){$set_query['side']=$row['SIDE_ID'];}
                elseif (isset($row['ID_SIDE']) AND intval($row['ID_SIDE'])>0){$set_query['side']=$row['ID_SIDE'];}
            
            }

            if (isset($set_query['side']) AND intval($set_query['side'])>0){
                $set_query['q']="-";
                $set_query['ad']="-";
                $set_query['ads']="-";
                $set_query['sid']="-";
                if(isset($nquery['ad'])){$set_query['card']="";}
            } else {$err_adm[]="no SIDE FOR query: '".$get_q."'";}
    
        } else {
            $set_query['q']="-";
            $set_query['ad']="-";
            $set_query['ads']="-";
            $set_query['sid']="-";
        }
    }

    if(isset($set_query)){
        echo '<meta http-equiv="refresh" content="0;url='.UrlQuery($set_query,'','side').'" />';
        die;
    }
}

function lnk_tt($val='',$type=''){

    if (!empty($val)){
        $digital=explode("LED-",$val);
        $prizm=explode("призма",$val);

        $ttPath='/docs/tt/';

        if (sizeof($digital)>1){
            $link_tt=" [<a href=$ttPath.'media.pdf' title='Тех. требования к файлам роликов' target='dvoutdoor_tt'><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]";
        }
        elseif (sizeof($prizm)>1 AND $type=="Биллборд 3x4"){
            $link_tt=" [<a href=$ttPath.'prizm3x4.pdf' title='Тех. требования к рекламному материалу' target='dvoutdoor_tt'><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]";
        }
        elseif (sizeof($prizm)>1 AND $type=="Биллборд 3x6"){
            $link_tt=" [<a href=$ttPath.'prizm.pdf' title='Тех. требования к рекламному материалу' target='dvoutdoor_tt'><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]";
        }
        elseif (sizeof($prizm)>1 AND $type=="Суперборд 3x12"){
            $link_tt=" [<a href=$ttPath.'prizm3x12.pdf' title='Тех. требования к рекламному материалу' target='dvoutdoor_tt'><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]";
        }
        elseif ($type=="Биллборд 3x4"){
            $link_tt=" [<a href=$ttPath.'bboard3x4.pdf' title='Тех. требования к рекламному материалу и файлам макетов' target='dvoutdoor_tt'><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]";
        }
        elseif ($type=="Биллборд 3x6"){
            $link_tt=" [<a href=$ttPath.'bboard3x6.pdf' title='Тех. требования к рекламному материалу и файлам макетов' target='dvoutdoor_tt'><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]";
        }
        else {
            $link_tt=" [<a href=$ttPath.'pr_file.pdf' title='Тех. требования к файлам макетов' target='dvoutdoor_tt'><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]";
        }

        unset($digital);
        unset($prizm);

    } else {$link_tt="";}

    return $link_tt;
}

function lnk_icon($index='',$no_icon=''){

    $alttitle=". Скачать тех. требования";

    $ttPath='/docs/tt/';
    
    if (isset($_GET['sub']) AND !isset($_GET['card'])){$width=24;$swidth=12;$space=' ';}
    else {$width=30;$swidth=20;$space='&nbsp;';}

    if (!empty($index['gmap'])) {   
        $icon[]=$index['gmap'].'<img src="/img/google-maps.png" width="'.$width.'px" border="0"></a>';
    }

    if (!empty($index['lgt'])) {
        $icon[]='<img src="/img/spot2.png" width="'.$width.'px" border="0" title="'.$index['lgt'].'">';
    }

    if (!empty($index['prz']) AND $index['tp']=="Биллборд 3x6") {
        $alttitle.=" к рекламному материалу";
        $icon[]='<a href="'.$ttPath.'prizm.pdf" title="'.$index['prz'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/prizm2.png" width="'.$width.'px" border="0" title="'.$index['prz'].$alttitle.'"></a>';
        $link_icon='<a href="'.$ttPath.'prizm.pdf" title="'.$index['prz'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/ttpdf.png" width="'.$swidth.'px" border="0" title="'.$index['prz'].$alttitle.'"></a>';
        $link_tt='[<a href="'.$ttPath.'prizm.pdf" title="'.$index['prz'].$alttitle.'" target="dvoutdoor_tt"><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]';
    } elseif (!empty($index['prz'])) {
        $alttitle.=" к рекламному материалу";

        if ($index['tp']=="Биллборд 3x4"){
            $pdf_name="prizm3x4";
        } elseif ($index['tp']=="Суперборд 3х12"){
            $pdf_name="prizm3x12";
        } else {
            $pdf_name="prizm";
        }

        $icon[]='<a href="'.$ttPath.$pdf_name.'.pdf" title="'.$index['prz'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/prizm2.png" width="'.$width.'px" border="0" title="'.$index['prz'].$alttitle.'"></a>';
        $link_icon='<a href="'.$ttPath.$pdf_name.'.pdf" title="'.$index['prz'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/ttpdf.png" width="'.$swidth.'px" border="0" title="'.$index['prz'].$alttitle.'"></a>';
        $link_tt='[<a href="'.$ttPath.$pdf_name.'.pdf" title="'.$index['prz'].$alttitle.'" target="dvoutdoor_tt"><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]';
    } elseif(!empty($index['dgt'])){
        $alttitle.=" к файлам роликов";
        $icon[]='<a href="'.$ttPath.'media.pdf" title="'.$index['dgt'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/digit2.png" width="'.$width.'px" border="0" title="'.$index['dgt'].$alttitle.'"></a>';
        $link_icon='<a href="'.$ttPath.'media.pdf" title="'.$index['dgt'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/ttpdf.png" width="'.$swidth.'px" border="0" title="'.$index['dgt'].$alttitle.'"></a>';
        $link_tt='[<a href="'.$ttPath.'media.pdf" title="'.$index['dgt'].$alttitle.'" target="dvoutdoor_tt"><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]';
    } elseif (isset($index['tp']) AND $index['tp']=="Биллборд 3x6"){
        $alttitle.=" к рекламному материалу и файлам макетов";
        $link_icon='<a href="'.$ttPath.'bboard3x6.pdf" title="'.$index['tp'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/ttpdf.png" width="'.$swidth.'px" border="0" title="'.$index['tp'].$alttitle.'"></a>';
        $link_tt='[<a href="'.$ttPath.'bboard3x6.pdf" title="'.$index['tp'].$alttitle.'" target="dvoutdoor_tt"><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]';
    } elseif (isset($index['tp']) AND $index['tp']=="Биллборд 3x4"){
        $alttitle.=" к рекламному материалу и файлам макетов";
        $link_icon='<a href="'.$ttPath.'bboard3x4.pdf" title="'.$index['tp'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/ttpdf.png" width="'.$swidth.'px" border="0" title="'.$index['tp'].$alttitle.'"></a>';
        $link_tt='[<a href="'.$ttPath.'bboard3x4.pdf" title="'.$index['tp'].$alttitle.'" target="dvoutdoor_tt"><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]';
    } else {
        $alttitle.=" к файлам макетов";
        $link_icon='<a href="'.$ttPath.'pr_file.pdf" title="'.$index['tp'].$alttitle.'" target="dvoutdoor_tt"><img src="/img/ttpdf.png" width="'.$swidth.'px" border="0" title="'.$index['tp'].$alttitle.'"></a>';
        $link_tt='[<a href="'.$ttPath.'pr_file.pdf" title="'.$index['tp'].$alttitle.'" target="dvoutdoor_tt"><font color=darkblue size=-1><b>Скачать ТТ</b></font></a>]';
    }

    if (is_array($icon) AND empty($no_icon)){
        return $space.implode($pace.$space,$icon).$space;
    } elseif (isset($link_icon) AND !empty($no_icon) AND $no_icon=='yes'){
        return $link_icon;
    } elseif (isset($link_tt) AND !empty($no_icon) AND $no_icon=='txt'){
        return $link_tt;
    } else {return false;}
}

?>