<?php
session_start();
require "inc.php";
require "func/connect.php";
?>

<?php
$idT=$_GET['idT'];
$STH = $DBH->prepare('SELECT priceProd from tovar where idT=:idT');  
$STH->bindParam(':idT', $_GET['idT']);
$STH->execute();
$row=$STH->fetch();
if ($_GET['del']==1)
{
	$_SESSION['cart'][$idT]=$_SESSION['cart'][$idT]-1;
	if ($_SESSION['cart'][$idT]<0)
	{
		$_SESSION['cart'][$idT]=0;
	}
}
if ($_GET['add']==1)
{
	$_SESSION['cart'][$idT]=$_SESSION['cart'][$idT]+1;
}
if ($_GET['new']==1)
{
	$_SESSION['cart'][$idT]=$_GET['kolic'];
}
if ($_GET['delT']==1)
{
	unset($_SESSION['cart'][$idT]);
}
$_SESSION['summa']=0;
foreach ($_SESSION['cart'] as $idT=>$kol)
{
	$STH = $DBH->prepare('SELECT * from tovar where idT=:idT');  
	$STH->bindParam(':idT', $idT);
	$STH->execute();
	$row=$STH->fetch();
	$_SESSION['summa']=$_SESSION['summa']+$row['priceProd']*$kol;
	//echo "<tr>";
	//echo "<th>Имя продукта</th>";
	//echo "<th>Количество</th>";
	//echo "<th>Цена за единицу</th>";
	//echo "<th>Итого за продукт</th>";
	//echo "</tr>";
	//echo "<tr>";
	//echo "<th>&nbsp</th>";
	//echo "<th></th>";
	//echo "<th></th>";
	//echo "<th></th>";
	//echo "</tr>";
	echo "<tr>";
	echo "<td>".$row['nazT']."</td><td><input type='button' value='+' class='kol' onclick='addkol(".$row['idT'].");return false'>";
	echo "<input name='kol' onkeypress='newKol(".$row['idT'].")' id='kol".$row['idT']."' style='width:25pt' 
	value=".$_SESSION['cart'][$row['idT']].">";
	echo "<input type='button' value='-' class='kol' onclick='delkol(".$row['idT'].");return false'></td>
	<td>".$row['priceProd']."<span class='rub'>Р</span></td>";
	echo "<td id='itog-tovar'>".$row['priceProd']*$_SESSION['cart'][$row['idT']]."<span class='rub'>Р</span></td>";
	echo "<td><input type='button' value='X' onclick=delT(".$row['idT'].")></td>";
	echo "<tr>";
	echo "<th>&nbsp</th>";
	echo "<th></th>";
	echo "<th></th>";
	echo "<th></th>";
	echo "</tr>";
	echo "</tr>";
	
}
echo "<tr class='itogo'>";
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
?>
