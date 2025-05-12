<?php
$db_name= "lashme_db";
$db_con = 'mysql:host=localhost;dbname='.$db_name;
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_con, $user_name, $user_password);

?>