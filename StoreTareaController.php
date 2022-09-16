<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$comentarios = str_replace('_', ' ', $_REQUEST['comentarios']);
$asignada_para = str_replace('_', ' ', $_REQUEST['asignada_para']);
$vote_id = str_replace('_', ' ', $_REQUEST['vote_id']);
$tipo_atencion = str_replace('_', ' ', $_REQUEST['tipo_atencion']);
$fecha = str_replace('_', ' ', $_REQUEST['fecha']);

$sql = "INSERT INTO wp_tarea VALUES(0, '$comentarios', '$asignada_para', '$vote_id', '$tipo_atencion', '$fecha')";
$query = mysqli_query($wpdb, $sql);

$response = [
    'status' => 200,
    'msg' => 'Datos guardados con éxito',
];


echo json_encode($response);