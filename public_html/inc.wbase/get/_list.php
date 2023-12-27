<?php

$side_id=get_intval('side');

$full_list_q="SELECT * FROM (
    SELECT LINKS.*,
    SIDE.SIDE_ID,SIDE.URL,SIDE.SIDE_LETTER,SIDE.LIGHT as LIGHTS,SIDE.TYPE as PRIZM,
    CONS.CONS_ID,CONS.REG_NUM,CONS.CITY,CONS.ADDRESS AS TITLE,CONS.COORDX,CONS.COORDY,CONS.TYPE,CONS.POSITION,
    surfs.*,surfuls.*,surfen.*,MIN(surfen.seid) AS ENABLE
    FROM SIDE 
    LEFT JOIN LINKS ON SIDE_ID=ID_SIDE
    LEFT JOIN CONS ON CONS_ID=ID_CONS
    LEFT JOIN (SELECT SURF_ID,NOT_SALE FROM SURF WHERE NOT_SALE IS NULL) AS surfs ON surfs.SURF_ID=ID_SURF
    LEFT JOIN (SELECT SURF_ID as seid,NOT_ENABLE FROM SURF WHERE NOT_ENABLE IS NULL) AS surfen ON surfen.seid=ID_SURF
    LEFT JOIN (SELECT SURF_ID as sid,ADDR_ID,ADDRESS,AREA,BILL_TYPE,LIGHT FROM SURF) AS surfuls ON surfuls.sid=ID_SURF
    WHERE surfs.NOT_SALE IS NULL ".@$qcitywhere." AND SIDE.USED_BEFORE>'".date("Y-m-d",time())."'
    GROUP BY SIDE_ID
    ) AS WORK WHERE ID_SURF IS NOT NULL ORDER BY ADDRESS";

# echo "\n\n<!-- \n".$full_list_q."\n -->\n\n";

$full_list=mysqli_query($odb,$full_list_q);

$all=mysqli_num_rows($full_list);

$i_enabled=0;

