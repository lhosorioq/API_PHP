<?php

class respuestas {
    public $response = [
        'status' => "ok",
        'result' => []
    ];

    public function error_405(){
        $this->response['status'] = 'error';
        $this->response['resul'] = [
            'error_id' => '405',
            'error_msg' => 'Metodo no permitido'
        ];
        return $this->response;
    }

    public function error_200($string = 'Datos incorrectos'){
        $this->response['status'] = 'error';
        $this->response['resul'] = [
            'error_id' => '200',
            'error_msg' => $string
        ];
        return $this->response;
    }

    public function error_400(){
        $this->response['status'] = 'error';
        $this->response['resul'] = [
            'error_id' => '400',
            'error_msg' => 'Datos incompletos o formulario incorrecto'
        ];
        return $this->response;
    }

    public function error_500($valor = "Error interno de servidor"){
        $this->response['status'] = 'error';
        $this->response['resul'] = [
            'error_id' => '500',
            'error_msg' => $valor
        ];
        return $this->response;
    }
}
