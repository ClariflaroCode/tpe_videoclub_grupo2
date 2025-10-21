<?php

    class DirectorView {
        function __construct() {
        
        }
        public function showDirectors($directors, $request) {
            require_once 'templates/header.phtml';
            $formatted = [];
            foreach($directors as $director) {
                $formatted[] = $this->getFormatData($director);
            }
            $directors = $formatted;
            require_once 'templates/director_table.phtml';
            require_once 'templates/footer.phtml';
        }
        public function showForm($action_form, $director, $request) {
            require_once 'templates/header.phtml';
            if($director) { //esto es para mostrar los datos del director en el formulario al editar
                $nombre = $director->nombre;
                $sexo = $director->sexo;
                $fecha = $director->fecha_nacimiento;
                $reputacion = $director->reputacion;
                $pais = $director->pais_origen;
                $imagen = $director->imagen;
            }
            require_once './templates/director_form.phtml';
            require_once 'templates/footer.phtml';
        }
        public function showError($error) {
            echo "$error";
        }
        public function listDirectors($directors, $request) {
            require_once 'templates/header.phtml';
            $formatted = [];
            foreach($directors as $director) {
                $formatted[] = $this->getFormatData($director);
            }
            $directors = $formatted;
            require_once './templates/directors_list.phtml';
            require_once 'templates/footer.phtml';
        }
        private function getFormatData($data) {
            //No valida nada, solamente formatea los datos para que se muestren más bonitos 
            $normalizarGenero = [
                "m" => "masculino",
                "f" => "femenino", 
            ];
            foreach ($normalizarGenero as $genero => $traduccion) {
                if ($data->sexo == $genero) {
                    $data->sexo = $traduccion;
                    break;
                }
            }

            $fecha = explode("-", $data->fecha_nacimiento);
            $anio = $fecha[0];
            $mes = $fecha[1];
            $dia = $fecha[2];

            $normalizarMes = [
                "01" => "Enero",
                "02" => "Febrero", 
                "03" => "Marzo",
                "04" => "Abril",
                "05" => "Mayo", 
                "06" => "Junio",
                "07" => "Julio", 
                "08" => "Agosto", 
                "09" => "Septiembre", 
                "10" => "Octubre",
                "11" => "Noviembre", 
                "12" => "Diciembre"
            ];
            foreach ($normalizarMes as $numeroMes => $nombreMes) {
                if ($mes == $numeroMes) {
                    $mes = $nombreMes;
                    break;
                }
            }
            $fechaNormalizada = "$dia" . " de " . "$mes" . " de " . "$anio";
            $data->fecha_nacimiento = $fechaNormalizada;
            return $data;
        }
    }

?>
