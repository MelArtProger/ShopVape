<?php
require "inc.php";
require "func/connect.php";
$idM=$_GET['idM'];
$STH=$DBH->prepare("select idT from tovar where idM=?");
$row=$STH->execute(array($idM));
if ($STH->rowCount()>0)
{
	echo "Удаление невозможно!";
}
else
{
$STH=$DBH->prepare('delete from menu where idM=?');
$STH->execute(array($idM));
}
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