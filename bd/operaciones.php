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

    function num_filas($consulta) {
        $consulta->num_rows;
    }

}
