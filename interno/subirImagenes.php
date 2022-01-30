<?php
/**
 * @author Sergio Matamoros Delgado
 */
require_once __DIR__."/../bd/database.php";
//require_once __DIR__ . "/../config_bd.php";

if(isset($_POST["enviar"])) {
    if(isset($_FILES["file"]))
    {
        session_start();
        $idUsuario = $_SESSION["id"];
        $total = $_FILES["file"]["name"];

        //Añade el pedido del usuario a la BD
        $bd = new Database();
        $idPedido = $bd->aniadirPedido($idUsuario,'f');

        //Iteramos sobre cada fichero del FILES...
        for($i=0;$i<count($total);$i++) {
                //Variable con el nombre del archivo en minusculas.
                $nombreArchivo = strtolower($_FILES["file"]["name"][$i]);

                //Verificación de formato válido
                if(!extensionWhitelist($nombreArchivo)) {
                    header("Location: ../index.php?error=1024");
                    exit();
                }

                //Verificación del peso requerido, si pesa más de lo establecido
                //en el fichero de configuración dará error.
                if($_FILES["file"]["size"][$i] > MAX_IMAGE_WEIGHT * 1024 * 1024) {
                    header("Location: ../index.php?error=1023");
                    exit();
                }

                //Directorio de usuarios.
                $directorioRecursos = "../recursos/".$idPedido . "/";

                //Variable con el nombre sanitizado.
                $newName = "";

                //Si el directorio del usuario no existe lo creamos.
                if(!file_exists($directorioRecursos))
                    //Especificamos que se cree un directorio con permisos de lectura y escritura para el 
                    //dueño y el grupo, y NINGUNO para otros (1 1 0).
                    mkdir($directorioRecursos,"0660");//fopen($idUsuario . "/$nombreArchivo", "w");

                //Iteramos palabra por palabra del nombre del archivo para comprobar si
                //hay un caracter no valido.
                //r -> 114
                //ord
                for($j=0;$j<strlen($nombreArchivo);$j++) {
                    //Si el caracter está por debajo de la 97 y por encima de la 122 de la 
                    //tabla ascii nos lo saltamos, con la excepción del punto.
                    if( (ord($nombreArchivo[$j]) < 97 || ord($nombreArchivo[$j]) > 122 ) && ($nombreArchivo >= 0 || $nombreArchivo <=9)
                    && $nombreArchivo[$j] != ".") {
                        //echo '<br>Caracter no valido: '. $nombreArchivo[$i];
                        continue;
                    } else {
                        $newName .= $nombreArchivo[$j];
                    }
                }
                //echo "<br>Nuevo nombre: " . $newName;

                //Movemos el archivo de memoria al directorio del usuario.
                move_uploaded_file($_FILES["file"]["tmp_name"][$i], $directorioRecursos . $newName);


                header("Location: ../index.php?error=0");
        }
        exit();
    }
}

/**
 * Comprueba que el nombre pasado contenga una extensión válida.
 * @param nombre -> Nombre del archivo a comprobar la extensión.
 * @return - Devuelve true si la extensión del archivo pasado es permitida, false si no lo es.
 */
function extensionWhitelist($nombre) {
    $formatos = FILE_EXTENSIONS_ALLOWED;
    //Buscamos en el string el primer resultado que coincida con un punto
    //y nos los saltamos para que solo muestre la extensión.
    $fileExtension = substr(strstr($nombre, "."),1);

    //Iteramos sobre cada elemento del array
    //y comprobamos que la extensión sea una de las permitidas
    for($i=0;$i<sizeof($formatos);$i++) {
        if($fileExtension == $formatos[$i]) {
            return true;
        }
    }
    return false;
}