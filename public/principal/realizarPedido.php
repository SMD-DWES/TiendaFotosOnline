<?php
    session_start();
    if(!isset($_SESSION["id"])) header("Location: ../account/login.php");

    function realizarPedido() {
        if(isset($_POST["enviar"])) {
            if(isset($_POST["imprimir"])) {

                if($_POST["imprimir"] == "Album") {
                    echo
                    "
                        <form action='../../interno/subirImagenes.php' method='POST' enctype='multipart/form-data'>
                            <label for='accion'>Nombre del album</label>
                            <input type='text' name='nombreAlbum' id='nombreAlbum'>

                            <input type='file' name='file[]' id='file' multiple>

                            <input type='submit' value='Subir' name='enviar[]'>
                        </form>
                    ";
                }
                if($_POST["imprimir"] == "Imprimir") {
                    echo
                    "
                        <form action='../../interno/subirImagenes.php' method='POST' enctype='multipart/form-data'>
                            <label for='accion'>Seleccione un archivo para imprimir...</label>

                            <input type='file' name='file' id='file'>

                            <input type='submit' value='Subir' name='enviar[]'>
                        </form>
                    ";
                }
            } else {
                echo '[ERROR] No has seleccionado ninguna acción a realizar.';
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
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>/!\ AVISO /!\</strong> : Solo se admiten extensiones de tipo <b>.jpg, .jpeg y .png</b> y un peso máximo de 5MB.
        </div>
        <main>
            <?php
                realizarPedido();
            ?>
        </main>
    </body>
</html>