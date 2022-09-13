<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$vote_id = $_GET['vote_id'];

function getBarcos($wpdb, $vote_id)
{
    try {
        $sql = "SELECT id,nombre FROM vote WHERE estado=1";

        $data = mysqli_query($wpdb, $sql);
        $botes = map(mysqli_fetch_all($data));

        if (empty($vote_id)) {
            $sql = "SELECT reserva.id, reserva.hora_inicio, reserva.hora_fin, vote.id, vote.nombre, reserva.fecha
                FROM reserva,vote 
                WHERE 
                vote.id = reserva.id_vote";
        } else {
            $sql = "SELECT reserva.id, reserva.hora_inicio, reserva.hora_fin, vote.id, vote.nombre, reserva.fecha
                FROM reserva,vote 
                WHERE  vote.id = reserva.id_vote AND
                vote.id = $vote_id";
        }
        $data = mysqli_query($wpdb, $sql);
        // return json_encode(1);
        $calendar = map_calendar(mysqli_fetch_all($data));
        // $calendar = mysqli_fetch_array($data);

        $data = [
            'botes' => $botes,
            'calendar' => $calendar
        ];

        return json_encode($calendar, true);
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
        // $array[$index]['id'] = $value[0];
        $array[$index]['title'] = $value[1] . ' - ' . $value[2] . ' ' . $value[4];
        $array[$index]['start'] = $value[5];
        $array[$index]['url'] = "https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/ResumeReservaAdmin.html?reserva_id=" . $value[0];
        // $array[$index]['id'] = $value[0];
        // $array[$index]['hora_inicio'] = $value[1];
        // $array[$index]['hora_fin'] = $value[2];
        // $array[$index]['nombre'] = $value[4];
        // $array[$index]['fecha'] = $value[5];
        $index++;
    endforeach;

    return $array;
}

echo getBarcos($wpdb, $vote_id);
