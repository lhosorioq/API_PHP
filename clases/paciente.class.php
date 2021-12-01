<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class pacientes extends conexion {

    private $table = 'pacientes';
    
    public function listarPacientes($pagina)
    {
        $inicio = 0;
        $cantidad = 5;
        if ( $pagina > 1 ) {
            $inicio = ( $cantidad * ( $pagina - 1 ) ) + 1;
            $cantidad = $cantidad * $pagina;
        }
        $query = "SELECT PacienteId, Nombre, DNI, Telefono, Correo
            FROM {$this->table} 
            limit $inicio, $cantidad ";
        // print_r($query);
        $datos = parent::obtenerDatos($query);
        return $datos;
    }
    
    public function getId($id)
    {
        $query = "SELECT *
            FROM {$this->table} 
            WHERE PacienteId = $id";
        return parent::obtenerDatos($query);
    }

}