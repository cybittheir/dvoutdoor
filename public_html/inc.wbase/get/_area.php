<?php

$areas_q="SELECT * FROM AREA ORDER BY AREA";

$areas=mysqli_query($odb,$areas_q);

while ($row=mysqli_fetch_array($areas)){

    if (!isset($area_list)){

        $area_list="<option value='all'>Везде</option>\n";
        $area_list.="<option value=''>=======</option>\n";

    }

    if (!empty($row['AREA'])) {

        $area_list.="<option value='".$row['AREA']."#".$row['AREA_ID']."'";

        if (isset($_SESSION['area']) AND $_SESSION['area']==$row['AREA']."#".$row['AREA_ID']){$area_list.=" selected";}

        $area_list.=">".$row['AREA']."</option>\n";

        $getting[$row['AREA']]=$row['AREA'];

    }

}

$area_list.="<option value=''>=======</option>\n";

$cities_q="SELECT * FROM CITY ORDER BY CITY";

$cities=mysqli_query($odb,$cities_q);

while ($row=mysqli_fetch_array($cities)){

    if (!isset($area_list)){

        $area_list="<option value='all'>Везде</option>\n";
        $area_list.="<option value=''>=======</option>\n";

    }

    if (!empty(trim($row['CITY']))) {

        if (!isset($getting[$row['CITY']])){

            $area_list.="<option value='".$row['CITY']."#".$row['CITY_ID']."'";

            if (isset($_SESSION['area']) AND $_SESSION['area']==$row['CITY']."#".$row['CITY_ID']){$area_list.=" selected";}

            $area_list.=">".$row['CITY']."</option>\n";

        }

    }

}

unset($getting);

?>