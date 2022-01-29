<?php
/**
 * @author Sergio Matamoros Delgado
 */
//require_once __DIR__."/../bd/database.php";

if(isset($_POST["enviar"])) {
    if(isset($_FILES["file"]))
    {
        session_start();
        $idUsuario = $_SESSION["id"];

        //Variable con el nombre del archivo en minusculas.
        $nombreArchivo = strtolower($_FILES["file"]["name"]);

        //Verificación de formato válido
        if(extensionWhitelist($nombreArchivo)) {
            header("Location: ../public/principal/realizarPedido.php?error=1024");
            exit();
        }

        //Directorio de usuarios.
        $directorioRecursos = "../recursos/".$idUsuario . "/";

        //Variable con el nombre sanitizado.
        $newName = "";

        print_r($_FILES);
        //Si el directorio del usuario no existe lo creamos.
        if(!file_exists($directorioRecursos))
            //Especificamos que se cree un directorio con permisos de lectura y escritura para el 
            //dueño y el grupo, y NINGUNO para otros (1 1 0).
            mkdir($directorioRecursos,"0660");//fopen($idUsuario . "/$nombreArchivo", "w");

        //Iteramos palabra por palabra del nombre del archivo para comprobar si 
        //hay un caracter no valido.
        //r -> 114
        //ord
        for($i=0;$i<strlen($nombreArchivo);$i++) {
            //Si el caracter está por debajo de la 97 y por encima de la 122 de la 
            //tabla ascii nos lo saltamos, con la excepción del punto.
            if( (ord($nombreArchivo[$i]) < 97 || ord($nombreArchivo[$i]) > 122) && $nombreArchivo[$i] != ".") {
                echo '<br>Caracter no valido: '. $nombreArchivo[$i];
            } else {
                $newName .= $nombreArchivo[$i];
            }
        }
        echo "<br>Nuevo nombre: " . $newName;

        //Movemos el archivo de memoria al directorio del usuario.
        move_uploaded_file($_FILES["file"]["tmp_name"], $directorioRecursos . $newName);

    }
}

/**
 * Comprueba que el nombre pasado contenga una extensión válida.
 */
function extensionWhitelist($nombre) {
    $formatos = array("png", "jpg", "jpeg", "bmp");

    for($i=0;$i<sizeof($formatos);$i++) {
        if(substr(strchr($nombre, "."), 1) == $formatos[$i]) {
            echo 'e';
            return true;
        }
    }
    return false;
}