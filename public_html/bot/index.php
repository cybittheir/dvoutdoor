<?php

/*
foreach($_SERVER as $key => $value) {
    echo "key=".$key."<br>";
    echo "val=".$value."<br>";
}
*/

if ($_SERVER['HTTP_HOST']=="botapi.dvoutdoor.ru"){
    
echo "Hello, BOT";

} else {
    
    echo "WRONG WAY";
}

?>