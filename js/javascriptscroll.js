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
