<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$fecha = $_GET['fecha_inicio_viaje'];
$id_vote = $_GET['id_vote'];

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

    // $response = true;

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

function response($reservas)
{
    $response = true;
    $ad = null;
    foreach ($reservas as $value) :
        $ad = $value['hora_inicio'];
        $ad2 = $value['hora_fin'];
        // if ($value['hora_inicio'] <='10:30' && $value['hora_fin'] >='10:30') {
        if ($value['hora_inicio'] <= '07:30:00' && $value['hora_fin'] >='07:30:00') {
            $response = false;
        }
        if ($value['hora_inicio'] <= '08:30:00' && $value['hora_fin'] >= '08:30:00') {
            $response = false;
        }
    endforeach;
    $data = [
        'desocupado' => $response,
        '$ad' => $ad,
        'ad2' => $ad2,
    ];
    return json_encode($data);
}

// echo validar_horas($wpdb, $fecha, $id_vote);
echo response(validar_horas($wpdb, $fecha, $id_vote));
