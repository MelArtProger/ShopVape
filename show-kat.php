<?php
session_start();
require "inc.php";
require "func/connect.php";
?>

<head>
    <meta charset="utf-8">
    <title>
		<?php
		$STH1 = $DBH->prepare('SELECT * from kategory where idK=?');  
		$STH1->execute(array($_GET['idK']));
		$row=$STH1->fetch();
		echo $row['nazK'].'|Darth Vapor Shop';
		?>
	</title>
</head>

<?php
require "struct/header.php";
?>

<section>
	<div>
		<div class="center wow fadeInDown">
			<h2>
				<?php
				$STH1 = $DBH->prepare('SELECT * from kategory where idK=?');  
				$STH1->execute(array($_GET['idK']));
				$row=$STH1->fetch();
				echo $row['nazK'];
				?>
			</h2> 
		</div>	
	</div>
</section>

<?php
$STH = $DBH->prepare('SELECT * from tovar where idK=:idK');  
$STH->bindParam(':idK', $_GET['idK']);
$STH->execute();
$row=$STH->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $row1)
echo "<div class='col-md-3' align='center'><table class='row-tovar' cellpadding='30' cellspacing='10'><tr><td><a href='show-tovar.php?idT=".$row1['idT']."'>
<img src='PhotoT/".$row1['photoT']."'style='width:250px; height:250px'><p><div align='center' style='width:250px; height:75px'><h3>".$row1['nazT']."</a>
<div style='width:250px; height:25px;'><p>Цена:".$row1['priceProd']."<span class='rub'>Р</span></div></div></td></tr></table></h3></div>";
?>

<div class='footer-text'>
	<div class='container' align='center'>
<h2>
Электронный магазин
</h2>
<br>
<h2>
by Darth Vapor Shop
</h2>
<br>
<br>
<br>
<?php
$file = fopen("txt/Komplekt.txt", "r");
?>
<?php
$file = fopen("txt/BatarBlock.txt", "r");
?>
<?php
$file = fopen("txt/Mehmods.txt", "r");
?>
<?php
$file = fopen("txt/Drip.txt", "r");
?>
<?php
$file = fopen("txt/Baks.txt", "r");
?>
<?php
$file = fopen("txt/Acum.txt", "r");
?>
<?php
$file = fopen("txt/Ispar.txt", "r");
?>
	</div>
</div>

<?php
require "struct/footer.php";
?>