<?php

$unit_pc_q="SELECT * FROM _units_pc WHERE id_pc='".$pc_id."'";

if ($unit_pc=dbQuery($unit_pc_q,'mf')){

    while ($pc = mysqli_fetch_array($unit_pc)) {

        $model=$pc['model_pc'];

        $power=$pc['power_pc'];

        $mac1=$pc['MAC1'];

        $mac2=$pc['MAC2'];

        $anydesk=$pc['anydesk'];

        $info=$pc['memo_pc'];

    }
}

?>