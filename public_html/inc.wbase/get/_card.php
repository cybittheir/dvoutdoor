<?php

if (isset($_GET['side']) AND intval($_GET['side'])>0){

    $side_id=intval($_GET['side']);

} elseif (isset($_GET['card']) AND intval($_GET['card'])>0){

    $side_id=intval($_GET['card']);

} elseif (isset($_GET['q']) AND !empty($_GET['q'])) {

    $node_q=explode("/",htmlspecialchars($_GET['q']));
    $node=intval($node_q[1]);

    $get_id_q="SELECT SIDE_ID,URL FROM SIDE
    WHERE URL ='".$node."'";

    $get_id=mysqli_query($odb,$get_id_q);

    while ($rec_links=mysqli_fetch_array($get_id)){

        $side_id=$rec_links['SIDE_ID'];

    }

} elseif (isset($_GET['sid']) AND intval($_GET['sid'])>0) {

    $addr_id=intval($_GET['sid']);

    $get_id_q="SELECT LINKS.*,SURF.SURF_ID,SURF.ADDR_ID FROM LINKS
    LEFT JOIN SURF ON SURF_ID=ID_SURF 
    WHERE ADDR_ID='".$addr_id."'";

    $get_id=mysqli_query($odb,$get_id_q);

    while ($rec_links=mysqli_fetch_array($get_id)){
        $side_id=$rec_links['ID_SIDE'];
    }

} 

$card_query['card']="";