while ($rec=mysqli_fetch_array($full_list)){
    $side_index=$rec['SIDE_ID'];
    $surf_id[$side_index]['surf']=$rec['ID_SURF'];

    $tab_row[$side_index]['city']=$rec['CITY'];
    $tab_row[$side_index]['tp']=$rec['BILL_TYPE'];
    $tab_row[$side_index]['reg']=$rec['REG_NUM'];

    if (!empty($rec['TITLE'])){
        $tab_row[$side_index]['addr']=$rec['TITLE'];
    } else {
        $tab_row[$side_index]['addr']=$rec['ADDRESS'];
    }
    
    if(!empty($rec['SIDE_LETTER'])){
        $tab_row[$side_index]['side']=$rec['SIDE_LETTER'];
    } else {$tab_row[$side_index]['side']="-";}
    
    if(!empty($rec['POSITION'])){
        $tab_row[$side_index]['pos']=$rec['POSITION'];
    } else {$tab_row[$side_index]['pos']="";}
    
    if(!empty($rec['PRIZM']) AND $rec['PRIZM']=="prizm"){
        $tab_row[$side_index]['prz']="<span alt='призматрон' title='призматрон'><font size=-1><b>&nbsp;&#9650;&nbsp;</b></font></span>";
    } elseif(!empty($rec['PRIZM']) AND $rec['PRIZM']=="dig"){
        $tab_row[$side_index]['prz']="<span alt='цифра/медиа/LED-экран' title='цифра/медиа/LED-экран'><font size=-1><b>&#9621;&#9626;&#9615;</b></font></span>";
    } elseif(empty($rec['PRIZM']) AND $tt=sizeof(explode("призма",$rec['ADDRESS']))>1) {
        $tab_row[$side_index]['prz']="<span alt='призматрон' title='призматрон'><font size=-1><b>&nbsp;&#9650;&nbsp;</b></font></span>";
        $up_side_q="UPDATE SIDE SET TYPE='prizm' WHERE SIDE_ID='".$rec['SIDE_ID']."'";
        $up_side=mysqli_query($odb,$up_side_q);
    } elseif (empty($rec['PRIZM']) AND sizeof($tt=explode("цифра-медиа",$rec['ADDRESS']))>1) {
        $tab_row[$side_index]['prz']="<span alt='цифра/медиа/LED-экран' title='цифра/медиа/LED-экран'><font size=-1><b>&#9621;&#9626;&#9615;</b></font></span>";
        $up_side_q="UPDATE SIDE SET TYPE='dig' WHERE SIDE_ID='".$rec['SIDE_ID']."'";
        $up_side=mysqli_query($odb,$up_side_q);
    } elseif(empty($rec['PRIZM'])){$tab_row[$side_index]['prz']="";}
    
    unset($tt);

    if(!empty($rec['LIGHT'])){
        $tab_row[$side_index]['lgt']="<span alt='ночное освещение' title='ночное освещение'><font size=-1><b>&#9732;</b></font></span>";
    } else {
        $tab_row[$side_index]['lgt']="";
    }

    if(!empty($rec['ENABLE'])){
        $tab_row[$side_index]['en']="<input type=checkbox name='cb".$side_index."'>";
        $i_enabled++;
    } else {
        $tab_row[$side_index]['en']="<input type=checkbox name='cb".$side_index."' disabled>";
        $disabled[$side_index]=TRUE;
    }

    if (!isset($_SERVER['QUERY_STRING']) OR empty($_SERVER['QUERY_STRING']) OR $_SERVER['QUERY_STRING']=="sub") {

        $coord=$rec['COORDY'].",".$rec['COORDX'];
        
        if (!isset($minX)) {$minX=$rec['COORDX'];}
        elseif (!empty($rec['COORDX']) AND $rec['COORDX']<$minX){$minX=$rec['COORDX'];}
        
        if (!isset($maxX)) {$maxX=$rec['COORDX'];}
        elseif (!empty($rec['COORDX']) AND $rec['COORDX']>$maxX){$maxX=$rec['COORDX'];}
        
        if (!isset($minY)) {$minY=$rec['COORDY'];}
        elseif (!empty($rec['COORDY']) AND $rec['COORDY']<$minY){$minY=$rec['COORDY'];}
        
        if (!isset($maxY)) {$maxY=$rec['COORDY'];}
        elseif (!empty($rec['COORDY']) AND $rec['COORDY']>$maxY){$maxY=$rec['COORDY'];}
        
        $maplink['side']=$side_index;

        $baloon='<a href=/'.UrlQuery($maplink).'>'.str_replace("\"","|",$tab_row[$side_index]['addr']).'</a> Сторона:'.$tab_row[$side_index]['side'].' ';
        
        if (!empty($tab_row[$side_index]['pos'])){$baloon.='Поз.'.$tab_row[$side_index]['pos'].' ';}

        $map_places[]=preMap($side_index,$coord,$baloon,$disabled[$side_index]);

        unset($baloon);
        unset($maplink['side']);
    }
}

if (isset($minX) AND isset($maxX)) {
    $cX=($maxX+$minX)/2;
    $xx= $maxX-$minX;
}

if (isset($minY) AND isset($maxY)) {
    $cY=($maxY+$minY)/2;
    $yy= $maxY-$minY;
}

if ($maxX>$minX) {$Xdef=$maxX-$minX;}
if ($maxY>$minY) {$Ydef=$maxY-$minY;}

if (!isset($Xdef)){$Xdef=0.0031;}
if (!isset($Ydef)){$Ydef=0.0031;}

$yaZoom=16;

$tzoom=log(max($Xdef,$Ydef)/0.003,2);

if ($tzoom>0) {$zoom=$yaZoom-round($tzoom,1);}

$bottomtxt="<B>Всего сторон в списке:</b> ".$all."; <b>из них в продаже:</b> ".$i_enabled;

?>