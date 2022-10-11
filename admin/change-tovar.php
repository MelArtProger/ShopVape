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
$STH = $DBH->prepare('SELECT * from tovar where idT=?'); 
$STH->execute(array($idT));
$tovars=$STH->fetch();

if (isset($_POST['change']))
{
	if (isset($_FILES['photoT']['tmp_name']) && $_FILES['photoT']['tmp_name']!=$tovars['PhotoT'])
	{
		@unlink("../PhotoT/".$tovars['photoT']);
		$photoT=$_FILES['photoT']['name'];
		
		move_uploaded_file($_FILES['photoT']['tmp_name'],"../PhotoT/".$photoT);
	}
	else
	$photoT=$tovars['photoT'];
	$data=array (
	'idT'=>$idT,
	'idK'=>$_POST['idK'],
	'nazT'=>$_POST['nazT'],
	'datPost'=>$_POST['datPost'],
	'priceProd'=>$_POST['priceProd'],
	'opisanie'=>$_POST['opisanie'],
	'photoT'=>$photoT
	);
	
$STH = $DBH->prepare("update tovar set 
idK=:idK,nazT=:nazT,datPost=:datPost,priceProd=:priceProd,opisanie=:opisanie,photoT=:photoT where idT=:idT");  
$STH->execute($data);
if ($STH->rowCount()>0)
	echo "<h2>Товар изменен!</h2>";
}
$STH = $DBH->prepare('SELECT * from tovar where idT=?'); 
$STH->execute(array($idT));
$tovars=$STH->fetch();
?>

<table>
<form action='change-tovar.php?idT=<?php echo $tovars['idT'];?>' method='post' ENCTYPE='multipart/form-data'>
<tr><td>Название</td><td><input name='nazT' value= <?php echo $tovars['nazT'];?> ></td></tr>
<tr><td>Категория</td><td><select name='idK'>

<?php
	$STH = $DBH->query('SELECT * from kategory'); 
	$row=$STH->fetchAll();
	foreach($row as $row1)
	{
		if ($tovars['idK']==$row1['idK'])
		echo "<option value=".$row1['idK']." selected>".$row1['nazK'];
		else
		echo "<option value=".$row1['idK'].">".$row1['nazK'];
	}
?>
</select></td></tr>
<tr><td>Описание</td><td><textarea name='opisanie'><?php echo $tovars['opisanie'];?> </textarea></td></tr>
<tr><td>Дата поставки</td><td><input name='datPost' value= <?php echo $tovars['datPost'];?> ></td></tr>
<tr><td>Цена</td><td><input name='priceProd' value= <?php echo $tovars['priceProd'];?> ></td></tr>
<tr><td>Фото</td><td><img src='../PhotoT/<?php echo $tovars['photoT'];?>'><input type=file name='photoT'></td></tr>
<tr><td cowspan=2><input type='submit' value='Создать' name='change'></td>
</tr>
</form>
</table>
<?php
}
require "struct/footer.php";
?>