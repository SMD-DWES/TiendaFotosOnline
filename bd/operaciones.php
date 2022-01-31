<?php
require_once __DIR__. "/../config_bd.php";
class Operaciones
{
    private $mysql;
    function iniciar() {
        $this->mysql = new mysqli(HOST,USERNAME,PASSWORD,DATABASE);
        return $this->mysql;
    }

    /**
     * Prepara una consulta con la consulta pasada
     * @param sql  -> consulta pasada.
     */
    function prepararConsulta($sql) {
        return $this->mysql->prepare($sql);
    }

    function numFilas($consulta) {
        return $consulta->num_rows;
    }

    function consulta($sql) {
        return $this->mysql->query($sql);
    }

    function selectArray($consulta) {
        return $consulta->fetch_array(MYSQLI_ASSOC);
    }

}
