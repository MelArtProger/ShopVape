<?php
session_start();
?>

<script>
function change(i)
{
	var url="change-kat.php?idK="+i+"&&newKat="+document.getElementById('newKat'+i).value;
	request.onreadystatechange=stateChanged 
	request.open("GET",url,true)
	request.send(null)
}

 function delet(i)
{
	var url="del-kat.php?idK="+i;
	request.onreadystatechange=stateChanged 
	request.open("GET",url,true)
	request.send(null)
	
 }
 
function stateChanged() 
{ 
if (request.readyState==4 || request.readyState=="complete")
{ 
document.getElementById("table-kat").innerHTML=request.responseText
} 
}
</script>

<?php
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
<script src="js/jquery-2.0.2.min.js"></script>
<table class='table-zakaz'>
<tr>
<td>
<form action='' method='post'>
<input required name='text-s' placeholder="Search">
<input type='submit' class='button' name='search' value='Искать'>
</form>
</td>
<td>
<form action='' method='post'>
<input required name='createKat' placeholder="Название категории">
<select name='idM'>
<option value=0>
<?php

	$STH = $DBH->query('SELECT * from menu'); 
	$row=$STH->fetchAll();
	foreach($row as $row1)
	{
		echo "<option value=".$row1['idM'].">".$row1['nazM'];
	}
	
?>
</select>
<input type='submit' class='button' name='createK' value='Добавить'>
</form>
</td>
</tr>
</table>
<?php
if (isset($_POST['createK']))
{
	$STH=$DBH->prepare("insert into kategory values('',?,?)");
	$STH->execute(array($_POST['createKat'],$_POST['idM']));
}
if (isset($_POST['search']))
{
	$nam="%".$_POST['text-s']."%";
	$STH=$DBH->prepare("SELECT * FROM kategory WHERE nazK LIKE ?");
	$STH->execute(array($nam));
	$row=$STH->fetchAll();
}
else
{
	$STH = $DBH->query('SELECT * from kategory'); 
	$row=$STH->fetchAll();
}
echo "<span id='table-kat'>";
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th>Категория</th><th>Изменить</th></tr>";
foreach ($row as $row1)
{
	echo "<tr><td>".$row1['nazK']."</td><td><input required placeholder='Введите название категории' id='newKat".$row1['idK']."'>
	<button onclick=change(".$row1['idK'].")>Изменить</button>
	<button onclick=delet(".$row1['idK'].")>Удалить</button></td></tr>";
}
echo "</table>";
echo "</span>";
require "struct/footer.php";	
}
?>