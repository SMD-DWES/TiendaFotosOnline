<?php
    /**
     * @author Sergio Matamoros Delgado
     */

     //Si no estas logueado, te manda a iniciar sesión.
    session_start();
    if(!isset($_SESSION["id"])) header("Location: public/account/login.php");
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
            <a href="interno/logout.php" class="logout"><button>Desloguearse</button></a>
        </nav>
        <main>
            <form action="public/principal/realizarPedido.php" method="POST">
                <label for="accion">Escoja la acción a realizar</label>

                <label for="imprimir">Crear un album</label>
                <input type="radio" name="imprimir" id="radio" value="Album">

                <label for="imprimir">Imprimir una foto</label>
                <input type="radio" name="imprimir" id="imprimir" value="Imprimir">

                <input type="submit" value="Siguiente..." name="enviar">
            </form>
        </main>
    </body>
</html>