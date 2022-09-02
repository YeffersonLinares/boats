<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$fecha = $_GET['fecha'];
$id_vote = $_GET['id_vote'];

function validar_horas($wpdb, $fecha, $id_vote)
{
    try {
        $sql = "SELECT * FROM reserva WHERE fecha='$fecha' AND id_vote='$id_vote'";
    
        $data = mysqli_query($wpdb, $sql);
        $reserva = mysqli_fetch_array($data);   
        return json_encode($reserva);
    } catch (\Throwable $th) {
        $data = [
            'line' => $th->getLine(),
            'file' => $th->getFile(),
            'message' => $th->getMessage(),
        ];
    }

    // $response = true;

}

echo validar_horas($wpdb, $fecha, $id_vote);
