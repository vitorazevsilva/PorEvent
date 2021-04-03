<?php
include 'mysql_connect.php';
include 'Logic.php';

ob_start();
if (session_id() =='')session_start();?>