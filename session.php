<?php
session_start();
if((!isset($_SESSION['nekokann']['neko_name']))){
    header("Location: login.php");
}

if($_SESSION['nekokann']['neko_name'] != "nekokann"){
    header("Location: login.php");
}

?>
