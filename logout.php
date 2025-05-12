<?php

include 'connect.php';


session_start();
$_SESSION['user_id'] ="";
$_SESSION['username'] = "";
session_unset();
session_destroy();

header('location:index.php');
exit();
?>