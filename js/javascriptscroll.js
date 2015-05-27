function cargarPosts(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","ajaxbuscarposts.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarUsuarios(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","ajaxbuscarusuarios.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarIndex(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","post/ajaxindex.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarMisPosts(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","ajaxmisposts.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarMeGusta(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","ajaxmegusta.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarVerUsuario(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","ajaxverusuario.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarSeguidores(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","ajaxseguidores.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarSiguiendo(valor){        
    var lista_posts = document.getElementById("lista_posts");       
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "final"){
                lista_posts.innerHTML += xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","ajaxsiguiendo.php?value="+valor,true);
    xmlhttp.send(); 
    var mas = document.getElementById("mas");
    mas.parentNode.removeChild(mas);
}

function cargarNotificaciones(valor, boton){        
    var notificaciones = document.getElementById("notificaciones");    
    if (window.XMLHttpRequest) {
     xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText != "nada"){
                notificaciones.innerHTML = xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","post/ajaxnotificaciones.php?value="+valor+"&boton="+boton,true);
    xmlhttp.send(); 
}