if (isset($side_id) AND intval($side_id)>0){

    $make_map=FALSE;

    $card_q="SELECT LINKS.*,
        SIDE.SIDE_ID,SIDE.URL,SIDE.SIDE_LETTER,SIDE.LIGHT as LIGHTS,SIDE.TYPE as PRIZM,
        CONS.CONS_ID,CONS.REG_NUM,CONS.CITY,CONS.ADDRESS as TITLE,CONS.COORDX,CONS.COORDY,CONS.TYPE,
        surfs.*,MIN(surfen.seid) AS ENABLE
        FROM SIDE 
        LEFT JOIN LINKS ON SIDE_ID=ID_SIDE
        LEFT JOIN CONS ON CONS_ID=ID_CONS
        LEFT JOIN (SELECT SURF_ID as seid,NOT_ENABLE FROM SURF WHERE NOT_ENABLE IS NULL) AS surfen ON surfen.seid=ID_SURF
        LEFT JOIN (SELECT SURF_ID,ADDR_ID,ADDRESS,BILL_TYPE,NOT_SALE,LIGHT FROM SURF) AS surfs ON surfs.SURF_ID=ID_SURF
        WHERE SIDE_ID='".$side_id."'";

# echo "\n\n<!-- \n".$card_q."\n -->\n\n";

    $card=mysqli_query($odb,$card_q);

    while ($rec=mysqli_fetch_array($card)){

        if(empty($rec['SURF_ID']) AND empty($rec['ADDR_ID']) AND $rec['PRIZM']!='dig'){
            $err['not_sale']="Сторона снята с продажи"; 
            break;               
        } elseif ($rec['PRIZM']!='dig') {
            $surf_index=$rec['sid'];
            $side_index=$rec['SIDE_ID'];
        } else {
            $surf_index=$rec['SURF_ID'];
            $side_index=$rec['SIDE_ID'];
        }

        $s_row[$side_index]['city']=$rec['CITY'];
        $s_row[$side_index]['tp']=$rec['BILL_TYPE'];
        $s_row[$side_index]['reg']=$rec['REG_NUM'];
        $s_row[$side_index]['title']=$rec['TITLE'];
        $s_row[$side_index]['side']=$rec['SIDE_LETTER'];

        $s_row[$side_index]['prz']="";
        $s_row[$side_index]['dgt']="";

        if(!empty($rec['PRIZM']) AND $rec['PRIZM']=='prizm'){
            $s_row[$side_index]['prz']="призма";
        } elseif(!empty($rec['PRIZM']) AND $rec['PRIZM']=='dig'){
            $s_row[$side_index]['dgt']="цифра/медиа/LED-экран";
        } elseif(empty($rec['PRIZM']) AND $tt=sizeof(explode("призма",$rec['ADDRESS']))>1) {
            $s_row[$side_index]['prz']="призма";
        } elseif(empty($rec['PRIZM']) AND sizeof($tt=explode("цифра-медиа",$rec['ADDRESS']))>1) {
            $s_row[$side_index]['dgt']="цифра/медиа/LED-экран";
        }
            
        unset($tt);
        
        if(empty($rec['LIGHT'])){
            $s_row[$side_index]['lgt']="";
        } else {
            $s_row[$side_index]['lgt']="есть освещение в ночное время";
        }

        $select_not_sale="AND NOT_SALE IS NULL ";

        if(!empty($rec['ENABLE']) AND  $rec['PRIZM']=='dig'){
            $s_row[$side_index]['en']="Возможно в продаже. Зависит от даты размещения";
            $select_not_sale="";
        } elseif(!empty($rec['ENABLE'])){
            $s_row[$side_index]['en']="Возможно в продаже. Зависит от месяца размещения";
        } elseif(!empty($rec['NOT_SALE'])){
            $s_row[$side_index]['en']="Снято с продажи";
        } else {$s_row[$side_index]['en']="продано до конца года";}

        if (!empty($rec['COORDX']) AND !empty($rec['COORDY'])) {
            $s_row[$side_index]['X']=$rec['COORDX'];
            $s_row[$side_index]['Y']=$rec['COORDY'];
            $make_map=TRUE;
            $s_row[$side_index]['gmap']=googleMAP($rec['COORDX'],$rec['COORDY']);
        } else {$s_row[$side_index]['gmap']="";}

        if (!empty($rec['ADDRESS'])){
            $s_row[$side_index]['fulladdr']=str_replace("цифра-медиа","цифра/медиа/LED-экран",$rec['ADDRESS']);
        }

    }

    if (!isset($err['not_sale'])){

        reset($s_row);

        $surf_q="SELECT LINKS.*,SIDE.SIDE_ID,surfs.*
        FROM SIDE 
        LEFT JOIN LINKS ON SIDE_ID=ID_SIDE
        LEFT JOIN (SELECT SURF_ID,ADDR_ID,ADDRESS,BILL_TYPE,NOT_SALE,LIGHT FROM SURF) AS surfs ON surfs.SURF_ID=ID_SURF
        WHERE SIDE_ID='".$side_id."' ".$select_not_sale."ORDER BY ADDRESS ASC";

# echo "\n\n<!-- \n".$surf_q."\n -->\n\n";

        $surf=mysqli_query($odb,$surf_q);

        if (mysqli_num_rows($surf)>0) {

            while ($rec=mysqli_fetch_array($surf)){
                $addr_row[]=str_replace("цифра-медиа","цифра/медиа/LED-экран",$rec['ADDRESS']);
            }
        }

        reset ($addr_row);

        $pics_root="pics/";
        $link_root="pics/";

// показывается последний из загруженных файлов. фильтрация по 'preview.'

#        $show_image=GetLastImage($side_index);

        ArchiveImageList($side_index);

        $show_image_list=GetImageList($side_index);

        if (!isset($_GET['inum']) OR sizeof($show_image_list)==1) {
            $img_path=$show_image_list[0]['full'];
            $preview_path=$show_image_list[0]['preview'];
        } elseif(sizeof($show_image_list)>1){

            $img_num=intval($_GET['inum']);

            if (isset($show_image_list[$img_num]['full'])){
                $img_path=$show_image_list[$img_num]['full'];
            }

            if (isset($show_image_list[$img_num]['preview'])){
                $preview_path=$show_image_list[$img_num]['preview'];
            }
        }

        $PageTitle=$s_row[$side_index]['title'];
        
        if (!isset($_GET['card'])){
            if (empty($subquery)){include ($inc_path."/tpl/_card.php");}
            else {include ($inc_path."/tpl/_card2.php");}
        } else {
            $show_all['card']="-";
            $show_all['side']="-"; 
            $show_side['card']="-";
            $show_side['inum']="-";
            $show_all['inum']="-";

            if (isset($qcitywhere)){
                $nav_selected=str_replace("surfuls.","SURF.",$qcitywhere);
                $nav_selected=str_replace("AND (surfen.seid IS NOT NULL)","",$nav_selected); // ВРЕМЕННО!!! игнорируем выборку "только в продаже"
            } else {$nav_selected='';}

            $cards_nav=getSideNum($side_id,$nav_selected);
        }

    } else {
        echo "<table width=100% border=0 height=100px><tr><td align=center><font size=+2 color=red>Сторона снята с продажи</font></td></tr></table>";
    }
    
}

?>