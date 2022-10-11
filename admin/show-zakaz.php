<?php
session_start();
?>
<link type='text/css' href='css/bootstrap.min.css' rel='stylesheet' media='screen'>
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/admin.css">

<?php
require "inc.php";
require "func/connect.php";
if (!isset($_SESSION['admin']))
{
	require "struct/checkAdmin.php";
}
else
{
require "struct/header.php";
?>

<script src="js/jquery-2.0.2.min.js"></script>

<?php
if (isset($_POST['change-status']))
{
	if ($_POST['statusZ']=='on')
	{
		$STH=$DBH->prepare('update zakaz set statusZ=1 where idZ=?');
		$STH->execute(array($_GET['idZ']));
		
	}
}
$a=array($_GET['idZ']);
$STH = $DBH->prepare('SELECT * from zakaz where idZ=?'); 
$STH->execute($a);
$row=$STH->fetch();
echo "<p><b>Клиент: </b>".$row['loginU'];
echo "<p><b>Дата Заказа: </b>".$row['datZ'];
echo "<p><b>Дата доставки: </b>".$row['datPost'];
echo "<p><b>Адрес: </b>".$row['addrDost'];
echo "<p><b>Телефон: </b>".$row['phoneDost'];
$STH = $DBH->prepare('SELECT * from zakaz,tovar,zakaztovar where zakaz.idZ=zakaztovar.idZ and tovar.idT=zakaztovar.idT and zakaztovar.idZ=?'); 
$STH->execute($a);
$row1=$STH->fetchAll();
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th>Товар</th><th>Количество</th><th>Цена</th></tr>";
foreach ($row1 as $row)
{
	echo "<tr><td>".$row['nazT']."</td><td>".$row['kolvo']."</td><td>".$row['pricePok']."</td></tr>";
}
echo "</table>";
echo "<form action='show-zakaz.php?idZ=".$row['idZ']."' method='post'>";
if ($row['statusZ']==1)
echo "<input type='checkbox' name='statusZ' checked disabled>Выполнен";
else
echo "<input type='checkbox' name='statusZ'>Выполнен";
echo "<input type='submit' class='button' name='change-status' value='Изменить'></form>";
require "struct/footer.php";	
}
?>