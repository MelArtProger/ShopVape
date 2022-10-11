<?php
require "inc.php";
require "func/connect.php";
$idK=$_GET['idK'];
$STH=$DBH->prepare("select idT from tovar where idK=?");
$row=$STH->execute(array($idK));
if ($STH->rowCount()>0)
{
	echo "Удаление невозможно!";
}
else
{
$STH=$DBH->prepare('delete from kategory where idK=?');
$STH->execute(array($idK));
}
$STH = $DBH->query('SELECT * from kategory'); 
$row=$STH->fetchAll();
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th>Категория</th><th>Изменить</th></tr>";
foreach ($row as $row1)
{
	echo "<tr><td>".$row1['nazK']."</td><td><input required placeholder='Введите название категории' id='newKat".$row1['idK']."'>
	<button onclick=change(".$row1['idK'].")>Изменить</button>
	<button onclick=delet(".$row1['idK'].")>Удалить</button></td></tr>";
}
echo "</table>";
?>