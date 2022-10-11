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
<table>
<form action='' method='post' ENCTYPE='multipart/form-data'>
<tr><td>Название</td><td><input required name='nazT'></td></tr>
<tr><td>Категория</td><td><select name='idK'>
<?php
	$STH = $DBH->query('SELECT * from kategory'); 
	$row=$STH->fetchAll();
	foreach($row as $row1)
	{
		echo "<option value=".$row1['idK'].">".$row1['nazK'];
	}
?>
</select></td></tr>
<tr><td>Описание</td><td><textarea required name='opisanie'></textarea></td></tr>
<tr><td>Дата поставки</td><td><input required name='datPost'></td></tr>
<tr><td>Цена</td><td><input required name='priceDost'></td></tr>
<tr><td>Фото</td><td><input required  type=file name='photoT'></td></tr>
<tr><td cowspan=2><input type='submit' class='button' value='Создать' name='create'></td>
</tr>
</form>
</table>
<?php
if (isset($_POST['create']))
{
	$photoT=$_FILES['photoT']['name'];
	$data=array (
	'idK'=>$_POST['idK'],
	'nazT'=>$_POST['nazT'],
	'datPost'=>$_POST['datPost'],
	'priceDost'=>$_POST['priceDost'],
	'opisanie'=>$_POST['opisanie'],
	'photoT'=>$photoT
	);
	move_uploaded_file($_FILES['photoT']['tmp_name'],"../PhotoT/".$photoT);
$STH = $DBH->prepare("insert into tovar (idK,nazT,datPost,priceProd,opisanie,photoT) 
					values (:idK,:nazT,:datPost,:priceDost,:opisanie,:photoT)"); 
$STH->execute($data);
if ($STH->rowCount()>0)
	echo "<h2>Товар добавлен!</h2>";
}
}
require "struct/footer.php";
?>