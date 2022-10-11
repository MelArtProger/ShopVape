<?php
session_start();
require "inc.php";
require "func/connect.php";
?>

<head>
    <meta charset="utf-8">
    <title>Тележка|Darth Vapor Shop</title>
</head>

<?php
require "struct/header.php";
?>

<script>
function addkol(i)
{
	var url="kol-cart.php?idT="+i+"&&add=1";
	request.onreadystatechange=stateChanged 
	request.open("GET",url,true)
	request.send(null)
	
}

 function delkol(i)
{
	var url="kol-cart.php?idT="+i+"&&del=1";
	request.onreadystatechange=stateChanged 
	request.open("GET",url,true)
	request.send(null)
	
 }

  function newKol(i)
{
	k=parseInt(document.getElementById('kol'+i).value+String.fromCharCode(event.keyCode))
	if (isNaN(k)) k=0;
	var url="kol-cart.php?idT="+i+"&&kolic="+k+"&&new=1";
	request.onreadystatechange=stateChanged
	request.open("GET",url,true)
	request.send(null)
	
 }
 
 function delT(i)
{
	var url="kol-cart.php?idT="+i+"&&delT=1";
	request.onreadystatechange=stateChanged 
	request.open("GET",url,true)
	request.send(null)
	
 }
 
function stateChanged() 
{ 
if (request.readyState==4 || request.readyState=="complete")
{ 
document.getElementById("table-cart").innerHTML=request.responseText
t=document.getElementById("summ").innerHTML
change_summ(t)
} 
}
 
function change_summ(t)
{
		document.getElementById("summCart").innerHTML=t+""
}

function endZakaz()
{
	location.href="setZakaz.php";
}
</script>

<section>
	<div class="center wow fadeInDown">
		<h2>Тележка</h2> 
	</div>	
</section>	

<?php
if ($_SESSION['summa']!=0)
{
echo "<table id='table-cart' class='container'>";
foreach ($_SESSION['cart'] as $idT=>$kol)
{
	$STH = $DBH->prepare('SELECT * from tovar where idT=:idT');  
	$STH->bindParam(':idT', $idT);
	$STH->execute();
	$row=$STH->fetch();
	echo "<tr>";
	echo "<td>".$row['nazT']."</td><td><input type='button' value='+' class='kol' onclick='addkol(".$row['idT'].");return false'>";
	echo "<input name='kol' onkeypress='newKol(".$row['idT'].")' id='kol".$idT."' style='width:25pt' value=".$_SESSION['cart'][$row['idT']].">";
	echo "<input type='button' value='-' class='kol' onclick='delkol(".$row['idT'].");return false'></td><td>".$row['priceProd']."<span class='rub'>Р</span></td>";
	echo "<td id='itog-tovar'>".$row['priceProd']*$_SESSION['cart'][$row['idT']]."<span class='rub'>Р</span></td>";
	echo "<td><input type='button' value='X' onclick=delT(".$row['idT'].")></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>&nbsp</th>";
	echo "<th></th>";
	echo "<th></th>";
	echo "<th></th>";
	echo "</tr>";
}
echo "<tr>";
echo "<th>&nbsp</th>";
echo "<th></th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";
echo "<tr>";
echo "<th></th>";
echo "<th></th>";
echo "<th>Итого:</th><th id='summ' colspan=4>".$_SESSION['summa']."<span class='rub'>Р</span></th>";
echo "</table>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<div class='button-actions clearfix' align='center'><button class='button add-to-cart' type='button' align='center' onclick='endZakaz()'>Оформить <span><i class='fa fa-shopping-cart'></i></span></button></div>";
}
else
{
	unset($_SESSION['cart']);
	echo "<span class='errorCart'><h2 align='center'>Ваша тележка пуста!</h2></span>";
}
?>

<div class='footer-text'>
<div class='container' align='center'>
<br>
<br>
<br>
<br>
<br>
<h2>
Бесплатая доставка по Нижнему Новгороду
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

<?php
require "struct/footer.php";
?>	

    <!-- scrollUp JS-->		
<script src="js/scrollUp/jquery.scrollUp.min.js"></script>
<script src="js/scrollUp/jquery.scrollUp.min.js"></script>
<script src="js/scrollUp/jquery.meanmenu.js"></script>	
<script src="js/scrollUp/owl.carousel.min.js"></script>
<script src="js/scrollUp/jquery-price-slider.js"></script>		
<script src="js/scrollUp/main.js"></script>