<?php
require_once 'clases/auth.class.php';
require_once 'clases/respuestas.class.php';

// $_
$_respuesras = new respuestas();

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {

    // Recibir Datos
    $data = file_get_contents("php://input");

    // Envio de informacion al manejador
    $datosArray = $_auth->login($data);

    // Retornamos la respuesta con el formato exacto
    header('Content type: application/json');
    if ( isset ( $datosArray['result']['error_id'] ) ) {
        $responseCode = $datosArray['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} else {
    header('Content type: application/json');
    $datosArray = $_respuesras->error_405();
    echo json_encode($datosArray);
}
