<?php

$pre_button="<b><font color=darkgreen>изменения сохранены в базе: </font></b>";

if ($_POST['model']!==$model) {

    $model=$_POST['model'];
    $up[]="model='".$model."'";

}

if ($_POST['mac1']!==$mac1) {

    $mac1=$_POST['mac1'];
    $up[]="MAC='".$mac1."'";

}

if ($_POST['power']!==$power) {

    $power=$_POST['power'];
    $up[]="power='".$power."'";

}

if (!empty($_POST['info'])) {

    if (!isset($info)){$info="";}
    else {$info.="\n";}
    
    $info.=date("d/m/Y H:i",time()).": ".$_POST['info'];
    $up[]="memo='".$info."'";

}

$up_values=implode(",",$up);

$save_q="UPDATE _units SET 
    ".$up_values." 
    WHERE id_unit='".$unit_id."'";

# echo $save_q;

if ($save_un=dbQuery($save_q,'mf')){
            
    $pre_button="<font color=green>изменения сохранены</font>";

} else {echo "Ошибка сохранения записи";}


?>