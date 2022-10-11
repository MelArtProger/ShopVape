<?php
session_start();
?>

<script>
function change(i)
{
	var url="change-menu.php?idM="+i+"&&newMenu="+document.getElementById('newMenu'+i).value;
	request.onreadystatechange=stateChanged 
	request.open("GET",url,true)
	request.send(null)
}

 function delet(i)
{
	var url="del-menu.php?idM="+i;
	request.onreadystatechange=stateChanged 
	request.open("GET",url,true)
	request.send(null)
	
 }
 
function stateChanged() 
{ 
if (request.readyState==100 || request.readyState=="complete")
{ 
document.getElementById("table-menu").innerHTML=request.responseText
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
<input required name='createMenu' placeholder="Название меню">
<input type='submit' class='button' name='createM' value='Добавить'>
</form>
</td>
</tr>
</table>
<?php
if (isset($_POST['createM']))
{
	$STH=$DBH->prepare("insert into menu values('',?)");
	$STH->execute(array($_POST['createMenu']));
}
if (isset($_POST['search']))
{
	$nam="%".$_POST['text-s']."%";
	$STH=$DBH->prepare("SELECT * FROM menu WHERE nazM LIKE ?");
	$STH->execute(array($nam));
	$row=$STH->fetchAll();
}
else
{
	$STH = $DBH->query('SELECT * from menu'); 
	$row=$STH->fetchAll();
}
echo "<span id='table-menu'>";
echo "<table border=1 class='table-zakaz'><tr>";
echo "<th>Меню</th><th>Изменить</th></tr>";
foreach ($row as $row1)
{
	echo "<tr><td>".$row1['nazM']."</td><td><input required placeholder='Введите название меню' id='newMenu".$row1['idM']."'>
	<button onclick=change(".$row1['idM'].")>Изменить</button>
	<button onclick=delet(".$row1['idM'].")>Удалить</button></td></tr>";
}
echo "</table>";
echo "</span>";
require "struct/footer.php";	
}
?>