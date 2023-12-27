<?php 

/*

parent: inc.common/_index.php;

*/

// имя авторизованного пользователя - в сессию

if (isset($_SESSION['login']) OR isset($_SESSION['email'])){

    $us_q="SELECT user_fname,user_lname,user_id FROM Users WHERE user_id='".$_SESSION['userid']."'";
	$et_uq=mysqli_query($crtdb,$us_q);
    
	if(mysqli_num_rows($et_uq)==1) {
		$uq_row=mysqli_fetch_array($et_uq);
		$_SESSION['uname']=$uq_row['user_fname']." ".$uq_row['user_lname'];
	}

    if (isset($_SESSION['uname']) AND !empty($_SESSION['uname'])){
		$in_menu=$_SESSION['uname'];
	} elseif (isset($_SESSION['email']) AND !empty($_SESSION['email'])){
		$in_menu=$_SESSION['email'];
	} else {
		$in_menu=$_SESSION['login'];
	}
}


?>