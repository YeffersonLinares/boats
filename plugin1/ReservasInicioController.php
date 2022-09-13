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
    return json_encode($data, true);
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

function get_reservas_fecha($data, $wpdb)
{
    $array = [];
    $index = 0;
    foreach ($data as $key => $value) {
        $sql = "SELECT * FROM reserva";
    }
}

echo get_reservas($wpdb);
