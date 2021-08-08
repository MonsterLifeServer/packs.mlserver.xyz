<?php 

$path = "/home/users/2/main.jp-mls/web/www.mlserver.xyz/assets/include/footer.php";
if (str_pos($_SERVER["HTTP_HOST"], "localhost")) {
    $path = "C:/newMLServerWeb/htdocs/main/public/assets/include/footer.php";
}
include($path); 

?>