<?php
require '../require/comun.php';
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->activa($id);
echo "resultado = $r";
echo var_dump($bd->getError());
//aqui las redirecciones segun el resultado
if($r == 1){
    header("Location: ../index.php?r=1");
}else{
    header("Location: ../index.php?r=-1");
}