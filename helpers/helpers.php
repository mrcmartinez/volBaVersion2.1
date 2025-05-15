<?php
    define('CONTROLADOR', true);
    function base_url(){
        return URL;
    }
    function media(){
        return URL."/assets";
    }
    function check($n){
        $c="";
        if($n=="1"){
            $c="checked";
        }
        return $c;
    }
    function marcado($n){
        $c="❌";
        if($n=="1"){
            $c="✔️";
        }
        return $c;
    }
    function dep($data){
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }
    function edad($fecha_nacimiento){
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create(date("Y-m-d")));
        $edadCalculada = $edad_diff->format('%y');
        return $edadCalculada;
    }
    function diaSemana($fecha){
        $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        $dia = $dias[(date('N', strtotime($fecha))) - 1];
        return $dia;
    }
    function filtroHorario($filtro){
        if (empty($filtro)) {
            $c="Todo";
        }else{
            $c=$filtro;
        }
        return $c;
    }
    function consultarHoras($filtroHorario){
        $h_inicio='00:00:00';
        $h_fin='09:59:59';
        if ($filtroHorario=="Vespertino") {
            $h_inicio='10:00:00';
            $h_fin='16:00:00';
        }
        if (empty($filtroHorario)) {
            $h_inicio='00:00:00';
            $h_fin='16:00:00';
        }
        return array($h_inicio,$h_fin);
    }
    function consultarEntrada($filtroHorario){
        $h='09:00:00';
        if ($filtroHorario=="Vespertino") {
        $h='11:00:00';
        }
        return $h;
    }
    function consultarHoraLimite($filtroHorario){
        $h='09:30:00';
        if ($filtroHorario=="Vespertino") {
        $h='11:30:00';
        }
        return $h;
    }
    function colorTotalFalta($n){
        $c="";
        switch ($n) {
            case ($n===3):
                $c='class="td-candidato"';
                if ($n==0) {
                    $c='class="td-activo"';
                }
                break;
            case (($n<4)&&($n!=3)):
                $c='class="td-activo"';
                break;
            case ($n>=4):
                $c='class="td-baja"';
                break;
        }
        return $c;
    }
    function formatearFecha($fecha){
        $date=date_create($fecha);
        $date->format('%d-%b-%y');
        // $f=date_format($date, "%d-%b-%y");
        return $date;
    }
    function formatDay($fecha){
        $d = strtotime($fecha);
        $date = date("d", $d);
        return $date;
    }
    function formatMonth($fecha){
        $d = strtotime($fecha);
        $date = date("m", $d);
        return $date;
    }
    function formatYear($fecha){
        $d = strtotime($fecha);
        $date = date("Y", $d);
        return $date;
    }
    function observacion($tipo){
        $icon="";
        switch ($tipo) {
            case 'salud':
                $icon = "💊";
                break;
            case 'nota':
                $icon = "📝";
                break;
        }
        return $icon;
    }
?>