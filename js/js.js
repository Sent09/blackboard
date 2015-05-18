function enviar(formulario) {
    var texto = formulario.texto.value;
    if (texto.length > 0) {
        window.location.assign('buscaruser.php?value=' + texto);
    }
}
function enviarIndex(formulario) {
    var texto = formulario.texto.value;
    if (texto.length > 0) {
        window.location.assign('post/buscaruser.php?value=' + texto);
    }
}

function seguir(loginsesion, login) {
    var seguir = document.getElementById("seguir");
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          seguir.innerText = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","ajaxseguir.php?loginusuario="+loginsesion+"&login="+login,true);
    xmlhttp.send();  
}

function gusta(elemento, loginsesion, idpost) {
    var gusta = document.getElementById(elemento);
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          gusta.innerText = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","ajaxgusta.php?loginusuario="+loginsesion+"&idpost="+idpost,true);
    xmlhttp.send();  
}

function gustaindex(elemento, loginsesion, idpost) {
    var gusta = document.getElementById(elemento);
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          gusta.innerText = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","post/ajaxgusta.php?loginusuario="+loginsesion+"&idpost="+idpost,true);
    xmlhttp.send();  
}
