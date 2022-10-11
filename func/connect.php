<?php
  $DBH = new PDO("mysql:host=$host;dbname=$db", $user, $pwd); 
$DBH->query("SET NAMES utf8");   
?>
