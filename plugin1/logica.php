<?php
$date = $_REQUEST['date'];
if (empty($date)) {
    $date = date('Y-m-d');
}

// $wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx', 'nygboat2');
$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');
// $fecha = $_GET['fecha'];

function index($wpdb, $date)
{
    try {

        // try {
        $horas_array = [
            '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00',
            '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
            '20:00', '20:30', '21:00', '21:30'
        ];

        $sql = "SELECT vote.id, vote.nombre, reserva.hora_inicio, reserva.hora_fin, reserva.id as reserva_id 
                FROM vote, reserva
                WHERE vote.id = reserva.id_vote AND
                reserva.fecha = '$date' AND
                vote.estado = 1";
        $data = mysqli_query($wpdb, $sql);
        $botes = map(mysqli_fetch_all($data));

        $data = array();

        foreach ($botes as $key => $value) :

            $data[$value['id']]['nombre'] = $value['nombre'];
            $data[$value['id']]['reserva_id'] = $value['reserva_id'];
            foreach ($horas_array as $index => $h) :
                $first = 0;
                if ($key >= 1 && $first = 0) {
                    $first = 1;
                    $horas_array[$index - 1]    = 2;
                }

                if (!isset($data[$value['id']]['horas'][$h]) ||  $data[$value['id']]['horas'][$h] == 0) :
                    if ($value['hora_inicio'] <= $h and $value['hora_fin'] >= $h) :
                        $data[$value['id']]['horas'][$h] = 1;
                        $data[$value['id']]['horas'][$horas_array[$index - 1]] = 1;
                        if (
                            $value['hora_inicio'] == $horas_array[$index - 1] . ":00" &&
                            $value['hora_inicio'] != '09:00:00'
                        ) :
                            $data[$value['id']]['horas'][$horas_array[$index - 2]] = 2;
                        endif;
                        if ($h . ':00' == $value['hora_fin'] &&  $value['hora_fin'] != '21:30:00') :
                            $data[$value['id']]['horas'][$h] = 3;
                        endif;
                    else :
                        $data[$value['id']]['horas'][$h] = 0;
                    endif;
                endif;
            endforeach;
        endforeach;

        $return = [
            'horas_array' => $horas_array,
            'reservas' => $data
        ];
        return json_encode($return, true);
    } catch (\Throwable $th) {
        echo 'error';
        echo $th->getMessage();
        echo $th->getLine();
    }
}
function map($data)
{
    $array = [];
    $index = 0;
    foreach ($data as $value) :
        $array[$index]['id'] = $value[0];
        $array[$index]['nombre'] = $value[1];
        $array[$index]['hora_inicio'] = $value[2];
        $array[$index]['hora_fin'] = $value[3];
        $array[$index]['reserva_id'] = $value[4];
        $index++;
    endforeach;
    return $array;
}

echo index($wpdb, $date);
