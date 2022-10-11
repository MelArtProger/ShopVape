<?php
session_start();
require "inc.php";
require "func/connect.php";
?>

<head>
    <meta charset="utf-8">
    <title>Оформление заказа</title>
</head>

<?php
require "struct/header.php";
?>

<?php
	if (!isset($_POST['endZakaz']))
	{
		$STH = $DBH->prepare('SELECT * from user where loginU=:loginU');  
		$STH->bindParam(':loginU', $_SESSION['loginU']);
		$STH->execute();
		$row=$STH->fetch();
		echo "<div id='endZ'>";
		echo "<form action='' method='post' class='container'>";
		echo "<br>";
		echo "<br>";
		echo "<section><div class='container'><div class='center wow fadeInDown'><h2>Заполнить!</h2></div></div></section>";
		if (isset($_SESSION['loginU']))
		{
		echo "<input name='namU' required placeholder='Имя' class='form-control input-lg input-sm' value=".$row['nameU'].">";
		echo "<input name='famU' required placeholder='Фамилия' class='form-control input-lg input-sm' value=".$row['famU'].">";
		}
		else
		{
		echo "<input name='namU' required placeholder='Имя' class='form-control input-lg input-sm'  value=".$row['nameU'].">";
		echo "<input name='famU' required placeholder='Фамилия' class='form-control input-lg input-sm'  value=".$row['famU'].">";
		}
		echo "<input name='phoneDost' required placeholder='Введите номер телефона' class='form-control input-lg input-sm' value=".$row['phone'].">";
		echo "<input name='datPost' readonly class='form-control input-lg input-sm' value=".date("Y-m-d_h:i").">";
		echo "<input name='addrDost' required placeholder='Адрес доставки' class='form-control input-lg input-sm'>";
		echo "<div class='button-actions clearfix' align='center'><input class='button' type='submit' name='endZakaz' value='Оформить' style='margin-top:20px'>";
		echo "</form></div>";
	}
	else
	{
		if (!isset($_SESSION['loginU']))
			$_SESSION['loginU']=$_POST['namU'];
		$data = array('datZ'=>date("Y-m-d"),
					  'loginU' => $_SESSION['loginU'],
				      'addrDost' => $_POST['addrDost'],
					  'phoneDost' => $_POST['phoneDost'],  
				      'statusZ' => 0,
				      'datPost' => $_POST['datPost'],
				      );
	$STH = $DBH->prepare('INSERT INTO zakaz (datZ ,loginU ,addrDost ,phoneDost ,statusZ,datPost) values(:datZ,:loginU,:addrDost,:phoneDost,:statusZ,:datPost)');  
	$f=$STH->execute($data);
	$kod=$DBH->lastInsertId();
	if ($f>0)
	{
		$STH = $DBH->prepare('INSERT INTO zakazTovar (idZ ,idT ,kolvo ,pricePok) values(:idZ,:idT,:kolvo,:pricePok)');  
		foreach ($_SESSION['cart'] as $idT=>$kol)
		{
			$STHP = $DBH->prepare('SELECT * from tovar where idT=?');  
			$STHP->execute(array($idT));
			$row=$STHP->fetch();
			$data=array ('idZ'=>$kod,'idT'=>$idT,'kolvo'=>$kol,'pricePok'=>$row['priceProd']);
			$f=$STH->execute($data);
		}
		unset($_SESSION['cart']);
		unset($_SESSION['summa']);
		echo "<br>";
		echo "<br>";
		echo "<br>";
	echo "<span class='errorCart'><h2 align='center'>Заказ успешно оформлен!</h2>!</span>";
	}
	}
?>

<body>
<div class='footer-text'>
<div class='container' align='center'>
<br>
<br>
<br>
<h2>
Спасибо, что используете наш электронный магазин
</h2>
<br>
<h2>
by Darth Vapor Shop
</h2>
<br>
<br>
<br>
</div>
</div>
</body>		

<?php
require "struct/footer.php";
?>	
