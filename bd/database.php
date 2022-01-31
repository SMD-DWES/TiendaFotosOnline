<?php
/**
 * @author: Sergio Matamoros Delgado.
 * @license: GPL v3 2022
 * @description: Contiene los métodos de consultas de bases de datos.
 */
require_once __DIR__."/operaciones.php";
class Database extends Operaciones
{
    private $mysql;

    function __construct()
    {
        $this->mysql = $this->iniciar();    
    }

    /**
     * Comprueba que el usuario y la contraseña sean correctos
     * @return - true si es correcto - false si es incorrecto.
     */
    function checkLogin($email, $pw) {
        $sql = "SELECT idUsuario, correo, pw FROM usuarios WHERE correo=?";
        $consulta = $this->prepararConsulta($sql);
        $consulta->bind_param("s", $email);

        if(!$consulta->execute()) return $this->mysql->errno;

        $idUsuario = null;
        $pwHashed = "";

        $consulta->bind_result($idUsuario, $email, $pwHashed);
        $consulta->fetch();

                
        //Verificamos la contraseña.
        $passCorrecta = password_verify($pw, $pwHashed);

        //Y si la contraseña es correcta
        if($passCorrecta) {
            //Creamos cookies
            session_start();
            $_SESSION["id"] = $idUsuario;
            return true;
        }
        return false;
    }

    /**
     * Devuelve la consulta con la lista de pedidos del usuario.
     */
    function listaPedidos($idUsuario) {
        $sql = "SELECT idPedido, nombreAlbum, tipo, fecha FROM pedidos WHERE idUsuario=$idUsuario";

        $consulta = $this->consulta($sql);
        if(!$consulta) return $this->mysql->errno;

        return $consulta;
    }

    
    /**
     * Crea una nueva cuenta
     * @return - devuelve true si la inserción es correcta, código de error si no lo es.
     */
    function crearCuenta($nombre, $apellido, $correo, $pw) {

        $sql = "INSERT INTO usuarios(nombre, apellido, correo, pw) VALUES (?,?,?,?)";

        $consulta = $this->prepararConsulta($sql);

        $pwHashed = password_hash($pw, PASSWORD_DEFAULT);

        $consulta->bind_param("ssss",$nombre,$apellido, $correo, $pwHashed);

        if(!$consulta->execute()) return $this->mysql->errno;

        $consulta->close();
        //return $this->mysql->insert_id;
        return true;
    }

    /**
     * Añade un nuevo pedido a el usuario...
     * @return id del usuario que hizo el pedido. (para crear la carpeta)
     */
    function aniadirPedido($idUsuario, $tipo) {
        $sql = "INSERT INTO pedidos(idUsuario, tipo) VALUES('$idUsuario', '$tipo')";

        $consulta = $this->consulta($sql);

        if(!$consulta) return $this->mysql->errno;

        //$consulta->close();
        return $this->mysql->insert_id;
    }
    
}
