<?php

include_once ($comm_path."/_prestart.php");

# include ($comm_path."/show_err.php");

# include_once($comm_path."/functions.php"); # функции авторизации и т.п.
 include_once ($lib_path."/func_doc.php");   # общие функции обработки переменных
# include_once($comm_path."/config.php"); # загрузка конфигурации
 include_once ($lib_path."/func_query.php");
 include_once ($lib_path."/func_calend.php");
 include_once ($lib_path."/func_db.php");   # общие функции обработки запросов к БД
# include_once ($tb_path."_tgbot/tbLib.php");   # общие функции обработки запросов к БД

if (isset($tb_path)){
	 include_once ($tb_path."_tgbot/tbDatabase.php");   # общие функции обработки запросов к БД
}

# include_once($comm_path."/db.php"); # подключение к основной базе данных

# if (file_exists($inc_path."/db.php")) {include_once($inc_path."/db.php");} # подключение базы данных раздела

# if (!isset($_GET['session'])){include_once($comm_path."/_auth.php");}

?>