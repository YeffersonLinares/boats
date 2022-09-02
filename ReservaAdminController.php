<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$reserva_id = $_GET['reserva_id'];

function reservas($wpdb, $reserva_id)
{
    $sql = "SELECT *
        FROM reserva, vote, user_reserva
        WHERE reserva.id_vote = vote.id AND
        user_reserva.id = reserva.id_user_reserva AND
        reserva.id = $reserva_id
        LIMIT 1";
    $data = mysqli_query($wpdb, $sql);
    $reservas = mysqli_fetch_array($data);

    // $reservas = map(mysqli_fetch_all($data));
    return json_encode($reservas);
}

echo reservas($wpdb, $reserva_id);

function map($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $value) {
        $array['cant_adultos'] = $value[1];
        $array['cant_bebes'] = $value[8];
        $array['cant_tres_doce'] = $value[9];
        $array['cant_uno_tres'] = $value[10];
        $array['fecha'] = $value[3];
        $array['hora_inicio'] = $value[5];
        $array['hora_fin'] = $value[6];
        $index++;
    }
    return $array;
}
