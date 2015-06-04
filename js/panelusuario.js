window.onload = function () {
    var mobile = document.createElement('div');
    mobile.className = 'nav-mobile';
    document.querySelector('nav').appendChild(mobile);
    
    
    var mobileNav = document.querySelector('.nav-mobile');
    mobileNav.onclick = function() {
      toggleMenu();
    }
    
    function toggleMenu() {
      var menu = document.getElementById("manageinfo");
        if (menu.style.display =="none") {
            menu.style.display = "flex";
        } else {
            menu.style.display = "none";
        }
    }
}

function cambiar(numero){
    document.getElementById("seleccionados").innerText = "Archivos seleccionados - " + numero.files.length;
};