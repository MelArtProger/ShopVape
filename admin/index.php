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
	 if ($_POST['logIn'])
  {
	$STH = $DBH->prepare('SELECT * from user where loginU=:login and passwd=:passwd');  
	$STH->bindParam(':login', $_POST['login']);
	$STH->bindParam(':passwd', $_POST['passwd']);
	$f=$STH->execute();
	$row=$STH->fetch();
	if ($row['loginU'] && $row['status']==1)
	{
		$_SESSION['admin']=$row['loginU'];
		?>
		<script>
		document.location="index.php"
		</script>
		<?php
	}
	else
	{
		?>
	<script language="javascript">
		alert("Ошибка!")
	</script>
	<div id="form-auth">
		<form action="" method="post">
			<input name="login" placeholder="Логин" class="form-control input-lg" style="margin-top:20px">
			<p><input name="passwd" placeholder="Пароль" class="form-control input-lg"  style="margin-top:20px">
			<input type="submit" name="logIn" value="LogIn" class="btn btn-success"  style="margin-top:20px">
		</form>
	</div>
	<?php
	}
	}
	else{
	?>
	<div id="form-auth">
		<form action="" method="post">
			<input name="login" placeholder="Логин" class="form-control input-lg" style="margin-top:20px">
			<p><input name="passwd" type="password" placeholder="Пароль" class="form-control input-lg"  style="margin-top:20px">
			<input type="submit" name="logIn" value="LogIn" class="btn btn-success"  style="margin-top:20px">
		</form>
	</div>
<?php
}
}
else
{
require "struct/header.php";
?>
<script src="js/jquery-2.0.2.min.js"></script>
<?php
$STH = $DBH->query('SELECT * from zakaz where statusZ=0'); 
$row=$STH->fetchAll();
if ($STH->rowCount()>0)
{
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th>Клиент</th><th>Дата Заказа</th><th>Дата доставки</th></tr>";
foreach($row as $row1)
{
	if (empty($row1['loginU']))
	{
		echo "<tr><td><a href='show-zakaz.php?idZ=".$row1['idZ']."'>".$row1['famU']."</a></td>";
	}
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