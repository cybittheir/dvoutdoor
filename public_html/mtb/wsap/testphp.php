<?php


$tg_query=file_get_contents("https://script.google.com/macros/s/AKfycbzqeXiJL80Q02z-e31lhWMHvtD0oComztQJsVq8VzXXeVQzmn6wGx4smFonETMp0ISh/exec");

echo "Result of 'file_get_contents(&quot;https://script.google.com/macros/s/AKfycbzqeXiJL80Q02z-e31lhWMHvtD0oComztQJsVq8VzXXeVQzmn6wGx4smFonETMp0ISh/exec&quot;)' = ".$tg_query;


?>