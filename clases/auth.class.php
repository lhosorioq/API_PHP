<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class auth extends conexion {

    public function login($datoJson) {
        $_respuestas = new respuestas;
        $data = json_decode($datoJson, true);
        if ( !isset($data['usuario']) || !isset($data['password'] ) ) {
            return $_respuestas->error_400();
        } else {
            $usuario = $data['usuario'];
            $password = $data['password'];
            $password = parent::encriptar($password);
            $datos = $this->obtenerDatosUsuario($usuario);
            if( $datos ) {
                // si hay datos, se crea el token
                if ( $password == $datos['Password'] ) {
                    if ( $datos['Estado'] == 'Activo' ) {
                        $verificar = $this->token($datos[0]['UsiarioId']);
                        if ( $verificar ) {
                            $result = $_respuestas->response;
                            $result['result'] = [
                                "token" => $verificar
                            ];
                            return $result;
                        } else {
                            return $_respuestas->error_500("Error interno. No hemos podido guardar el Token");
                        }
                    } else {
                        return $_respuestas->error_200("El usuario $usuario no esta activo.");
                    }
                } else {
                    return $_respuestas->error_200("El password para $usuario no es correcto.");
                }
            } else {
                // no existen datos. Nada de token
                return $_respuestas->error_200("El usuario $usuario no existe.");
            }
        }
    }

    private function obtenerDatosUsuario($correo) {
        $query = " SELECT UsuarioId, Password, Estado FROM usuarios
            WHERE Usuario = '$correo' ";
        $datos = parent::obtenerDatos($query);
        if ( isset ( $datos[0]['UsuarioId'] ) ) {
            return $datos;
        } else {
            return 0;
        }
    }

    private function token($usuarioId) {
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(12, $val));
        $fecha = date('Y-m-d H:i');
        $estado = 'Activo';
        $query = "INSERT INTO usuarios_token (UsuarioId, Token, Estado, Fecha) VALUE ('$usuarioId', '$token', '$estado', '$fecha');";
        $verifica = parent::nonQuery($query);
        if ( $verifica ) {
            return $token;
        } else {
            return 0;
        }
    }
}
