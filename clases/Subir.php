<?php

class Subir {

    private $files, $input, $destino, $nombre, $accion, $maximo, $tipos, $extensiones,$crearCarpeta, $motivoError, $nombresFotos;
    private $errorPHP, $error;

    const IGNORAR = 0, RENOMBRAR = 2, REEMPLAZAR = 1;
    const ERROR_INPUT = -1;
    /*
     * Constructor
     * 
     * Se le pasa el parametro $input el cual representa el nombre del input
     * file del html. Inicializa las variables necesarias.
     * 
     * @param string $input
     */
    function __construct($input) {
        $this->input = $input;
        $this->destino = "../img/";
        $this->nombre = "";
        $this->accion = Subir::RENOMBRAR;
        $this->maximo = 20 * 1014 * 1024;
        $this->crearCarpeta = false;
        $this->extensiones = array("jpg","png","JPG","gif","jpeg","doc","docx","pdf","avi","mp3","mp4","wav");
        $this->errorPHP = UPLOAD_ERR_OK;
        $this->motivoError = "";
        $this->error = 0;
        $this->nombresFotos = null;
    }
    /*
     * Devuelve el error que de PHP
     */
    function getErrorPHP() {
        return $this->errorPHP;
    }
    /*
     * Devuelve el codigo de error
     */
    function getError() {
        return $this->error;
    }
    /*
     * Selecciona si crear o no una carpeta en caso de que sea necesario.
     * 
     * @param boolean $crearCarpeta
     */
    function setCrearCarpeta($crearCarpeta) {
        $this->crearCarpeta = $crearCarpeta;
    }
    /*
     * Se selecciona el nuevo destino en caso de cambiar el original.
     * 
     * @param string $destino hubicación de la carpeta
     */
    function setDestino($destino) {
        $caracter = substr($destino, -1);
        if ($caracter != "/")
            $destino.="/";
        $this->destino = $destino;
    }
    /*
     * Se selecciona el nombre de los archivos subidos.
     * 
     * @param string $nombre nombre del archivo.
     */
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    /*
     * Selecciona la acción que seguiran los archivos.
     * 
     * En caso de que se pase un valor u otro, los archivos serán
     * reemplazados o reenombrados
     * 
     * @param int $accion valor de los radio button (1-2)
     */
    function setAccion($accion) {
        $this->accion = $accion;
    }
    /*
     * Se selecciona el tamaño maximo de los archivos a subir.
     * 
     * @param int $maximo
     */
    function setMaximo($maximo) {
        $this->maximo = $maximo;
    }
    /*
    function addTipo($tipo) {
        if (is_array($tipo)) {
            $this->tipos = array_merge($this->tipos, $tipo);
        } else {
            $this->tipos[] = $tipo;
        }
    }
    */
    /*
     * Se selecciona la extension o extensiones disponibles para la subida de archivos.
     * 
     * @param string $extension || Array $extension
     */
    function setExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = $extension;
        } else {
            unset($this->extensiones);
            $this->extensiones[] = $extension;
        }
    }
    /*
     * Se añade la extension o extensiones disponibles para la subida de archivos.
     * 
     * @param string $extension || Array $extension
     */
    function addExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = array_merge($this->extensiones, $extension);
        } else {
            $this->extensiones[] = $extension;
        }
    }
    /*
     * Se comprueba que se recoja bien el $_FILES["*"]
     *
     */
    function isInput(){
        if (!isset($_FILES[$this->input])) {
            $this->error = -1;
            return false;
        }
        return true;
    }
    /*
     * Se comprueba un posible error de PHP.
     * 
     */
    private function isError(){
        if ($this->errorPHP != UPLOAD_ERR_OK) {
            return true;
        }
        return false;
    }
    /*
     * Se comprueba que el tamaño de los archivos sea inferior al maximo
     * 
     */
    private function isTamano(){        
        if ($this->files["size"] > $this->maximo) {
            $this->error = -2;
            return false;
        }
        return true;
    }
    /*
     * Se comprueba el tamaño de los archivos. Es usado en caso de Array de archivos.
     * 
     * @param int $i posicion del array
     */
    private function isTamanoArray($i){        
        if ($this->files["size"][$i] > $this->maximo) {
            $this->error = -2;
            return false;
        }
        return true;
    }
    /*
     * Se comprueba que la extension del archivo esté permitida.
     * 
     * @param string $extension
     */
    private function isExtension($extension){
        if (sizeof($this->extensiones) > 0 && !in_array($extension, $this->extensiones)) {
            $this->error = -3;
            return false;
        }
        return true;
    }
    /*
     * Se comprueba que la carpeta exista
     * 
     */
    private function isCarpeta(){
        if (!file_exists($this->destino) && !is_dir($this->destino)) {
            $this->error = -4;
            return false;
        }
        return true;
    }
    /*
     * Se crea la carpeta indicada.
     * 
     */
    private function crearCarpeta() {  
        return mkdir( $this->destino , 0777, true);      
    }
    /*
     * Se devuelve el error ocasionado.
     * 
     * En caso de que se haya subido un archivo individual hará un switch, 
     * dependiendo del error obtenido de la funcion getError(). En caso de ser
     * un array se comprobará si el error es un motivo comun (input, o directorio)
     * y en caso de que no sea así, devuelve un String con los errores que han tenido
     * los distintos directorios.
     * 
     */
    function getMotivoError(){
        if(!is_array($this->files)){
            switch ($this->getError()){
            case 0:
                return "Archivo subido con exito";
            case -1:
                return "Error en el input. Quizas su archivo es demasiado pesado";
            case -2:
                return "Error en el tamaño";
            case -3:
                return "Error en la extension";
            case -4:
                return "No existe la carpeta de destino";
            case -5:
                return "El archivo que intentas subir ya existe";
            case -6:
                return "No se ha marcado ninguna casilla";
            case -7:
                return "Fallo al crear la carpeta";
            case -8:
                return "No se ha creado carpeta";
            }
        }else{
            if($this->getError() == -1){
                return "Error en el input.  Quizas su archivo es demasiado pesado.";
            }elseif($this->getError() == -4){
                return "No existe la carpeta de destino";
            }elseif($this->getError() == -7){
                return "Fallo al crear la carpeta";
            }elseif($this->getError() == -8){
                return "No se ha creado carpeta";
            }elseif($this->motivoError === ""){
                return "Archivos subidos con exito";
            }else{
                return $this->motivoError;
            }                       
        }        
    }
    /*
     * Sube un archivo en caso de ser individual, es decir, que no esté en un array.
     * 
     * Comprueba que todo esté correcto, que no haya errores y tras ello procederá
     * a subir el archivo. En caso de que haya algun error este no será subido y 
     * devolverá un false;
     * 
     */
    private function subirIndividual() {
        $this->errorPHP = $this->files["error"];
        if($this->isError()){
            return false;
        }
        if(!$this->isTamano()){
            return false;
        }
        $partes = pathinfo($this->files["name"]);
        $extension = $partes['extension'];
        $nombreOriginal = $partes['filename'];
        if(!$this->isExtension($extension)){
            return false;
        }
        if($this->nombre === "") {
            $this->nombre = $nombreOriginal;
        }
        $origen = $this->files["tmp_name"];
        if ($this->accion == Subir::REEMPLAZAR) {
            if($this->nombre === "") {
                $this->nombre = $nombreOriginal;
            }
            $destino = $this->destino . $this->nombre . "." . $extension;
            return move_uploaded_file($origen, $destino);
            
            } elseif ($this->accion == Subir::IGNORAR) { 
                if($this->nombre === "") {
                    $this->nombre = $nombreOriginal;
                }
                $destino = $this->destino . $this->nombre . "." . $extension;
                if (file_exists($destino)) {
                    $this->error = -5;
                    return false;
                }
                return move_uploaded_file($origen, $destino);
            }elseif ($this->accion == Subir::RENOMBRAR) {
            if($this->nombre === "") {
                $this->nombre = "archivo";
            }
            $i = 1;
            while (file_exists($destino)) {
                $destino = $destino = $this->destino . $this->nombre . "_$i." . $extension;
                $i++;
            }
            return move_uploaded_file($origen, $destino);
        }
        $this->error = -6;
        return false;
    }
    /*
     * Sube los archivos de un array de archivos.
     * 
     * Comprueba uno a uno los archivos y posteriormente los sube. 
     * En caso de error, ese archivo no será subido y dará su mensaje de error 
     * y se proseguirá con la subida del resto de archivos.
     * 
     */
    private function subirArray() {       
        foreach ($this->files["name"] as $key => $value){ 
            $this->errorPHP = $this->files["error"][$key];
            if(!$this->isError()){                
                if($this->isTamanoArray($key)){
                    $partes = pathinfo($this->files["name"][$key]);
                    $extension = $partes['extension'];
                    $nombreOriginal = $partes['filename'];
                    if($this->isExtension($extension)){
                        $origen = $this->files["tmp_name"][$key];                        
                        if($this->accion == Subir::REEMPLAZAR) {
                            if($this->nombre === "") {                                
                                $destino = $this->destino . $nombreOriginal . "." . $extension;
                            }else{
                                $destino = $this->destino . $this->nombre . "." . $extension;
                            }
                            move_uploaded_file($origen, $destino);
                        } elseif ($this->accion == Subir::IGNORAR) {
                            if($this->nombre === "") {                                
                                $destino = $this->destino . $nombreOriginal . "." . $extension;
                            }else{
                                $destino = $this->destino . $this->nombre . "." . $extension;
                            }                                                        
                            if (file_exists($destino)) {
                                if($this->nombre === "") {                                
                                    $nombreError = $nombreOriginal;
                                }else{
                                    $nombreError = $this->nombre;
                                }
                                $this->motivoError = $this->motivoError."Archivo: ".$nombreError.".".$extension." ya existe | ";
                            }else{
                               move_uploaded_file($origen, $destino); 
                            }
                            
                        }elseif ($this->accion == Subir::RENOMBRAR) {
                            if($this->nombre === "") {
                                $this->nombre = "archivo";
                            }
                            $i = 1;
                            $destino = $this->destino . $this->nombre . "." . $extension;
                            while (file_exists($destino)) {
                                $destino = $destino = $this->destino . $this->nombre . "_$i." . $extension;
                                $i++;
                            }
                            $imagen = substr($destino, 7);
                            $this->nombresFotos[] = $imagen;
                            move_uploaded_file($origen, $destino);
                        }else{
                            $partes = pathinfo($this->files["name"][$key]);
                            $extension = $partes['extension'];
                            $nombreOriginal = $partes['filename'];
                            $this->motivoError = $this->motivoError."Archivo: ".$nombreOriginal.".".$extension." error al subir el archivo | ";
                        }                        
                    }else{
                        $partes = pathinfo($this->files["name"][$key]);
                        $extension = $partes['extension'];
                        $nombreOriginal = $partes['filename'];
                        $this->motivoError = $this->motivoError."Archivo: ".$nombreOriginal.".".$extension." extension no permitida | ";
                    } 
                }else{
                    $partes = pathinfo($this->files["name"][$key]);
                    $extension = $partes['extension'];
                    $nombreOriginal = $partes['filename'];
                    $this->motivoError = $this->motivoError."Archivo: ".$nombreOriginal.".".$extension." excede el tamaño | ";
                }
            }else{                
                $this->motivoError = $this->motivoError."Error al subir. Posibles motivos: No se ha seleccionado un archivo o archivo demasiado pesado.";
            }   
        }
    }
    /*
     * Al llamar a esta función se procede a la subida de archivos.
     * 
     * COmprueba posibles errores en el input o en el directorio de destino
     * y posteriormente procede a llamar a los metodos oportunos para subir
     * el/los archivo/s
     * 
     * @param string $extension
     */
    function subir() {
        $this->error = 0;
        if(!$this->isInput()){
            return false;
        }
        $this->files = $_FILES[$this->input];
        
        if(!$this->isCarpeta()){
            if($this->crearCarpeta){
                $this->error=0;//
                if(!$this->crearCarpeta()){
                    $this->error=-7;
                    return false;
                }       
            } else{
                $this->error = -8;
                return false;
            }
        }
        if(is_array($this->files)){
            $this->subirArray();
            return $this->nombresFotos;
        }else{
            $this->subirIndividual();
        }        
    }
}


