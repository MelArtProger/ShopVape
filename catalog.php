<?php
session_start();
require "inc.php";
require "func/connect.php";
?>

<head>
    <meta charset="utf-8">
    <title>
		<?php
		$STH1 = $DBH->prepare('SELECT * from menu where idM=?');  
		$STH1->execute(array($_GET['idM']));
		$row=$STH1->fetch();
		echo $row['nazM'].'|Darth Vapor Shop';
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
				$STH1 = $DBH->prepare('SELECT * from menu where idM=?');  
				$STH1->execute(array($_GET['idM']));
				$row=$STH1->fetch();
				echo $row['nazM'];
				?>
			</h2> 
		</div>	
	</div>
</section>

<body>
<?php
$STH = $DBH->prepare('SELECT * from tovar,kategory where tovar.idK=kategory.idK and idM=?');  
$STH->execute(array($_GET['idM']));
$row=$STH->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $row1)
echo "<div class='col-md-3' align='center'><table class='row-tovar' cellpadding='30' cellspacing='10'><tr><th><a href='show-tovar.php?idT=".$row1['idT']."'>
<img src='PhotoT/".$row1['photoT']."' style='width:250px; height:250px'><br><div align='center' style='width:250px; height:75px'><h3>".$row1['nazT']."</a>
<br><div style='width:250px; height:25px;'><p>Цена: ".$row1['priceProd']."<span class='rub'>Р</span></div></div></h3></th></tr></table></div></h3>";
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
$file = fopen("txt/jija.txt", "r");
?>
	</div>
</div>

<?php
require "struct/footer.php";
?>
</body>