<?php
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private");
session_start();
if(@$_SESSION["uname"]){
$_SESSION["uname"] = false;
session_destroy();
}
header("Location: portal_login.php?logout=1");
exit();
?>