<?php 

$path = "../../www.mlserver.xyz/assets/include/footer.php";
if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {
    $path = "../../../main/public/assets/include/footer.php";
}
include($path); 

?>