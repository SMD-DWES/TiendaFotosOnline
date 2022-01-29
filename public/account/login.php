<?php
/**
 * @author: Sergio Matamoros Delgado
 * @license: GPL v3 2021
 * @description: BackEnd de tienda de fotos online. 
 * Permite loguearte en el sitio web.
 * 
 */

require_once __DIR__."/../../bd/database.php";

/**
 * Función principal...
 */
function loginCuenta() {
    if(isset($_POST["login"])) {

        //Si no hay campos vacios...
        if(!empty($_POST["email"]) && !empty($_POST["password"])) {

            //instanciamos
            $bd = new Database();
            $login = $bd->checkLogin($_POST["email"], $_POST["password"]);

            if($login) {
                //reedirigimos al index.
                header("Location: ../../index.php");
            }else {
                //Si no nos hemos logueado, hubo un error...
                echo '
                <div class="isa_error">
                    <i class="fa fa-times-circle"></i>
                    Se ha producido un error, el email o la contraseña son incorrectos.
                </div>';
            }
        } else {
            echo '
            <div class="isa_error">
                <i class="fa fa-times-circle"></i>
                Se ha producido un error, hay algunos campos vacios.
            </div>';
        }
    }

}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Aplicación para tienda de fotos ONLINE">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="../css/loginEstilo.css">
        <title>Login</title>
    </head>
    <body>
        <div id="cajaPrincipal">
                <p>Login<span> Fotos</span></p>
                <div id="cajaLogin">
                    <form action="#" method="post">
                        <h2>Inicia sesión para entrar a tu sesión</h2>
                        <label for="username"><i class="fas fa-user"></i></label>
                        <input type="text" name="email" id="email" placeholder="Email" required>
                        <label for="password"><i class="fas fa-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Contraseña" required>
                        <input type="submit" value="Iniciar sesión" name="login[]">
                        <span>¿No Tienes una cuenta? Click <a href="registro.php"> aquí</a></span>
                    </form>
                    <?php
                        loginCuenta();
                    ?>
                </div>
            </div>
    </body>
</html>