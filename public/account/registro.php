<?php
    /*
        @author: Sergio Matamoros Delgado <smatamorosdelgado.guadalupe@alumnado.fundacionloyola.net>
        @license: GPL v3 2021
        @description: BackEnd de tienda de fotos online. 
        Permite registrarte en el sitio web.
    */
    require_once __DIR__."/../../bd/database.php";
    function crearCuenta() {
        if(isset($_POST["crear"])) {
            //Comprobamos que no haya campos vacios...
            if(empty($_POST["username"]) || empty($_POST["surname"]) || empty($_POST["email"])
             || empty($_POST["password"]) || empty($_POST["password2"])) {
                echo 
                '
                    <div class="isa_error">
                        <i class="fa fa-times-circle"></i>
                        Se ha producido un error, hay algunos campos vacios.
                    </div>
                ';
                exit();
            }

            //Verificación de que las contraseñas sean iguales...
            if($_POST["password"] == $_POST["password2"]) {

                $bd = new Database();
                $cuentaStatus = $bd->crearCuenta($_POST["username"], $_POST["surname"], $_POST["email"], $_POST["password"]);
                //if($cuentaStatus) //mostrar algo si todo está bien...

                if($cuentaStatus === 1062) {
                    echo 
                    '
                        <div class="isa_error">
                            <i class="fa fa-times-circle"></i>
                            Se ha producido un error, el email ya está registrado en la plataforma.
                        </div>
                    ';
                }
        
            } else {
                echo 
                '
                    <div class="isa_error">
                        <i class="fa fa-times-circle"></i>
                        Se ha producido un error, las contraseñas no coinciden.
                    </div>
                ';
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
        <title>Creación de cuenta</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="../css/loginEstilo.css">
    </head>
    <body>
        <div id="cajaMainRegister">
            <p>Registro<span> Fotos</span></p>
            <div id="cajaRegister">
                <form action="#" method="post">
                    <h2>Creación de cuenta</h2>
                    <label for="username"><i class="fas fa-user"></i></label>
                    <input type="text" name="username" id="username" placeholder="Nombre" required>
                    <label for="surname"><i class="fas fa-user"></i></label>
                    <input type="text" name="surname" id="surname" placeholder="Apellido" required>

                    <label for="email"><i class="fas fa-envelope"></i></label>
                    <input type="text" name="email" id="email" placeholder="Correo" required>

                    <label for="password"><i class="fas fa-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <label for="password2"><i class="fas fa-lock"></i></label>
                    <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" required>
                    <input type="submit" value="Crear cuenta" name="crear[]">
                    
                    <span>¿Tienes una cuenta? Click <a href="login.php"> aquí</a></span>
                </form>
                <?php
                    crearCuenta();
                ?>
            </div>
        </div>
    </body>
</html>