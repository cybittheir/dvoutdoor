<?php

if (!isset($_GET['card'])){

    if (empty($subquery)){$place_param="height='232'";}
    else {$place_param=" width='380px'";}

    if (file_exists($pics_root.$img_path)){
    
        $alt_txt="нажмите чтобы открыть в полном размере";

        echo "<a href='/".$link_root.$img_path."' target=_blank>";
 
        if (file_exists($pics_root.$preview_path)){
            echo "<img src='/".$link_root.$preview_path."' border='0' ".$place_param." title='".$alt_txt."' alt='".$alt_txt."'>";
        } else {echo "Нет привью. Нажмите чтобы открыть фото";}

        echo "</a>";

    } elseif (file_exists($pics_root.$preview_path)){
        echo "<img src='/".$link_root.$preview_path."' border='0' ".$place_param." title='".$alt_txt."' alt='".$alt_txt."'>";
    } elseif (isset($_SESSION['ip']) AND $_SESSION['ip']=="213.87.104.7") {
        echo "\n??".$link_root.$preview_path."<br>\n??".$pics_root.$img_path;
    } else {
        echo "нет фото";
    }
} else {

    $place_param=" width='800px'";

    if (file_exists($pics_root.$img_path)){
    
        $alt_txt="нажмите чтобы открыть в полном размере";

        echo "<a href='/".$link_root.$img_path."' target=_blank>";
 
        echo "<img src='/".$link_root.$img_path."' border='0' ".$place_param." title='".$alt_txt."' alt='".$alt_txt."'>";
        

        echo "</a>";

        if (sizeof($show_image_list)>1){
            echo "<span> ";
            while(list($ik,$iv)=each($show_image_list)){
                if ($ik>0){$image_query['inum']=$ik;}
                else {$image_query['inum']="-";}
                $ik_plus=$ik+1;

                if ($ik==intval($_GET['inum'])){
                    $img_num_link[]="<font color=red>".$ik_plus."</font>"; 
                } else {$img_num_link[]="<a href='".UrlQuery($image_query)."'>".$ik_plus."</a>";}
                
            }
            echo implode("|",$img_num_link);
            echo "   *дата размещения фото на сайте: ";
            echo date ("d/m/y", filemtime($pics_root.$img_path));
            echo " </span>";
        }

    } elseif (file_exists($pics_root.$preview_path)){
        echo "<img src='/".$link_root.$preview_path."' border='0' ".$place_param." title='".$alt_txt."' alt='".$alt_txt."'>";
    } elseif (isset($_SESSION['ip']) AND $_SESSION['ip']=="213.87.104.7") {
        echo "\n??".$link_root.$preview_path."<br>\n??".$pics_root.$img_path;
    } else {
        echo "нет фото";
    }

}

?>
