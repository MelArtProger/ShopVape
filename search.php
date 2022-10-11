<?php
session_start();
require "inc.php";
require "func/connect.php";
require "struct/header.php";
?>

<section>
	<div class="center wow fadeInDown">
		<h2>По вашему запросу найдено</h2> 
	</div>	
</section>	


<?php
$connect=mysqli_connect('localhost','root','','shop');
if (!connect)
{
exit('MySQL Error:' .mysqli_error($connect));
}
$word=(isset($_GET['word']))?$_GET['word']:null;
$word=mysqli_real_escape_string($connect, trim($word));

if (empty($word))
{
	echo "<h2 align='center'>Не введено слово!</h2>";
}
else if (iconv_strlen($word, 'utf-8')<3)
{
	echo "<h2 align='center'>Слово не может быть менее трёх символов!</h2>";
}
else if (iconv_strlen($word, 'utf-8')>20)
{    
	echo "<h2 align='center'>Слово не может быть более двадцати символов!</h2>";
} 
else
{     
$test="%".$word."%";
$STH=$DBH->prepare("select * FROM tovar WHERE nazT LIKE ?");
$STH->execute(array($test));
$row=$STH->fetchAll(PDO::FETCH_ASSOC);
if ($STH->rowCount()==0) 
{        
	echo "<h2 align='center'>Ошибка базы данных!</h2>"; 
}     
else 
{
foreach ($row as $row1)	
	{             
	echo "<div class='col-md-3' align='center'><table class='row-tovar' cellpadding='30' cellspacing='10'><tr><th><a href='show-tovar.php?idT=".$row1['idT']."'>
	<img src='PhotoT/".$row1['photoT']."' style='width:250px; height:250px'><br><div align='center' style='width:250px; height:75px'><h3>".$row1['nazT']."</a>
	<br><div style='width:250px; height:25px;'><p>Цена: ".$row1['priceProd']."<span class='rub'>Р</span></div></div></h3></th></tr></table></div></h3>"; 
	}   
}           
}
?>
<div class='container' align='center' style='margin-top:10%'>
	<div class='footer-text'>
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
	</div>
</div>

<?php
require "struct/footer.php";
?>