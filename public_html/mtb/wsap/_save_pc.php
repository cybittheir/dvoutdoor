<?php

$pre_button="<b><font color=darkgreen>изменения сохранены в базе: </font></b>";

if ($_POST['model']!==$model) {

    $model=$_POST['model'];
    $up[]="model_pc='".$model."'";

}

if ($_POST['mac1']!==$mac1) {

    $mac1=$_POST['mac1'];
    $up[]="MAC1='".$mac1."'";

}

if ($_POST['mac2']!==$mac2) {

    $mac2=$_POST['mac2'];
    $up[]="MAC2='".$mac2."'";

}

if ($_POST['power']!==$power) {

    $power=$_POST['power'];
    $up[]="power_pc='".$power."'";

}

if ($_POST['anydesk']!==$anydesk) {

    $anydesk=$_POST['anydesk'];
    $up[]="anydesk='".$anydesk."'";

}

if (!empty($_POST['info'])) {

    if (!isset($info)){$info="";}
    else {$info.="\n";}
    
    $info.=date("d/m/Y H:i",time()).": ".$_POST['info'];
    $up[]="memo_pc='".$info."'";

}



$up_values=implode(",",$up);

$save_q="UPDATE _units_pc SET 
    ".$up_values." 
    WHERE id_pc='".$pc_id."'";

if ($save_pc=dbQuery($save_q,'mf')){
            
    $pre_button="<font color=green>изменения сохранены</font>";

} else {echo "Ошибка сохранения записи";}

?>