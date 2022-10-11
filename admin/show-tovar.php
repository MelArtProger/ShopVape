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
$idT=$_GET['idT'];
if (isset($_POST['delT']))
{
	$STH=$DBH->prepare("select idT from zakaztovar where idT=?");
	$row=$STH->execute(array($idT));
	if ($STH->rowCount()>0)
	{
		echo "Удаление невозможно!";
	}
	else
	{
		$STH=$DBH->prepare('select photoT from tovar where idT=?');
		$STH->execute(array($idT));
		$tovars=$STH->fetch();
		echo "ddd=".$tovars['photoT'];
		@unlink("../PhotoT/".$tovars['photoT']);
		$STH=$DBH->prepare('delete from tovar where idT=?');
		$STH->execute(array($idT));
		?>
		<script>
		document.location='tovar.php'
		</script>
		<?php
	}
}
$STH = $DBH->prepare('SELECT * from tovar where idT=:idT');  
$STH->bindParam(':idT', $_GET['idT']);
$STH->execute();
$row=$STH->fetch();
	echo "<div class='tovar'><img class='photo' src='../PhotoT/".$row['photoT']."'><p>".$row['nazT'];
	echo "<p>Цена: ".$row['priceProd'];
	echo "<p>".$row['opisanie']."</div>";
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th><form action='change-tovar.php?idT=".$row['idT']."' method='post'><input type='submit' value='Изменить' name='changeT'></form></th>
	  <th><form action='show-tovar.php?idT=".$row['idT']."' method='post'><input type='submit' value='Удалить' name='delT'></form></th></tr>";
}
require "struct/footer.php";
?>