
function llamarasincrono2(url, id_contenedor){

var pagina_requerida = false
if (window.XMLHttpRequest) {// Si es Mozilla, Safari etc
pagina_requerida = new XMLHttpRequest()
} else if (window.ActiveXObject){ // pero si es IE
try{
pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){ // en caso que sea una versión antigua
try{
	
pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}

}
}
else
return false
pagina_requerida.onreadystatechange=function(){ // función de respuesta
cargarpagina2(pagina_requerida, id_contenedor)

}
pagina_requerida.open('GET', url, true) // asignamos los métodos open y send
pagina_requerida.send(null)

}
// todo es correcto y ha llegado el momento de poner la información requerida
// en su sitio en la pagina xhtml
function cargarpagina2(pagina_requerida, id_contenedor){
	//document.getElementById('cargando').style.visibility = "visible"
	if (pagina_requerida.readyState == 1){
				}
	if (pagina_requerida.readyState == 0){
				}
	if (pagina_requerida.readyState == 2){
				}
if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText
//document.getElementById('cargando').style.visibility = "hidden"

}

function busca(e) {
var a = document.getElementById('busca').value;
tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13){
document.location.href='buscando.php?p='+a;
  }
}

function buscaclick(e) {
var a = document.getElementById(e).text;
document.getElementById('busca').value = a;


document.location.href='buscando.php?p='+a;

}
