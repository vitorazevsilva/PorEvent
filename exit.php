<?php ob_start(); if (session_id() =='')session_start(); session_destroy();
if(isset($_GET['url']) && $_GET['url']!="/myfav.php")
header('Location:'.$_GET['url']);
else 
header('Location:/'); ?>
