function enviar(formulario){
    var texto = formulario.texto.value 
    if (texto.length > 0){
        window.location.assign('post/buscar.php?value='+texto);
    }
}

function seguir(a){
    var algo = document.getElementById("algo")
    if(algo.innerText == "Siguiendo"){
        algo.innerText = "Seguir";
    }else{
        algo.innerText = "Siguiendo";
    }
}