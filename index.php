<?php
require_once "clases/conexion/conexion.php";

$conexion = new conexion;

$query = "INSERT INTO pacientes (DNI) VALUE ('G000000007');";
print_r($conexion->nonQueryId($query));

// $query = "select * from pacientes ";
// print_r($conexion->obtenerDatos($query));