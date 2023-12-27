<?php

$lib_path="../../mtb.lib/";

spl_autoload_register(function ($classname){
    
    require_once ($lib_path."classes.$classname.php");

});

// необходимые библиотеки

require_once ($lib_path."func_gen.php");
require_once ($lib_path."func_tg.php");
// require_once ($inc_path."_db.php");

?>