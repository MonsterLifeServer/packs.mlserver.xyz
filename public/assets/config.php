<?php 

$path = "/home/users/2/main.jp-mls/web/www.mlserver.xyz/assets/config.php";
if (strpos($_SERVER["HTTP_HOST"], "localhost")) {
    $path = "C:/newMLServerWeb/htdocs/main/public/assets/config.php";
}
include($path); 

?>