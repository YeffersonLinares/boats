<?php

$wpdb = mysqli_connect('localhost', 'root', 'KWsTepfFe3yWch3b8qHx');
mysqli_select_db($wpdb, 'nygboat2');

// if (isset($_REQUEST['form'])) {
$nombre = $_REQUEST['nombre'];
// echo $nombre;
$apellido = $_REQUEST['apellido'];
$direccion = $_REQUEST['direccion'];
$telefono = $_REQUEST['telefono'];
$email = $_REQUEST['email'];
$num_dni = $_REQUEST['num_dni'];
$image = $_FILES['image'];
// echo $image['type'];
// move_uploaded_file($_FILES['image']);

if (($_FILES["image"]["type"] == "image/pjpeg")
    || ($_FILES["image"]["type"] == "image/jpeg")
    || ($_FILES["image"]["type"] == "image/png")
    || ($_FILES["image"]["type"] == "image/gif")
) {
    // Falta la función de subir archivo
} else {
    echo 'formato no valido';
}


$alert_email = $_REQUEST['alert_email'];
$alert_whatsapp = $_REQUEST['alert_whatsapp'];
$tipo_doc = $_REQUEST['tipo_doc'];

$sql = "INSERT INTO user_reserva VALUES(0, '$nombre', '$apellido', '$direccion', '$telefono', '$email', '$num_dni', '$image', null,
null, '$tipo_doc', null, null)";

$user_reserva = mysqli_query($wpdb, $sql);

$sql = "SELECT id FROM user_reserva ORDER BY id";
$id = mysqli_query($wpdb, $sql);
$id = mysqli_fetch_all($id);
$id = $id[sizeof($id) - 1][0];

// echo json_encode($id[sizeof($id) - 1][0]);

$id_user_reserva = $id;
$id_vote = $_REQUEST['id_vote'];
$fecha = $_REQUEST['fecha_inicio_viaje'];
$tipo_fecha = $_REQUEST['tipo_fecha'];
$hora_inicio = $_REQUEST['horaInicio_viaje'];
$hora_fin = $_REQUEST['horafinal_viaje'];
$cant_adultos = $_REQUEST['cant_adultos'];
$cant_tres_doce = $_REQUEST['cant_tres_doce'];
$cant_uno_tres = $_REQUEST['cant_uno_tres'];
$cant_bebes = $_REQUEST['cant_bebes'];

$sql = "INSERT INTO reserva VALUES(0, $id_user_reserva, $id_vote, '$fecha', null, '$hora_inicio',
'$hora_fin', $cant_adultos, $cant_tres_doce, $cant_uno_tres, $cant_bebes, 1)";

// echo $sql;
mysqli_query($wpdb, $sql);


echo 'Exito';
