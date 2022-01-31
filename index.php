<?php
    /**
     * @author Sergio Matamoros Delgado
     */

     //Si no estas logueado, te manda a iniciar sesión.
    session_start();
    if(!isset($_SESSION["id"])) header("Location: public/account/login.php");

    //Esta función es unicamente para poder ponerla encima del main
    function cargaErrores() {
        //Comprobación de errores 
        if(isset($_GET["error"])) {
            if($_GET["error"] == "1024") {
                echo
                "
                <div class='alert'>
                    <span class='closebtn'>&times;</span>  
                    <strong>ERROR</strong> : Has subido un archivo con una extensión incorrecta.
                    Solo se admiten extensiones de tipo <b>.jpg, .jpeg y .png</b>.
                </div>
                ";
            }
            if($_GET["error"] == "1023") {
                echo
                "
                <div class='alert'>
                    <span class='closebtn'>&times;</span>  
                    <strong>ERROR</strong> : Has subido un archivo con un peso mayor al establecido-
                    Las imágenes deben pesar menos de 5MB.
                </div>
                ";
            }
            if($_GET["error"] == "0") {
                echo
                "
                <div class='alert success'>
                    <span class='closebtn'>&times;</span>  
                    <strong>Súbida exitosa</strong> : ¡Has subido correctamente los archivos!.
                </div>
                ";
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

        <link rel="stylesheet" href="public/css/estilo.css">
        <title>Tienda fotos</title>
    </head>
    <body>
        <nav>
            <a href="#"><button>Inicio</button></a>
            <a href="public/principal/verFotos.php"><button>Mis fotos</button></a>
            <a href="interno/logout.php" class="logout"><button>Desloguearse</button></a>
        </nav>
        <?php
            //Esto se haría mejor con JS...
            cargaErrores();
        ?>
        <main>
            <form action="public/principal/realizarPedido.php" method="POST">
                <label for="accion">Escoja la acción a realizar</label>

                <label for="album">Crear un album</label>
                <input type="radio" name="imprimir" id="album" value="Album">

                <label for="imprimir">Imprimir una foto</label>
                <input type="radio" name="imprimir" id="imprimir" value="Imprimir">

                <input type="submit" value="Siguiente..." name="enviar">
            </form>
        </main>
    </body>
</html>