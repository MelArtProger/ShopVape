<?php
session_start();
?>

<script>
 function delet(i)
{
	var url="del-tov.php?idK="+i;
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
<script src="../js/jquery-2.0.2.min.js"></script>
<form action='' method='post'>
<select name='idK'>
<option value=0>
<?php
	$STH = $DBH->query('SELECT * from kategory'); 
	$row=$STH->fetchAll();
	foreach($row as $row1)
	{
		echo "<option value=".$row1['idK'].">".$row1['nazK'];
	}
?>

</select>
<input type='submit' class='button' name='search' value='Искать'>
</form>

<?php
echo "<form action='create-tovar.php' method='post'><input type='submit' class='button' value='Создать' name='createT'></form>";
if (isset($_POST['search']))
{
	$nam="%".$_POST['text-s']."%";
	if ($_POST['idK']>0 && !isset($_POST['text-s']))
		{
			$STH=$DBH->prepare("SELECT * FROM tovar WHERE idK=?");
			$STH->execute(array($_POST['idK']));
		}
	if ($_POST['idK']==0 && isset($_POST['text-s']))
		{
			$STH=$DBH->prepare("SELECT * FROM tovar WHERE nazT LIKE ?");
			$STH->execute(array($nam));
		}
	if ($_POST['idK']>0 && isset($_POST['text-s']))
		{
			$STH=$DBH->prepare("SELECT * FROM tovar WHERE nazT LIKE ? and idK=?");
			$STH->execute(array($nam,$_POST['idK']));
		}
	if ($_POST['idK']==0 && !isset($_POST['text-s']))
		{
			$STH = $DBH->query('SELECT * from tovar'); 
		}
	$row=$STH->fetchAll();
}
else
{
	$STH = $DBH->query('SELECT * from tovar'); 
	$row=$STH->fetchAll();
}
echo "<span  id='table-kat'>";
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th>Товар</th></tr>";
foreach ($row as $row1)
{
	echo "<tr><td><a href='show-tovar.php?idT=".$row1['idT']."'>".$row1['nazT']."</a></td></tr>";
}
echo "</table>";
echo "</span>";
require "struct/footer.php";	
}
?>