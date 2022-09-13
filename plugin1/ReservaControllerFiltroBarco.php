<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

function getBarcos($wpdb)
{
    try {
        $date = date('Y-m');
        $sql = "SELECT id,nombre FROM vote WHERE estado=1";

        $data = mysqli_query($wpdb, $sql);
        $botes = map(mysqli_fetch_all($data));

        $sql = "SELECT reserva.id, reserva.hora_inicio, reserva.hora_fin, vote.id, vote.nombre, reserva.fecha
            FROM reserva,vote 
            WHERE 
            vote.id = reserva.id_vote AND
            reserva.fecha >= '$date-01' AND 
            reserva.fecha <= '$date-30'
            ORDER BY reserva.fecha";
        $data = mysqli_query($wpdb, $sql);
        // return json_encode(1);
        $calendar = map_calendar(mysqli_fetch_all($data));
        // $calendar = mysqli_fetch_array($data);

        $data = [
            'botes' => $botes,
            'calendar' => $calendar
        ];

        return json_encode($data, true);
    } catch (\Throwable $th) {
        $data = [
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'message' => $th->getMessage(),
        ];
        return json_encode($data, true);
    }
}

function map($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $key => $value) :
        $array[$index]['id'] = $value[0];
        $array[$index]['nombre'] = $value[1];
        $index++;
    endforeach;

    return $array;
}

function map_calendar($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $key => $value) :
        $array[$index]['id'] = $value[0];
        $array[$index]['hora_inicio'] = $value[1];
        $array[$index]['hora_fin'] = $value[2];
        $array[$index]['nombre'] = $value[4];
        $array[$index]['fecha'] = $value[5];
        $index++;
    endforeach;

    return $array;
}

echo getBarcos($wpdb);
