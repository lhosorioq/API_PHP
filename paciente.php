<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/paciente.class.php';

$_respuestas = new respuestas;
$_pacientes  = new pacientes;

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    if ( isset ( $_GET['page'] ) ) {
        $pagina = $_GET['page'];
        $listarPacientes = $_pacientes->listarPacientes($pagina);
        echo json_encode($listarPacientes);
    } else if ( isset ( $_GET['id'] ) ) {
        $id = $_GET['id'];
        $listarPaciente = $_pacientes->getId($id);
        echo json_encode($listarPaciente);
    }
} else if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    echo ' Hola POST';
} else if ( $_SERVER['REQUEST_METHOD'] == 'PUT' ) {
    echo ' Hola PUT';
} else if ( $_SERVER['REQUEST_METHOD'] == 'DELETE' ) {
    echo ' Hola DELETE';
} else {
    header('Content Type: application/json');
    $datosArray = $_respuesras->error_405();
    echo json_encode($datosArray);
}