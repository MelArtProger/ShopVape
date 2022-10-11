<?php
session_start();
require "inc.php";
require "func/connect.php";
require "struct/header.php";
?>

<section>
	<div>
		<div class="center wow fadeInDown">
			<h2>
				<?php
				$STH1 = $DBH->prepare('SELECT * from tovar where idT=?');  
				$STH1->execute(array($_GET['idT']));
				$row=$STH1->fetch();
				echo $row['nazT'];
				?>
			</h2> 
		</div>	
	</div>
</section>

<?php
$STH = $DBH->prepare('SELECT * from tovar where idT=:idT');  
$STH->bindParam(':idT', $_GET['idT']);
$STH->execute();
$row=$STH->fetch();
echo "<br>";
echo "<br>";
echo "<div class='col-md-3' align='center'><table class='row-tovar' cellpadding='30' cellspacing='10'><tr><td><img id='target' class='photo' src='PhotoT/".$row['photoT']."'  style='width:250px; height:250px'><h2><div align='center' style='width:250px; height:75px'>";
echo "<p><div style='width:250px; height:25px;'><br>Цена: ".$row['priceProd']."<span class='rub'>Р</span></h3></td></tr></table></div>";
echo "<div class='col-md-3' align='center'><h2><ins>Описание:</ins><br><br>".$row['opisanie']."</h2><br></div></div></div>";
echo "<div class='btn-cart' ><button id='fly' class='button add-to-cart' type='button' align='center' onclick='javascript:toCart()' style='margin-bottom:40%'>Добавить  <span style='cursor:pointer'><i class='fa fa-shopping-cart'></i></button></span></div>";
require "struct/footer.php ";
?> 		

<script type="text/javascript">
    $(document).ready(function () {
    $("#fly").click(function () {
    var target = $("#target");
    var pos = target.position();
	var clone = target.clone()
	.css({ position: 'absolute', 'z-index': '1000', top: pos.top, left: pos.left })
	.appendTo("table")
	.animate({top: -420, left:1330, opacity: 0.05 , width: 50, height: 50}, 1500, function() { 
	clone.remove(); 
	});
    });
    });
</script>