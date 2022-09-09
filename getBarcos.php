<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

$vote_id = $_GET['vote_id'];

function getBarcos($wpdb)
{
    $sql = "SELECT * FROM vote WHERE estado=1";
    $data = mysqli_query($wpdb, $sql);
    $botes = map_barcos(mysqli_fetch_all($data));
    return json_encode($botes, true);
}

function map_barcos($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $value) {
        $array[$index]['id'] = $value[0];
        $array[$index]['nombre'] = $value[1];
        $index++;
    }
    return $array;
}

echo getBarcos($wpdb, $vote_id);
