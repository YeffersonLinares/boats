<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$reserva_id = $_GET['reserva_id'];

function get_reservas($wpdb)
{
    $sql = "SELECT fecha FROM reserva GROUP BY fecha";
    $query = mysqli_query($wpdb, $sql);
    $data = map(mysqli_fetch_all($query));
    $reservas = get_reservas_fecha($data, $wpdb);
    return json_encode($reservas, true);
}

function map($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $value) :
        $array[$index]['fecha'] = $value[0];
        $index++;
    endforeach;
    return $array;
}

function map_reservas($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $value) :
        $array[$index]['hora_inicio'] = $value[5];
        $array[$index]['hora_fin'] = $value[6];
        $array[$index]['nombre'] = $value[13];
        $array[$index]['reserva_id'] = $value[0];
        $index++;
    endforeach;
    return $array;
}

function get_reservas_fecha($data, $wpdb)
{
    $array = [];
    $index = 0;
    foreach ($data as $value) {
        // return $value;
        // $sql = "SELECT * FROM reserva WHERE fecha = '2022-09-05'";
        $sql = "SELECT *, reserva.id as reserva_id FROM reserva,vote  WHERE fecha='" . $value['fecha'] . "'
        AND vote.id = reserva.id_vote";
        $query = mysqli_query($wpdb, $sql);
        $datos = map_reservas(mysqli_fetch_all($query));
        // $datos = mysqli_fetch_array($query);
        $array[$value['fecha']] = $datos;
    }
    return $array;
}

echo get_reservas($wpdb);
