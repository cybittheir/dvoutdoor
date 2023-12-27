<?php

$unit_q="SELECT * FROM _units WHERE id_unit='".$unit_id."'";

if ($unit=dbQuery($unit_q,'mf')){

    while ($un = mysqli_fetch_array($unit)) {

        $model=$un['model'];

        $power=$un['power'];

        $mac1=$un['MAC'];

        $info=$un['memo'];

        $type=$un['type_id'];

    }
}

?>