<?php

$reserva = $_SERVER["REQUEST_URI"];
if ($reserva == '/boats/reservas_admin/') {
    require 'Reserva_mes.html';
}


add_shortcode('registrocliente', 'admin_clientes');

function admin_clientes()
{
    global $wpdb;
    global $current_user, $user_login;

    ?>
    <h1> Entroa cliente </h1>

    <?php
}
