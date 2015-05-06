<?php

class Util {
    /*
     * Se le pasa la pagina actual, el numero de registros por página, el numero de registros totales y un link si se tiene.
     * Esta funcion crea un html con la pagina actual y las 4 mas proximas.
     */
    public static function getEnlacesPaginacion($p, $registrosPagina, $numeroRegistros, $href=""){ 
        $enlaces  = array();       
        $ultimoCalculo = $numeroRegistros / $registrosPagina;
        $ultimo = intval($ultimoCalculo);
        if($href==""){
            $signo = "?";
        }else{
            $signo = "&";
        }
        /**
         * Botones de inicio y ultimo
         */
        $enlaces["inicio"] = "<li><a href='".$href.$signo."p=0'>&laquo; </a></li>"; 
        $enlaces["ultimo"] = "<li><a href='".$href.$signo."p=$ultimo'>&raquo;</a></li>"; 
        /**
         * Botones siguiente y anterior
         */
        if($p>0){
            $paginaAnterior = $p-1 ;
            $enlaces["anterior"] = "<li><a href='".$href.$signo."p=$paginaAnterior'>&lt; </a></li>";
        }else{
            $enlaces["anterior"] = "<li style='display:none;'></li>";
        }
        if($p<$ultimo){
            $paginaSiguiente = $p+1 ;
            $enlaces["siguiente"] = "<li><a href='".$href.$signo."p=$paginaSiguiente'>&gt; </a></li>";
        }else{
            $enlaces["siguiente"] = "<li style='display:none;'></li>";
        }
        /**
         * Los 5 primeros if son para mostrar unas paginas u otras dependiendo
         * de que sean las primeras 5 paginas
         */
       if($ultimo==0){             
            $enlaces["primero"]= "<li class='active'><a href='".$href.$signo."p=0'>1 </a></li>";
            $enlaces["segundo"]= "<li style='display:none;'></li>";
            $enlaces["actual"]= "<li style='display:none;'></li>";
            $enlaces["cuarto"]= "<li style='display:none;'></li>";
            $enlaces["quinto"]= "<li style='display:none;'></li>"; 
       }elseif ($ultimo==1){ 
            if($p==0){
                $enlaces["primero"]= "<li class='active'><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li style='display:none;'></li>"; 
                $enlaces["cuarto"]= "<li style='display:none;'></li>"; 
                $enlaces["quinto"]= "<li style='display:none;'></li>"; 
            }else{
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li class='active'><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li style='display:none;'></li>"; 
                $enlaces["cuarto"]= "<li style='display:none;'></li>"; 
                $enlaces["quinto"]= "<li style='display:none;'></li>";     
            }
            
        }elseif ($ultimo==2){
            if($p==0){
                $enlaces["primero"]= "<li class='active'><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li style='display:none;'></li>"; 
                $enlaces["quinto"]= "<li style='display:none;'></li>"; 
            }if($p==1){
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li class='active'><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li style='display:none;'></li>"; 
                $enlaces["quinto"]= "<li style='display:none;'></li>"; 
            }else{
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li class='active'><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li style='display:none;'></li>"; 
                $enlaces["quinto"]= "<li style='display:none;'></li>";      
            }
        }elseif ($ultimo==3){
            if($p==0){
                $enlaces["primero"]= "<li class='active'><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li style='display:none;'></li>"; 
            }if($p==1){
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li class='active'><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li style='display:none;'></li>"; 
            }if($p==2){
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li class='active'><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li style='display:none;'></li>"; 
            }else{
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li class='active'><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li style='display:none;'></li>";     
            }
        }elseif ($p==$ultimo){ 
            $primero= $ultimo-4;
            $primeroNumero= $ultimo-3;
            $enlaces["primero"]= "<li><a href='".$href.$signo."p=".$primero."'>$primeroNumero </a></li>";
            $segundo = $ultimo-3;
            $segundoNumero = $ultimo-2;
            $enlaces["segundo"]= "<li><a href='".$href.$signo."p=".$segundo."'>$segundoNumero </a></li>"; 
            $actual = $ultimo-2;
            $actualNumero = $ultimo-1;
            $enlaces["actual"]= "<li><a href='".$href.$signo."p=".$actual."'>$actualNumero </a></li>"; 
            $cuarto = $ultimo-1;
            $cuartoNumero = $ultimo;
            $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=".$cuarto."'>$cuartoNumero </a></li>";
            $quinto = $ultimo;
            $quintoNumero = $ultimo+1;
            $enlaces["quinto"]= "<li class='active'><a href='".$href.$signo."p=".$quinto."'>$quintoNumero </a></li>"; 
        }elseif ($p==$ultimo-1){ 
            $primero= $ultimo-4;
            $primeroNumero= $ultimo-3;
            $enlaces["primero"]= "<li><a href='".$href.$signo."p=".$primero."'>$primeroNumero </a></li>";
            $segundo = $ultimo-3;
            $segundoNumero = $ultimo-2;
            $enlaces["segundo"]= "<li><a href='".$href.$signo."p=".$segundo."'>$segundoNumero </a></li>"; 
            $actual = $ultimo-2;
            $actualNumero = $ultimo-1;
            $enlaces["actual"]= "<li><a href='".$href.$signo."p=".$actual."'>$actualNumero </a></li>"; 
            $cuarto = $ultimo-1;
            $cuartoNumero = $ultimo;
            $enlaces["cuarto"]= "<li class='active'><a href='".$href.$signo."p=".$cuarto."'>$cuartoNumero </a></li>";
            $quinto = $ultimo;
            $quintoNumero = $ultimo+1;
            $enlaces["quinto"]= "<li><a href='".$href.$signo."p=".$quinto."'>$quintoNumero </a></li>"; 
        }elseif ($ultimo==4){
            if($p==0){
                $enlaces["primero"]= "<li class='active'><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li><a href='".$href.$signo."p=4'>5 </a></li>";
            }if($p==1){
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li class='active'><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li><a href='".$href.$signo."p=4'>5 </a></li>";
            }if($p==2){
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li class='active'><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li><a href='".$href.$signo."p=4'>5 </a></li>";
            }if($p==3){
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li class='active'><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li><a href='".$href.$signo."p=4'>5 </a></li>";
            }else{
                $enlaces["primero"]= "<li><a href='".$href.$signo."p=0'>1 </a></li>";
                $enlaces["segundo"]= "<li><a href='".$href.$signo."p=1'>2 </a></li>"; 
                $enlaces["actual"]= "<li><a href='".$href.$signo."p=2'>3 </a></li>"; 
                $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=3'>4 </a></li>";
                $enlaces["quinto"]= "<li class='active'><a href='".$href.$signo."p=4'>5 </a></li>";   
            }
        }else{
            $primero= $p-2;
            $primeroNumero= $p-1;
            $enlaces["primero"]= "<li><a href='".$href.$signo."p=".$primero."'>$primeroNumero </a></li>";
            $segundo = $p-1;
            $segundoNumero = $p;
            $enlaces["segundo"]= "<li><a href='".$href.$signo."p=".$segundo."'>$segundoNumero </a></li>"; 
            $actual = $p;
            $actualNumero = $p+1;
            $enlaces["actual"]= "<li class='active'><a href='".$href.$signo."p=".$actual."'>$actualNumero </a></li>"; 
            $cuarto = $p+1;
            $cuartoNumero = $p+2;
            $enlaces["cuarto"]= "<li><a href='".$href.$signo."p=".$cuarto."'>$cuartoNumero </a></li>";
            $quinto = $p+2;
            $quintoNumero = $p+3;
            $enlaces["quinto"]= "<li><a href='".$href.$signo."p=".$quinto."'>$quintoNumero </a></li>"; 
        }
        return $enlaces;
   }
}

?>
