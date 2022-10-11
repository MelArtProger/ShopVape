<?php
require "inc.php";
require "func/connect.php";
$idM=$_GET['idM'];
$newMenu=$_GET['newMenu'];
$STH=$DBH->prepare('update menu set nazM=? where idM=?');
$STH->execute(array($newMenu,$idM));
$STH = $DBH->query('SELECT * from menu'); 
$row=$STH->fetchAll();
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th>Меню</th><th>Изменить</th></tr>";
foreach ($row as $row1)
{
	echo "<tr><td>".$row1['nazM']."</td><td><input required placeholder='Введите название меню' id='newMenu".$row1['idM']."'>
	<button onclick=change(".$row1['idM'].")>Изменить</button>
	<button onclick=delet(".$row1['idM'].")>Удалить</button></td></tr>";
}
echo "</table>";
?>