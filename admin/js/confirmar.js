function confirmar(e){
    var respuesta = confirm("¿Está seguro de eliminar al usuario?");
    if(!respuesta){
        e.preventDefault();
    }
}