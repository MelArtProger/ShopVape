<?php
session_start();
require "inc.php";
require "func/connect.php";
$idT=$_GET['idT'];
if (!isset($_SESSION['summa']))
	$_SESSION['summa']=0;
if (isset($_SESSION['cart'][$idT]))
	$_SESSION['cart'][$idT]=$_SESSION['cart'][$idT]+1;
else 
{
	$_SESSION['cart'][$idT]=$_GET['idT'];
	$_SESSION['cart'][$idT]=1;
}
$STH = $DBH->prepare('SELECT priceProd from tovar where idT=:idT');  
$STH->bindParam(':idT', $_GET['idT']);
$STH->execute();
$row=$STH->fetch();
$_SESSION['summa']=$_SESSION['summa']+$row['priceProd'];
echo $_SESSION['summa'];
?>
