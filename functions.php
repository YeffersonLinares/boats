<?php
$uri = $_SERVER["REQUEST_URI"];
?>

<script src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<link rel="stylesheet" href="/boats/wordpress/wp-content/themes/twentytwentytwo/style.css">
<link rel="stylesheet" href="/boats/wp-content/themes/twentytwentytwo/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- datepicker -->

<link href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Full Calendar -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Base64/1.1.0/base64.js"></script>

<div x-data="app_alpine()">

    <div class="spinner" x-show="loading">
        <div class="caja_img">
            <div class="lds-facebook">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <?php
    if ($uri == '/boats/reserva/' || $uri == '/boats/wordpress/' || $uri == '/boats/reserva') {
        // include_once "Reserva_mes.html";
        // include_once "Reserva_mes.html";
        // include_once "AdministradorClientesIndex.html";
        include_once "Administrador.php";

        // include_once "reserva.html";
        // include_once 'ReservaUsuarioTimeline.html';
    }
    ?>
    <template x-if="pantalla!='reserva_usuario'">
        <div class="row flex-lg-nyg-column-reverse mt-7">
            <div class="px-lg-5" x-bind:class="[pantalla=='ReservaUsuarioFinal' ? 'col-lg-12' : 'col-lg-9']">
                <?php
                include_once "BarcosReservaUsuario.html";
                include_once "ReservaUsuarioFecha.html";
                include_once "ReservaUsuarioHoras.html";
                include_once "ReservaUsuarioResponsable.html";
                include_once "ReservaUsuarioAsistencia.html";
                include_once "ReservaUsuarioExtra.html";
                include_once "ReservaUsuarioPagos.html";
                include_once "ReservaUsuarioFinal.html";
                ?>
            </div>
            <div class="col-12 col-lg-3 mb-3">
                <?php
                include_once "ReservaUsuarioResume.html";
                ?>
            </div>
        </div>
    </template>
    <?php
    if ($uri == '/boats/reservas_admin/' || $uri == '/wordpress/reservas_admin/') {
        include_once 'Reserva_mes.html';
    }
    ?>
</div>

<script>
    function app_alpine() {
        return {
            init() {
                // $('.wp-site-blocks').addClass('d-none')
            },
            pantalla: 'reserva_usuario',
            // pantalla: 'ReservaUsuarioResponsable',
            loading: false,
            // base_url: 'https://botelaravel.rutaapp.com',
            base_url: 'https://127.0.0.1:443/BoatsLaravel/public',
            form_reserva: {
                //-------------------------------------------------------------------------
                // Tabla reserva
                //-------------------------------------------------------------------------
                id: '',
                id_vote: '',
                fecha_inicio_viaje: '',
                horaInicio_viaje: '',
                horafinal_viaje: '',
                cant_adultos: 0,
                cant_tres_doce: 0,
                cant_uno_tres: 0,
                cant_bebes: 0,

                fianza: '',
                reserva_flex: '',
                total_factura: '',
                medio_pago: '',
                zona_horaria: '',
                capitan_barco: '',

                //-------------------------------------------------------------------------
                // User reserva
                //-------------------------------------------------------------------------

                nombre: '',
                apellido: '',
                direccion: '',
                telefono: '',
                email: '',
                num_dni: '',
                imagen_documento: '',
                imagen_titulo: '',
                alert_email: '',
                alert_whatsapp: '',
                tipo_doc: '',
                titulado: '',
                password: '',
                password_confirmation: '',
                crear_cuenta: '',

                //-------------------------------------------------------------------------
                // Tabla extras reserva
                //-------------------------------------------------------------------------

                id_reserva: '',
                id_extra: '',
                _token: '',
                extras: []
            },
            form_resumen: {
                image_bote: '',
                nombre_bote: '',
                fecha: '',
                hora_inicio: '',
                hora_fin: '',
                cant_ninios: '',
                cant_adultos: '',
                responsable: '',
                valor_extras: 0,
                extras: [],
                total: 0,
                precio_bote: '',

            },
            bote: {
                valor_capitan: 50,
                reserva_sin_titulacion: 0
            },
            cant_personas: 0,
            precio_horas_extra: 0,
            auxiliares: {
                tipo_reserva: ''
            },
        }
    }
</script>