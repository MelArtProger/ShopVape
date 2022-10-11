var request;
// Это для адекватных современных браузеров
 if (window.XMLHttpRequest) request = new XMLHttpRequest();
// Internet Explorer
 else if (window.ActiveXObject) {
// IE разных версий
try{
  request = new ActiveXObject('Msxml2.XMLHTTP');
 } catch (e){alert("no request")}
 try {
 request = new ActiveXObject('Microsoft.XMLHTTP');
 } catch (e){alert("no request")}
 }
 function toCart(){
var url="cart.php"+location.search;
request.onreadystatechange=stateChanged 
request.open("GET",url,true)
request.send(null)
 }
function stateChanged() 
{ 
if (request.readyState==4 || request.readyState=="complete")
{ 
document.getElementById("summCart").innerHTML=request.responseText +"<span>Р</span>"
} 
} 
