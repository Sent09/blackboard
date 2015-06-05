<?php 
/**
 * Cerrar sesión
 */
    require '../require/comun.php';
    $sesion->cerrar();
    header("Location: ../index.php");