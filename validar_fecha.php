<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$fecha = $_GET['fecha'];

function fechas($wpdb, $fecha)
{
    $hour = '16:00';
    $sql = "SELECT * FROM reservas
        WHERE reservas.";
    $data = mysqli_query($wpdb, $sql);
    $schedules = mysqli_fetch_all($data);
    return json_encode($schedules);
}

echo fechas($wpdb, $fecha);
// echo json_encode($schedules);

// echo $fecha;
