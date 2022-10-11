<?php
session_start();
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
$STH = $DBH->query('SELECT * from zakaz'); 
$row=$STH->fetchAll();
if ($STH->rowCount()>0)
{
echo "<table border=1 class='table_zakaz'><tr>";
echo "<th>Клиент</th><th>Дата Заказа</th><th>Дата доставки</th></tr>";
foreach($row as $row1)
{
	echo "<tr><td><a href='show-zakaz.php?idZ=".$row1['idZ']."'>".$row1['loginU']."</a></td>";
	echo "<td>".$row1['datZ']."</td><td>".$row1['datPost']."</td></tr>";
} 
echo "</table>";
}
else 
	echo "Открытых заказов нет!";
require "struct/footer.php";	
}
?>