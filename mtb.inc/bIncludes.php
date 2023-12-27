<?php

spl_autoload_register(function ($classname){
    
    require_once ("../../mtb.lib/classes.$classname.php");

});

// необходимые библиотеки

$lib_path="../../mtb.lib/";

require_once ($lib_path."func_gen.php");
require_once ($lib_path."func_tg.php");
require_once ($inc_path."_db.php");

?>