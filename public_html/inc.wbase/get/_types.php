<?php

$ctypes_q="SELECT * FROM CTYPES ORDER BY NAME";

$ctypes=mysqli_query($odb,$ctypes_q);

while ($row=mysqli_fetch_array($ctypes)){

    if (!isset($type_list)){

        $type_list="<option value='all'>Все конструкции</option>\n";
        $type_list.="<option value=''>=======</option>\n";
        $type_list.="<option value='digital'";
        if (isset($_SESSION['ctype']) AND $_SESSION['ctype']=='digital'){$type_list.=" selected";}
        $type_list.=">Медиа-экраны</option>\n";
        $type_list.="<option value=''>=======</option>\n";
    }

    if(!empty($row['NAME']) AND empty($row['skip'])) {
        
        $type_list.="<option value='".$row['ID']."'";

        if (isset($_SESSION['ctype']) AND $_SESSION['ctype']==$row['NAME']){$type_list.=" selected";}

        $type_list.=">".$row['NAME']."</option>\n";

    }

}


?>