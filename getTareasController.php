<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$sql = "SELECT fecha FROM wp_tarea GROUP BY fecha ORDER BY fecha DESC";
$query = mysqli_query($wpdb, $sql);
$fechas = map_fechas(mysqli_fetch_all($query));
$data = getTareas($fechas, $wpdb);
$response = [
    'tareas' => $data
];
echo json_encode($response, true);

function map($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $value) :
        $array[$index]['comentarios'] = $value[1];
        $array[$index]['asignada_para'] = $value[2];
        $array[$index]['vote_id'] = $value[3];
        $array[$index]['tipo_atencion'] = $value[4];
        $array[$index]['fecha'] = $value[5];
        $index++;
    endforeach;
    return $array;
}

function getTareas($fechas, $wpdb)
{
    $array = [];
    foreach ($fechas as $value) :
        $sql = "SELECT * FROM wp_tarea WHERE fecha=" . "'" . $value['fecha'] . "'";
        $query = mysqli_query($wpdb, $sql);
        $datos = map(mysqli_fetch_all($query));
        $array[$value['fecha']] = $datos;
    endforeach;
    return $array;
}

function map_fechas($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $key => $value) :
        $array[$index]['fecha'] = $value[0];
        $index++;
    endforeach;
    return $array;
}
