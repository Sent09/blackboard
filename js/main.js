window.onload = function () {
    
    var mobile = document.createElement('div');
    mobile.className = 'nav-mobile';
    document.querySelector('nav').appendChild(mobile);
    
    
    var mobileNav = document.querySelector('.nav-mobile');
    mobileNav.onclick = function() {
      toggleMenu();
        
    }
    
    var notificaciones = document.getElementById("notificaciones-toggle");
    var toggle2 = document.querySelector('.notificaciones-list');
    notificaciones.onclick = function(){
        toggleNotificaciones();
    }

        // hasClass
    function hasClass(elem, className) {
      return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
    }

    // toggleClass
    function toggleMenu() {
      var menu = document.getElementById("manageinfo");
      var notificacionesm = document.getElementById("notificaciones-list");
        if (menu.style.display =="none") {
            menu.style.display = "flex";
        } else {
            if(notificacionesm.style.display == "block")
                notificacionesm.style.display = "none";
            menu.style.display = "none";
        }
    }
    
    function toggleNotificaciones() {
      var notificacionesm = document.getElementById("notificaciones-list");
        if (notificacionesm.style.display =="none") {
            notificacionesm.style.display = "block";
        } else {
            notificacionesm.style.display = "none";
        }
    }
};

function cambiar(numero){
    document.getElementById("seleccionados").innerText = "Archivos seleccionados - " + numero.files.length;
};