<?php
/**
 * @author Sergio Matamoros Delgado
 * @description: Desloguea tu cuenta.
 */
session_start();

$_SESSION = null;

//Destruimos la sesión
session_destroy();

//Reedirigimos al login
header("Location: ../public/account/login.php");