<?php

$pre_button="<b><font color=darkgreen>изменения сохранены в базе: </font></b>";

if (isset($_POST['type']) AND intval($_POST['type'])==5){
    
    $use_base="_units_pc";
    
    $moves="_move_pc";
    
    $fieldIdname="id_pc";

    $fieldIdMove="pcId";

    if (!empty($_POST['model'])) {

        $model=$_POST['model'];
        $up['model_pc']="'".$model."'";
    
    } else {

        $up['model_pc']="'?noname?'";

    }
    
    $fields['model_pc']="model_pc";

    if (!empty($_POST['mac1'])) {
    
        if (sizeof($tmp_mac=explode(":",$_POST['mac1']))>2){

            $mac1=implode("",$tmp_mac);

            echo "<br>1??".$mac1;

        } elseif(sizeof($tmp_mac=explode("-",$_POST['mac1']))>2){

            $mac1=implode("",$tmp_mac);
            echo "<br>2??".$mac1;

        } else {

            $mac1=$_POST['mac1'];
            echo "<br>3??".$mac1;

        }
    
        $up['MAC1']="'".$mac1."'";
        $fields['MAC1']="MAC1";
    
    }
    
    if (!empty($_POST['mac2'])) {
    
        $mac2=$_POST['mac2'];
        $up['MAC2']="'".$mac2."'";
        $fields['MAC2']="MAC2";
    
    }
    
    if (!empty($_POST['power'])) {
    
        $power=$_POST['power'];
        $up['power_pc']="'".$power."'";
        $fields['power_pc']="power_pc";
    
    }
    
    if (!empty($_POST['anydesk'])) {
    
        $anydesk=$_POST['anydesk'];
        $up['anydesk']="'".$anydesk."'";
        $fields['anydesk']="anydesk";
    
    }
    
    if (!empty($_POST['player_type'])) {
    
        $player=$_POST['player_type'];
        $up['player_type']="'".$player."'";
        $fields['player_type']="player_type";
    
    }
    
    if (!empty($_POST['info'])) {
    
        $info=date("d/m/Y H:i",time()).": ".$_POST['info'];
        $up['memo_pc']="'".$info."'";
        $fields['memo_pc']="memo_pc";
    
    }
    
    $up['reg_date_pc']="'".date("Y-m-d",time())."'";
    $fields['reg_date_pc']="reg_date_pc";
    
} else {
    
    $use_base="_units";

    $moves="_move_units";

    $fieldIdname="id_unit";

    $fieldIdMove="unitId";

    $up['type_id']=intval($_POST['type']);
    $fields['type_id']='type_id';

    if (!empty($_POST['model'])) {

        $model=$_POST['model'];
        $up['model']="'".$model."'";
        $fields['model']="model";
    
    }
    
    if (!empty($_POST['mac1'])) {

        if (sizeof($tmp_mac=explode(":",$_POST['mac1']))>2){

            $mac1=implode("",$tmp_mac);

            echo "<br>1??".$mac1;

        } elseif(sizeof($tmp_mac=explode("-",$_POST['mac1']))>2){

            $mac1=implode("",$tmp_mac);
            echo "<br>2??".$mac1;

        } else {

            $mac1=$_POST['mac1'];
            echo "<br>3??".$mac1;

        }
    
        $up['MAC']="'".$mac1."'";
        $fields['MAC']="MAC";
    
    }
    
    if (!empty($_POST['power'])) {
    
        $power=$_POST['power'];
        $up['power']="'".$power."'";
        $fields['power']="power";
    
    }
    
    if (!empty($_POST['info'])) {
    
        $info=date("d/m/Y H:i",time()).": ".$_POST['info'];
        $up['memo']="'".$info."'";
        $fields['memo']="memo";
    
    }
    
    $up['reg_date']="'".date("Y-m-d",time())."'";
    $fields['reg_date']="reg_date";
    
}

$up['tmp_code']="'".genTCODE(8)."'";
$fields['tmp_code']="tmp_code";

reset($up);
reset($fields);

$add_fields=implode(",",$fields);

$add_values=implode(",",$up);

$add_q="INSERT INTO ".$use_base." (".$add_fields.") VALUES 
    (".$add_values.")";

    echo $add_q;
    
if ($add_equip=dbQuery($add_q,'mf')){

    reset($up);

    unset($up['memo']);
    unset($up['memo_pc']);

    while (list($f,$v)=each($up)){

        $check_rec[]=$f."=".$v;

    }

    reset($check_rec);

    $check_values=implode(" AND ",$check_rec);

    $check_q="SELECT * FROM ".$use_base." WHERE ".$check_values;

    $check_equip=dbQuery($check_q,'mf');

    if (mysqli_num_rows($check_equip)>0){

        while($erow = mysqli_fetch_array($check_equip)){
        
            $new_id=$erow[$fieldIdname];
            
        }

        $to_reserv_q="INSERT INTO ".$moves." (".$fieldIdMove.",object_id,used_before) VALUES ('".$new_id."','1','2000-01-01')";

        if ($to_reserv=dbQuery($to_reserv_q,'mf')){
            
            $clear_q="UPDATE ".$use_base." SET tmp_code = NULL WHERE ".$fieldIdname."=".$new_id;

            $clear_code=dbQuery($clear_q,'mf');

        } else {echo "Ошибка новой записи №3";}
        
    } else {echo "Ошибка новой записи №2 :: ".$check_q;}


} else {echo "Ошибка новой записи №1";}

# echo $add_q."<br>\n";

# echo $check_q."<br>\n";

?>