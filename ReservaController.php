<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

function getBarcos($wpdb)
{
    $sql = "SELECT id,nombre FROM vote WHERE estado=1";

    $data = mysqli_query($wpdb, $sql);
    // return json_encode(mysqli_fetch_all($data));
    $botes = map(mysqli_fetch_all($data));

    $data = [
        'botes' => $botes,
    ];

    return json_encode($data, true);
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

echo getBarcos($wpdb);