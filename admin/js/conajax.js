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


 
