<?php
require "inc.php";
require "func/connect.php";
$idK=$_GET['idK'];
$newKat=$_GET['newKat'];
$STH=$DBH->prepare('update kategory set nazK=? where idK=?');
$STH->execute(array($newKat,$idK));
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