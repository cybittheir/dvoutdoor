<?php

/*

parent: inc.common/_index.php;

*/

$check_auth="";
global $LogInOut;

$auth_help="Если вы не помните/не знаете пароль, то нужно зайти в <a href=/person/>Справочник</a>, найти и кликнуть по своему имени. В появившемся окошке найти слово Авторизация, после клика по которому появится другое окошко с информацией о том, что вам будет отправлено сообщение. Сообщение отправляется на тот адрес, который указан в Справочнике. В письме прийдет ссылка, которая возвратит вас на сайт уже авторизованным и предложит меню, где одним из пунктов будет редактировать профиль. Заходите туда, и в самом низу будет поле для ввода нового пароля. Сохраняете его и запоминаете на будущее. Если не запоминаете, то проходите эту процедуру каждый раз при необходимости внести изменения.";

$auth_help_alt=strip_tags($auth_help);

if(isset($_POST["submit"])) {

    $check_auth="on";
	field_validator("Логин", $_POST["login"], "string", 4, 30);
	field_validator("Пароль", $_POST["password"], "string", 4, 30);
    
	if(!$messages AND !($row = checkPass($_POST["login"], $_POST["password"],"","","","")) ) {
		$messages[]="Неверное сочетание логин/пароль, попробуйте еще раз";
		$messages[]="";
		$messages[]=$auth_help;
	}
    
} elseif (isset($_GET['code']) AND $_GET['code']!="CREATE" AND isset($_GET['id'])){

    $check_auth="on";
	field_validator("ID", $_GET["id"], "string", 0, 30);
	field_validator("CODE", $_GET["code"], "string", 4, 30);
    
	if(!$messages AND !($row = checkPass("","","",$_GET['id'],$_GET['code'],$live)) ) {
		$messages[]="Неверный или просроченный код, попробуйте еще раз";
		$re_code=1;
	}
    
}

if($check_auth=="on" AND !$messages) {
	cleanMemberSession($row["login"], $row["e_mail"], $row["password"], $row["uid"], $row["level"]);
}

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true ){

    $SessLogged="OK";
	
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {$MoreOptions=true;} 
	else {$MoreOptions=false;}

} else {

    $SessLogged="fail";
	$MoreOptions=false;

    $LogInOutForm[]='<form action='.$_SERVER["REQUEST_URI"].' method="POST">
    <font size=-1><a href="http://cs.adlab.ru/faq/?faq=12#206" alt="'.$auth_help_alt.'" title="'.$auth_help_alt.'"><font color=grey><b>?</b></font></a> <input type="text" class="input1" background-color="black" name="login" value="';

    $LogInOutForm[]=isset($_POST['login']) ? $_POST['login'] : '';

    $LogInOutForm[]='" maxlength="30">&nbsp;<input type="password" class="input1" name="password" value="" maxlength="30">&nbsp;<input class="input2" name="submit" type="submit" value="Войти"></font>
    </form>';
    
    $LogInOut=implode("",$LogInOutForm);

}

?>
