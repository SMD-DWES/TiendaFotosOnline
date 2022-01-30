<?php
    /**
     * @author Sergio Matamoros Delgado
     * @description Muestra las fotos del usuario solicitadas por pedido.
     */
    session_start();
    if(!isset($_SESSION["id"])) header("Location: ../account/login.php");

    require_once __DIR__."/../../bd/database.php";
    
    function verFotos() {
        $idUsuario = $_SESSION["id"];

        $bd = new Database();
        $result = $bd->listaPedidos($idUsuario);


        //Iteramos sobre el array que nos devolverá todos nuestros pedidos.
        while ($fila = $bd->selectArray($result)) {
            $ruta = "../../recursos/$fila[idPedido]";

            if(file_exists($ruta)) {
                $directorios = opendir("../../recursos/$fila[idPedido]");

                //Recorremos la carpeta del pedido para mostrar las fotos.
                while(($archivos = readdir($directorios)) !== false) {
                    if($archivos != "." && $archivos != "..") {
                        echo $archivos . "<br>Fecha: $fila[fecha]<br>";
                        echo
                        "
                            <div id='tusFotos'>
                                <a href='$ruta/$archivos'><img src='$ruta/$archivos'></a>
                            </div>
                        ";
                    }
                }
                closedir($directorios);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicación para tienda de fotos ONLINE">

        <link rel="stylesheet" href="../css/estilo.css">
        <title>Tienda fotos</title>
    </head>
    <body>
        <nav>
            <a href="../../index.php"><button>Inicio</button></a>
            <a href="interno/logout.php" class="logout"><button>Desloguearse</button></a>
        </nav>
        <main>
            <?php
                verFotos();
            ?>
        </main>
    </body>
</html>