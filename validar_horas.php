<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$fecha = $_GET['fecha_inicio_viaje'];
$id_vote = $_GET['id_vote'];
$hora_inicio = $_GET['hora_inicio'];
$hora_fin = $_GET['hora_fin'];

function validar_horas($wpdb, $fecha, $id_vote)
{
    try {
        $sql = "SELECT * FROM reserva WHERE fecha='$fecha' AND id_vote='$id_vote'";

        $data = mysqli_query($wpdb, $sql);
        $reserva = map(mysqli_fetch_all($data));
        return $reserva;
    } catch (\Throwable $th) {
        $data = [
            'line' => $th->getLine(),
            'file' => $th->getFile(),
            'message' => $th->getMessage(),
        ];
    }
}

function map($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $key => $value) {
        $array[$index]['hora_fin'] = $value[6];
        $array[$index]['hora_inicio'] = $value[5];
        $array[$index]['cant_adultos'] = $value[7];
        $array[$index]['cant_bebes'] = $value[8];
        $array[$index]['cant_tres_doce'] = $value[9];
        $array[$index]['cant_uno_tres'] = $value[10];
    }
    return $array;
}

function response($reservas, $hora_inicio, $hora_fin)
{
    $response = true;
    foreach ($reservas as $value) :
        if ($value['hora_inicio'] <= $hora_inicio && $value['hora_fin'] >= $hora_inicio) :
            $response = false;
        endif;
        if ($value['hora_inicio'] <= $hora_fin && $value['hora_fin'] >= $hora_fin) :
            $response = false;
        endif;
        if ($hora_inicio <= $value['hora_inicio'] && $hora_fin >= $value['hora_fin']) :
            $response = false;
        endif;
    endforeach;
    $data = [
        'desocupado' => $response,
    ];

    return json_encode($data);
}

echo response(validar_horas($wpdb, $fecha, $id_vote), $hora_inicio, $hora_fin);
