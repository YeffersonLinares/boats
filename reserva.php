<?php


add_shortcode('reservas_usuario', 'plugin_reservas_usuario');

function plugin_reservas_usuario()
{
    global $wpdb;
    global $current_user, $user_login;
    if (isset($_POST['form'])) {
        $data = [
            'nombre' => $_POST['form']['nombre'],
            'apellido' => $_POST['form']['apellido'],
            'direccion' => $_POST['form']['direccion'],
            'telefono' => $_POST['form']['telefono'],
            'email' => $_POST['form']['email'],
            'num_dni' => $_POST['form']['num_dni'],
            'image' => $_POST['form']['image'],
            'alert_email' => $_POST['form']['alert_email'],
            'alert_whatsapp' => $_POST['form']['alert_whatsapp'],
            'tipo_doc' => $_POST['form']['tipo_doc'],
        ];
        $wpdb->insert('user_reserva', $data);
        $id = $wpdb->insert_id;
        $data_reserva = [
            'id_user_reserva' => $id,
            'id_vote' => $_POST['form']['id_vote'],
            'fecha' => $_POST['form']['fecha_inicio_viaje'],
            'tipo_fecha' => $_POST['form']['tipo_fecha'],
            'hora_inicio' => $_POST['form']['horaInicio_viaje'],
            'hora_fin' => $_POST['form']['horafinal_viaje'],
            'cant_adultos' => $_POST['form']['cant_adultos'],
            'cant_tres_doce' => $_POST['form']['cant_tres_doce'],
            'cant_uno_tres' => $_POST['form']['cant_uno_tres'],
            'cant_bebes' => $_POST['form']['cant_bebes'],
        ];

        $wpdb->insert('reserva', $data_reserva);

        die();
    }

?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Inicio Pantalla uno -->
    <div class="container">
        <div class="timeline d-flex fixed-top bg-white pt-5">
            <div class="events">
                <ol>
                    <ul>
                        <li>
                            <a href="#0" class="selected"> <span class="span-time-line"> Start </span> </a>
                            <i class="fas fa-flag-checkered fa-xs center-li-icon"></i>
                        </li>
                        <li id="timeline_barco" data-bandera="1">
                            <a href="#1" class="selected">
                                <span class="span-time-line"> Barco </span>
                            </a>
                            <i class="fas fa-ship fa-xs center-li-icon-barco"></i>
                            <!-- <i class="fas fa-flag-checkered fa-xs center-li-icon"></i> -->
                        </li>
                        <li id="timeline_fecha" data-bandera="2">
                            <a href="#2" class="selected"> <span class="span-time-line"> Fecha </span> </a>
                            <i class="fas fa-calendar-check fa-xs center-li-icon-fecha"></i>
                        </li>
                        <li id="timeline_horario" data-bandera="3">
                            <a href="#3" class="selected"> <span class="span-time-line"> Horario </span> </a>
                            <i class="fas fa-clock fa-xs center-li-icon-horario"></i>
                        </li>
                        <li id="timeline_barco" data-bandera="4">
                            <a href="#3" class="selected"> <span class="span-time-line"> Responsable </span> </a>
                            <i class="fas fa-dharmachakra fa-xs center-li-icon-responsable"></i>
                        </li>
                        <li id="timeline_asistencia" data-bandera="4">
                            <a href="#3" class="selected"> <span class="span-time-line"> Asistencia </span> </a>
                            <i class="fas fa-users fa-xs center-li-icon-asistencia"></i>
                        </li>
                        <li id="timeline_extras" data-bandera="5">
                            <a href="#3" class="selected"> <span class="span-time-line"> Extras </span> </a>
                            <i class="fas fa-briefcase fa-xs center-li-icon-barco"></i>
                        </li>
                        <li id="timeline_pago" data-bandera="6">
                            <a href="#3" class="selected"> <span class="span-time-line"> Pago </span> </a>
                            <i class="fas fa-credit-card fa-xs center-li-icon-pago"></i>
                        </li>
                        <li>
                            <a href="#3" class="selected"> <span class="span-time-line"> End </span> </a>
                            <i class="fas fa-flag-checkered fa-xs center-li-icon-end"></i>
                        </li>
                    </ul>
                </ol>
            </div>
        </div>

        <!-- Final Pantalla uno -->

        <!-- Inicio pantalla Barcos -->
        <div class="container-fluid mt-7" id="type_booking">

            <div class="w-100 text-center my-5">
                <h3>¿Qué tipo de reserva deseas?</h3>
            </div>
            <div class="container d-flex justify-content-between flex-column flex-md-row">
                <!-- <button class="w-50"> -->
                <!-- <button class="btn btn-transparent"> -->
                <div class="card w-card" id="por_barco">
                    <div class="card-body">
                        <img src="<?php echo imagen(1) ?>" alt="">
                        <h4 class="card-title">Reserva Por Barco</h4>
                        <p class="card-text">Determina el barco que más te gusta y te diremos las fechas y horarios
                            que
                            está
                            disponible.</p>
                        <a href="#" class="card-link"><b>Comenzar la reserva</b> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- </button> -->
                <!-- </button>
                <button class="btn btn-transparent w-50"> -->
                <div class="card w-card" id="por_fechas">
                    <div class="card-body">
                        <img src="<?php echo imagen(2) ?>" alt="">
                        <h4 class="card-title">Reserva Por Fecha</h4>
                        <p class="card-text">Dinos qué fecha o rango de fechas deseas navegar y te diremos que
                            embarcaciones tenemos disponibles.</p>
                        <a href="#" class="card-link"><b>Comenzar la reserva</b> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- </button> -->
            </div>
        </div>
        <!-- Fin pantalla Barcos -->

        <div class="container-fluid d-none mt-7" id="barco">
            <div class="row flex-lg-nyg-column-reverse">
                <div class="col-12 col-lg-9">
                    <div class="d-flex flex-column align-items-between">
                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-3 g-4">
                            <?php

                            $registros2 = $wpdb->get_results("SELECT * FROM `vote` where estado=1");
                            $i = 0;
                            foreach ($registros2 as $key => $vote) {
                            ?>
                                <?php
                                $registros22 = $wpdb->get_results("SELECT * FROM `vote_detalle` where id_vote=" . $vote->id);
                                $registros33 = $wpdb->get_results("SELECT * FROM `vote_valores` where id_vote=" . $vote->id);
                                ?>
                                <div class="col d-flex justify-content-center">
                                    <div class="card size-card">
                                        <button data-vote='<?php echo json_encode($vote) ?>' data-registros='<?php echo json_encode($registros33) ?>' class="btn btn-transparent icon-gray position-absolute end-0 text-white details_barco"><i class="fas fa-search-plus fa-lg m-2"></i></button>
                                        <div class="">
                                            <button class="btn btn-direction position-absolute top-25"><i class="fas fa-chevron-left"></i></button>
                                            <button class="btn btn-direction position-absolute top-25 end-0"><i class="fas fa-chevron-right"></i></button>
                                            <img src=".<?php echo $vote->principal ?>" class="card-img-top size-img-grid" alt="...">
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title"><b class="color-gray"><?php echo $vote->nombre ?></b></h5>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center p-2">
                                                    <button class="btn btn-transparent icon-gray"><i class="fas fa-user"></i></button>
                                                    <span class="position-relative top-20 mx-2 color-gray" style="font-size: .8rem;">Sin
                                                        titulación</span>
                                                </div>
                                                <div>
                                                    <button class="btn btn-transparent icon-gray"><i class="fas fa-users fa-xs"></i><span class="mx-2">6</span> </button>
                                                    <button class="btn btn-transparent icon-gray"><i class="fas fa-arrow-left fa-xs"></i>
                                                        <i class="fas fa-arrow-right fa-xs"></i></button>
                                                    <span class="icon-gray" style="font-size: .8rem">4,9mts</span>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="d-flex justify-content-between align-items-center mt-2">


                                                <div class="d-flex flex-column mr-3">
                                                    <?php
                                                    foreach ($registros33 as $rr) {
                                                    ?>
                                                        <strong class="color-gray f-8"><?php echo $rr->horas ?>hs <?php echo $rr->valor ?>€</strong>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                                <div>
                                                    <button class="btn btn-blue barco-to-asis" detalle='<?php echo json_encode($registros22) ?>' valores='<?php echo json_encode($registros33) ?>' data-valor="<?php echo $vote->valor ?>" imagen=".<?php echo $vote->principal ?>" id="<?php echo $vote->id ?>" nombre="<?php echo $vote->nombre ?>">Seleccionar <i class="fas fa-arrow-alt-circle-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php

                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-3">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white">
                        <a class="navbar-brand" href="#"></a>
                        <button class="navbar-toggler btn-toggle-nyg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-list"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="d-flex flex-column align-items-between border mt-2 w-100">
                                <div class="contenido"></div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Inicio pantalla seleccion fechas -->
    <div class="container d-none mt-7" id="seleecion_fechas">
        <div class="row flex-lg-nyg-column-reverse">
            <div class="col-12 col-lg-9 mb-4">
                <div class="w-100 text-center my-5">
                    <h3>¿Qué fechas deseas?</h3>
                </div>

                <div class="w-100 text-center my-5">
                    <div class="row">
                        <div class="col-12 col-md-4"></div>
                        <div class="col-12 col-md-4">
                            <input type="date" class="form-control" name="fecha_asignada" id="fecha_asignada">
                        </div>
                        <div class="col-12 col-md-4"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-center w-100 colocarBotones d-none">

                </div>
                <div class="buttons-defect d-none">
                    <div class="d-flex justify-content-center w-100" id="button-day">
                        <div class="container-btn zone_hour">
                            Por la mañana
                        </div>
                        <div class="container-btn zone_hour">
                            Por la tarde
                        </div>
                        <div class="container-btn zone_hour">
                            Todo el día
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-3 d-flex flex-column align-items-between border">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <button class="navbar-toggler btn-toggle-nyg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex flex-column align-items-between border mt-2 w-100">
                            <div class="contenido"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- fin pantalla seleccion fechas -->


    <!-- Inicio pantalla seleccion hora -->
    <div class="container d-none mt-7" id="seleecion_hora">
        <div class="row flex-lg-nyg-column-reverse">
            <div class="col-12 col-lg-9">
                <div class="w-100 text-center my-5">
                    <h3>La disponibilidad horaria de esta embarcación <span class="texto_seleccion"> </span> </h3>
                </div>

                <div class="incluirBotonesHorario btns-hour"></div>
                <div class="regresoBotonesHorario btns-hour"></div>





                <button class="btn btn-blue seguir_registro d-none" id="seleccionar_horario_button">Seleccionar <i class="fas fa-arrow-alt-circle-right"></i></button>

            </div>
            <div class="col-12 col-lg-3 d-flex flex-column align-items-between border">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <button class="navbar-toggler btn-toggle-nyg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex flex-column align-items-between border mt-2 w-100">
                            <div class="contenido"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- fin pantalla seleccion hora -->


    <!-- Inicio pantalla Usuario_registro -->
    <div class="container d-none mt-7" id="seleecion_registro">
        <div class="row flex-lg-nyg-column-reverse">
            <div class="col-12 col-lg-9 container">
                <div class="w-100 text-center my-5">
                    <h4 style="font-weight: bold"> <strong> Responsable de embarcación </strong> </h4>
                </div>
                <form id="form_responsable">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="f-9">Nombre/s*:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" maxlength="40">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="f-9">Apellido/s*:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" maxlength="40">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="f-9">Dirección/Ciudad*:</label>
                                <input type="text" name="nombre" id="ciudad" class="form-control" maxlength="40">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label class="f-9">Telefono*:</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" maxlength="20">
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label class="f-9">Email*:</label>
                                <input type="text" name="email" id="email" class="form-control" maxlength="40">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label class="f-9">Dispone de titulación requerida:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group d-flex">
                                <input type="radio" name="titulacion" checked='true' value="titulado" id="no_tengo" class="me-1">
                                <label for="no_tengo" class="f-8"> No tengo titulo </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group d-flex">
                                <input type="radio" name="titulacion" value="no titulado" id="si_tengo" class="me-1">
                                <label for="si_tengo" class="f-8"> Si tengo titulo </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="f-9">Tipo de doc.:</label>
                                <select id="tipo_doc" name="tipo_doc" class="form-select">
                                    <option value='DNI'>DNI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="f-9">Número ID:</label>
                                <input type="text" name="numeroId" id="numeroId" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <script>
                            var preview = false;
                            $('body').on('click', '#preview-archivo', function() {
                                $('#archivo').trigger('click')
                            })

                            $('body').on('click', '#btn-preview', function() {
                                $('#archivo').trigger('click')
                            })

                            function readImage(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#blah').attr('src', e.target.result); // Renderizamos la imagen
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $('body').on('change', '#archivo', function() {
                                readImage(this);
                                $('#blah').removeClass('d-none')
                                $('#preview-archivo').addClass('d-none')
                            })
                        </script>

                        <button type="button" class="btn btn-transparent d-flex shadow-none" id="btn-preview">
                            <img class="d-none my-4 ms-3" id="blah" alt="Tu imagen" style="width: 24rem; height: 14rem;" />
                        </button>

                        <div class="btn btn-transparent col-12 col-md-12 col-lg-6 col-xl-3 my-4 text-start" id="preview-archivo" style="width:20rem;">
                            <div class="container" id="image-driver">
                                <!-- <button class="btn btn-transparent"> -->
                                <label class="form-label f-9" for="">Foto de documento*:</label>
                                <div class="container rounded d-flex flex-column justify-content-start align-items-center border-dotted p-4">
                                    <button type="button" class="btn btn-transparent icon-gray"><i class="fas fa-address-card font-32"></i></button>
                                    <span class="color-gray f-9">Cuelga tu imagen aquí o</span>
                                    <span class="color-blue f-9"><b>Descarga desde tu dispositivo</b></span>
                                    <span class="icon-gray f-8">Máximo 1234 x 1234 px</span>
                                </div>

                                <!-- </button> -->
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="archivo" id="archivo" class="d-none" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group d-flex">
                                <input class="me-3" type="checkbox" name="aleta_email" id="aleta_email" class="">
                                <label class="f-9" for="aleta_email">Deseo recibir una alerta en mi email llegando el dia de la reserva</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group d-flex">
                                <input type="checkbox" name="aleta_whatsapp" id="aleta_whatsapp" class="me-3">
                                <label class="f-9" for="aleta_whatsapp">Deseo recibir una alerta en mi whatsApp llegando el dia de la reserva</label>
                            </div>
                        </div>
                    </div>

                </form>

                <button class="btn btn-blue seguir_asistente">Siguiente <i class="fas fa-arrow-alt-circle-right"></i></button>

            </div>
            <div class="col-12 col-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <button class="navbar-toggler btn-toggle-nyg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex flex-column align-items-between border mt-2 w-100">
                            <div class="contenido"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- fin pantalla seleccion hora -->





    <!-- Inicio pantalla Extras -->
    <div class="container d-none mt-7" id="extras">
        <div class="mt-5 mb-3">
            <div class="d-flex justify-content-between">
                <div class="icon-gray btn-atras-extras" id="btn-atras" name="btn-atras">
                    <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                </div>
                <div>
                    <h3 class="text-center title-principal-css">Extras</h3>
                </div>
                <div></div>
            </div>
            <div>
            </div>
        </div>
        <div class="row flex-lg-nyg-column-reverse">
            <div class="col-12 col-lg-9">
                <div class="container-fluid">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <?php
                            $registros2 = $wpdb->get_results("SELECT * FROM `extra` where estado=1 group by tipo ");
                            $i = 0;
                            foreach ($registros2 as $tipos) {
                            ?>
                                <button class="nav-link <?php echo ($i == 0 ? 'active' : '') ?>" id="tabla_<?php echo $tipos->id ?>_tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $tipos->id ?>-home" type="button" role="tab" aria-controls="nav-<?php echo $tipos->id ?>-home" aria-selected="<?php echo ($i == 0 ? 'true' : 'false') ?>"><?php echo $tipos->tipo ?></button>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">

                        <?php
                        $registros2 = $wpdb->get_results("SELECT * FROM `extra` where estado=1 group by tipo ");
                        $i = 0;
                        foreach ($registros2 as $tipos) {
                        ?>
                            <div class="tab-pane fade show <?php echo ($i == 0 ? 'active' : '') ?>" id="nav-<?php echo $tipos->id ?>-home" role="tabpanel" aria-labelledby="tabla_<?php echo $tipos->id ?>_tab">
                                <div class="row row-cols-1 row-cols-md-3 g-4 p-3">
                                    <?php
                                    $registros4 = $wpdb->get_results("SELECT * FROM `extra` where tipo='" . $tipos->tipo . "'");
                                    $h = 0;
                                    foreach ($registros4 as $indextipo => $tipos) {

                                    ?>
                                        <div class="col mb-5">
                                            <div class="card">
                                                <button class="btn btn-transparent position-absolute end-0 text-white"><i class="fas fa-search-plus fa-xl"></i></button>
                                                <div>
                                                    <button class="btn btn-direction position-absolute top-25"><i class="fas fa-chevron-left"></i></button>
                                                    <button class="btn btn-direction position-absolute top-25 end-0"><i class="fas fa-chevron-right"></i></button>
                                                    <img src=".<?php echo $tipos->principal ?>" class="card-img-top" alt="...">
                                                </div>
                                                <div class="card-body extras-price">
                                                    <h5 class="card-title"><?php echo $tipos->nombre ?></h5>
                                                    <p><?php echo $tipos->descripcion ?>
                                                    </p>
                                                    <?php
                                                    $registros5 = $wpdb->get_results("SELECT * FROM `extra_detalle` where estado=1 and id_extra='" . $tipos->id . "'");
                                                    foreach ($registros5 as $index => $deta) {
                                                    ?>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <button class="btn btn-minus minus-action shadow-none" data-total="<?php echo 'total' . $tipos->id ?>" data-valor="<?php echo $deta->valor; ?>" data-span="<?php echo strval('span' . $deta->id . '-' . $index) ?>"><i class="fas fa-minus-circle fa-lg"></i></button>
                                                                <span class="span-quantity" id="<?php echo 'span' . $deta->id . '-' . $index ?>">0</span>
                                                                <button class="btn btn-minus plus-action shadow-none" data-total="<?php echo 'total' . $tipos->id ?>" data-valor="<?php echo $deta->valor; ?>" data-span="<?php echo strval('span' . $deta->id . '-' . $index) ?>"><i class="fas fa-plus-circle fa-lg"></i></button>
                                                                <span class="f-9 span-descrip" id="<?php echo 'desc' . $deta->id ?>"><?php echo $deta->descripcion; ?></span>
                                                            </div>
                                                            <div>
                                                                <span class="span-price"> <?php echo $deta->valor; ?></span> €
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="d-flex justify-content-end">
                                                        <span class="color-blue"><b id="<?php echo 'total' . $tipos->id ?>">0</b></span> <b class="color-blue">€</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $h++;
                                    }
                                    ?>
                                </div>


                            </div>
                        <?php
                            $i++;
                        }
                        ?>



                    </div>
                </div>

                <div class="d-flex justify-content-center mb-4">
                    <button class="btn btn-next-extra" id="extras-siguiente">Siguiente <i class="fas fa-arrow-circle-right fa-lg"></i></button>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <button class="navbar-toggler btn-toggle-nyg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex flex-column align-items-between border mt-2 w-100">
                            <div class="contenido"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <script>
        var indice
        var array_plus = []
        $('body').on('click', '.minus-action', function() {
            let data = $(this).data('span')
            let data_t = $(this).data('total')
            let subtotal = 0
            let total = parseInt($('#' + data_t).text())

            indice = $('#' + data).text();
            if (indice > 0) {
                indice = parseInt(indice) - 1
                $('#' + data).text(indice)

                subtotal = $(this).data('valor')
                total -= subtotal
                $('#' + data_t).text(total)
            }
        })

        $('body').on('click', '.plus-action', function() {
            let data = $(this).data('span')
            let data_t = $(this).data('total')
            array_plus.push('#' + data)
            let subtotal = 0
            let total = parseInt($('#' + data_t).text())

            indice = $('#' + data).text();
            indice = parseInt(indice) + 1
            $('#' + data).text(indice)

            subtotal = $(this).data('valor')
            total += subtotal
            $('#' + data_t).text(total)
        })

        $('body').on('click', '.plus-action-asistentes', function() {
            let data = $(this).data('span')
            let data_t = $(this).data('total')
            let subtotal = 0
            let total = parseInt($('#' + data_t).text())

            indice = $('#' + data).text();
            indice = parseInt(indice) + 1
            $('#' + data).text(indice)
        })

        $('body').on('click', '.minus-action-asistentes', function() {
            let data = $(this).data('span')
            let data_t = $(this).data('total')
            let subtotal = 0
            let total = parseInt($('#' + data_t).text())

            indice = $('#' + data).text();
            if (indice > 0) {
                indice = parseInt(indice) - 1
                $('#' + data).text(indice)
            }
        })
    </script>

    <!-- Fin pantalla Extras -->

    <!-- Inicio pantalla pagos -->

    <div class="container d-none mt-7" id="pagos">
        <div class="mt-5 mb-3">
            <!-- <div> -->
            <h3 class="text-center title-principal-css"><b>Pagos</b></h3>
            <!-- </div> -->
            <div>
                <div class="icon-gray btn-atras-pagos" id="btn-atras" name="btn-atras">
                    <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                </div>
            </div>
        </div>

        <div class="row flex-lg-nyg-column-reverse">
            <div class="col-12 col-lg-9">
                <div class="container-fluid mb-4">
                    <div class="card bg-gray border-0">
                        <!-- <div class="card-header">
                              Quote
                            </div> -->
                        <div class="card-body p-4">
                            <p style="font-size: 1.7rem;">Fianza*</p>
                            <b><strong>
                                    A modo de fianza (garantía) se solicitarán (150€) extra, el cual se
                                    reintegrará
                                    1 a
                                    3
                                    días luego
                                    de finalizado el viaje.
                                </strong>
                            </b>
                            <p> ¿Desea que los contabilicemos ahora o en efectivo el día de la
                                reserva?</p>
                            <!-- <blockquote class="blockquote mb-0"> -->
                            <!-- <p>A well-known quote, contained in a blockquote element.</p> -->
                            <!-- <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source
                                            Title</cite></footer> -->
                            <!-- </blockquote> -->
                            <div class="d-flex">
                                <div class="form-check" style="margin-right: 5rem;">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        El día de la reserva
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Pagar ahora
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="card bg-gray border-0">
                        <div class="card-body p-4">
                            <p style="font-size: 1.7rem;">Reserva Flex*</p>
                            <b><strong>
                                    Se avisa con una antelación de 48hs o más. Podrá cambiar o cancelar la
                                    reserva
                                    sin
                                    coste
                                    extra
                                </strong>
                            </b>
                            <p> ¿Desea activar la reserva flexible?</p>
                            <div class="d-flex">
                                <div class="form-check" style="margin-right: 5rem;">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        No gracias, sé que no ocurrirá ningún imprevisto
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault4" checked>
                                    <label class="form-check-label" for="flexRadioDefault4">
                                        Si, deseo poder cambiar la fecha o cancelar la reserva
                                    </label>
                                    <label class="color-blue"><b>(25€)</b></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="card bg-gray border-0">
                        <div class="card-body p-4">
                            <!-- <p style="font-size: 1.7rem;">Reserva Flex*</p>
                                <b><strong>
                                        Se avisa con una antelación de 48hs o más. Podrá cambiar o cancelar la reserva sin coste
                                        extra
                                    </strong>
                                </b>
                                <p> ¿Desea activar la reserva flexible?</p> -->
                            <div class="d-flex">
                                <div class="form-check" style="margin-right: 5rem;">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault5">
                                    <label class="form-check-label" for="flexRadioDefault5">
                                        Deseo pagar un mínimo para reservar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault6" checked>
                                    <label class="form-check-label" for="flexRadioDefault6">
                                        Deseo pagar el 100% de la reserva
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <button class="btn btn-embarcacion mx-3">Contrato de embarcación <i class="fas fa-file-pdf"></i></button>
                    <button class="btn btn-instuctivo mx-3">Instructivo de esta embarcación <i class="fas fa-file-pdf"></i></button>
                </div>
                <div class="d-flex justify-content-center mb-5">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check_terminos" true-value="1" false-value="">
                        <label class="form-check-label" for="check_terminos">
                            He leido y Acepto el contrato de LoremIpsum dolor sit met
                        </label>
                    </div>
                </div>

                <div class="container-fluid mb-5">
                    <div class="d-flex flex-column align-items-center justify-content-center p-5" style="background-color: #FCF8E3;">
                        <p>¡En hora Buena! estas casi listo toda tu reserva. Dale una Checkeada al resumen de lo
                            que
                            elegiste en
                            la columna derecha y si todo está bien, elige el medio de pago en el siguiente
                            bloque y
                            todo
                            listo.
                        </p>
                    </div>
                </div>

                <h3 class="text-center">Medios de Pago</h3>

                <div class="container-fluid mb-4">
                    <div class="d-flex flex-column height-paypal bg-gray p-4">
                        <div class="d-flex mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault8">
                                <label class="form-check-label" for="flexRadioDefault8">
                                    <b>Paypal</b>
                                </label>
                            </div>
                            <img src="<?php echo imagen(3) ?>" class="img-paypal mx-3" alt="">
                        </div>
                        <div class="">
                            <p>Pagar con Paypal, puedes pagar con tu tarjeta de crédito si no tienes una cuenta
                                de
                                Paypal.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="d-flex flex-column height-pagos bg-gray p-4">
                        <div class="d-flex mb-2">
                            <div class="form-check mr-4">
                                <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault9">
                                <label class="form-check-label" for="flexRadioDefault9">
                                    <b>Bizum</b>
                                </label>
                            </div>
                            <p>Paga directamente con tu móvil utilizando Bizum</p>
                        </div>
                        <div class="">
                            <p>Puedes realizar el pago a nuestro móvil (+34) 657 147397. Para agilizar la
                                reserva,
                                nos
                                puedes enviar un mensaje con el comprobante del pago al número de reserva a
                                nuestro
                                WhatsApp.</p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="d-flex flex-column height-pagos bg-gray p-4">
                        <div class="d-flex mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault10">
                                <label class="form-check-label" for="flexRadioDefault10">
                                    <b>Transferencia Bancaria</b>
                                </label>
                            </div>
                            <!-- <img src="./images/Paypal.png" class="img-paypal mx-3" alt=""> -->
                        </div>
                        <div class="">
                            <p>En el asunto deber indicar tu nombre completo y número de reserva. Envíanos el
                                comprobante de
                                la transferencia/depósito a nuestro móvil (+34) 657 147397.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="d-flex flex-column height-paypal bg-gray p-4">
                        <div class="d-flex mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault11">
                                <label class="form-check-label" for="flexRadioDefault11">
                                    <b>Cupón de descuento</b>
                                </label>
                            </div>
                            <!-- <input type="text"> -->
                            <button class="btn position-relative start-35 button-enviar-cupon rounded">Enviar</button>
                        </div>
                        <div class="">
                            <!-- <p>Pagar con Paypal, puedes pagar con tu tarjeta de crédito si no tienes una cuenta de Paypal.
                                </p> -->
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-5">
                    <button class="btn btn-navegar" id="to-navegar">
                        <span class="mr-2">¡A Navegar!</span>
                        <i class="fas fa-arrow-alt-circle-right fa-lg"></i>
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <button class="navbar-toggler btn-toggle-nyg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex flex-column align-items-between border mt-2 w-100">
                            <div class="contenido"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
    </div>

    <!-- Fin pantalla pagos -->

    <!-- Inicio pantalla resume -->

    <div class="container d-none mt-7" id="resume">
        <div class="mt-5 mb-3">
            <div>
                <h3 class="text-center title-principal-css">A continuación tu reserva</h3>
            </div>
            <div>
                <div class="icon-gray btn-atras-resume" id="btn-atras" name="btn-atras">
                    <i class="fa-solid fa-circle-arrow-left fa-lg"></i> Atrás
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <h4 class="color-oranged">Gracias. Tu pedido ha sido recibido</h4>
                <div class="row mb-4">
                    <div class="col-12 col-sm-6 col-md-3 border-right-dotted d-flex flex-column">
                        <span>NÚMERO DEL PEDIDO:</span>
                        <b>3771</b>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 border-right-dotted d-flex flex-column">
                        <span>FECHA:</span>
                        <b class="fecha_end_reserva">26 septiembre 2021</b>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 border-right-dotted d-flex flex-column">
                        <span>EMAIL:</span>
                        <b id="correo_end_responsable">CORREO@CORREO</b>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 border-right-dotted d-flex flex-column">
                        <span>TOTAL:</span>
                        <b>175,00€</b>
                    </div>
                </div>

                <div>
                    <h6>MÉTODO DE PAGO</h6>
                    <h6><b>Transferencia bancaria directa</b></h6>
                </div>
                <div class="">
                    <p>Realiza tu pago directamente e nuestra cuenta bancaria. Por favor, usa el número del
                        pedido como
                        referencia de pago,
                        por ejemplo: "Asunto: Reserva <span class="fecha_end_reserva"> 20/JUNIO/2022 </span>" N° de la reserva". Tu pedido no se
                        procesará hasta
                        que se haya
                        recibido el importe de nuestra cuenta. La fecha en el calendario de reservas será
                        bloqueada
                        hasta las 19 horas
                        del día de mañana, de no ser abonado quedará libre automáticamente, consulta los
                        <a class="color-oranged" href="#">términos y condiciones</a> para más información.
                    </p>
                </div>
                <!-- <h2><b>CUENTA EXPANSIÓN</b></h2>
                <div class="container">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="./images/barco_2.jpg" alt="" srcset="">
                        <div class="container table-responsive mt-5">
                            <table class="table">
                                <tr>
                                    <td style="width: 0%;">
                                        <button class="btn btn-transparent color-blue"> <i class="fas fa-ship fa-lg"></i> </button>
                                    </td>
                                    <td style="width: 0%;">Barco</td>
                                    <td style="width: 0%;">Namaré</td>
                                    <td class="d-flex justify-content-end color-blue" style="width: 75%;">
                                        <b>41€</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-transparent color-blue"> <i class="fas fa-calendar-alt fa-lg"></i>
                                        </button>
                                    </td>
                                    <td>Fecha</td>
                                    <td>Namaré</td>
                                    <td class="d-flex justify-content-end color-blue" style="width: 75%;">
                                        <b>41€</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-transparent color-blue"> <i class="fas fa-clock fa-lg"></i>
                                        </button>
                                    </td>
                                    <td>Salida</td>
                                    <td>Namaré</td>
                                    <td class="d-flex justify-content-end color-blue" style="width: 75%;">
                                        <b>41€</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-transparent color-blue"> <i class="fas fa-dharmachakra fa-lg"></i>
                                        </button>
                                    </td>
                                    <td>Responsable</td>
                                    <td>Namaré</td>
                                    <td class="d-flex justify-content-end color-blue" style="width: 75%;">
                                        <b>41€</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-transparent color-blue"> <i class="fas fa-users fa-lg"></i>
                                        </button>
                                    </td>
                                    <td>Asistentes</td>
                                    <td>Namaré</td>
                                    <td class="d-flex justify-content-end color-blue" style="width: 75%;">
                                        <b>41€</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-transparent color-blue"> <i class="fas fa-briefcase fa-lg"></i>
                                        </button>
                                    </td>
                                    <td>Extras</td>
                                    <td>Namaré</td>
                                    <td class="d-flex justify-content-end color-blue" style="width: 75%;">
                                        <b>41€</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-transparent color-blue"> <i class="fas fa-credit-card fa-lg"></i>
                                        </button>
                                    </td>
                                    <td>Pago</td>
                                    <td>Namaré</td>
                                    <td class="d-flex justify-content-end color-blue" style="width: 75%;">
                                        <b>41€</b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="container-fluid"> -->
                <div class="row mb-5 justify-content-evenly">
                    <button class="btn btn-resume col-12 col-md-6 col-lg-6 col-xl-2 mb-3 mx-1"> <span class="f-7">Descargar Recibo</span> <i class="fas fa-file-pdf"></i></button>
                    <button class="btn btn-resume col-12 col-md-6 col-lg-6 col-xl-2 mb-3 mx-1"> <span class="f-7">Compartir esta Reserva</span> <i class="fas fa-file-pdf"></i></button>
                    <button class="btn btn-resume col-12 col-md-6 col-lg-6 col-xl-2 mb-3 mx-1"> <span class="f-7">Descargar el contrato</span> <i class="fas fa-share-alt"></i></button>
                    <button class="btn btn-instuctivo-pdf col-12 col-md-6 col-lg-4 col-xl-4 mb-3 mx-1"> <span class="f-7">Descargar Instructivo de esta embarcación</span> <i class="fas fa-file-pdf"></i></button>
                </div>

                <div class="text-center mb-4">
                    <h2>
                        <strong>Gracias por preferir a MBM - Disfruta tu paseo!</strong>
                    </h2>
                </div>
                <!-- </div> -->
            </div>
            <div class="col-12 col-lg-4 contenido">
            </div>
        </div>
    </div>

    <!-- Fin pantalla resume -->

    <!-- Inicio pantalla fechas deseadas -->
    <div class="container-fluid fecha_deseada d-none" id="fecha_deseada">
        <div class="my-5">
            <div>
                <h3 class="text-center title-principal-css">¿Qué fecha deseas?</h3>
            </div>
            <div>
                <div class="" id="btn-atras" name="btn-atras">
                    <i class="fa-solid fa-circle-arrow-left"></i>Atras
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="d-flex justify-content-center w-100">
                    <input type="date" class="" id="date_selected_for_date" name="">
                </div>

                <div class="d-flex justify-content-center flex-column flex-md-row">
                    <div>
                        <input type="checkbox" class="checkboxFechas" name="fechaLibre" />Fecha libre
                    </div>
                    <div>
                        <input type="checkbox" class="checkboxFechas" name="fechaOcupada" />Fecha ocupada
                    </div>
                    <div>
                        <input type="checkbox" class="checkboxFechas" name="fechaParcialmente" /> Fecha ocupada
                        parcialmente
                    </div>
                    <div>
                        <input type="checkbox" class="checkboxFechas" name="fechaBloqueadaParcial" /> Fecha
                        bloqueada
                        parcialmente
                    </div>
                </div>


                <div class="d-flex justify-content-center next-date-selected-div w-100 d-none">
                    <div class="container-btn next-date-selected">
                        Por la mañana
                    </div>
                    <div class="container-btn selected-btn next-date-selected">
                        Por la tarde
                    </div>
                    <div class="container-btn next-date-selected">
                        Todo el día
                    </div>
                </div>
                <div class="d-flex justify-content-center w-100">
                    <div class="msn-alert-css">
                        Las fechas bloqueadas, No han sido abonados aun y quedarán libres a las 19 horas del día
                        siguiente
                        de
                        hecha
                        la reserva, si deseas puedes seleccionar el día para que se te notifique si queda libre
                        o se ocupa
                        definitivamente.
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center w-100">
                    <input type="checkbox" id="want_notification" class="checkboxNotificaciones" name="fechaOcupada" />
                    <label class="mt-2 f-9" for="want_notification"> Quiero recibir una notificación si este horario/fecha queda libre </label>
                </div>
            </div>

            <!-- Contenedor de tabla de detalle -->
            <div class="col-12 col-lg-4 contenido">
            </div>
        </div>
    </div>


    <div class="container-fluid d-none" id="detail_barco_individual">
        <div class="d-flex justify-content-between bg-gray align-items-center" style="height: 6rem;">
            <div class="d-flex p-4">
                <div id="div_name_details">
                    <h4 class="me-5" id="name_details"></h4>
                </div>
                <span class="color-blue me-5 mt-1 horas_valor"><b class="value_hs"></b></span>
            </div>
            <div>
                <button class="btn btn-dark position-absolute end-0 top-0"><i class="fas fa-times fa-lg"></i></button>
            </div>
        </div>
        <div class="container">
            <div class="d-flex justify-content-between">
                <h4 class="mt-4 mb-3"><b>Detalle del barco</b></h4>
                <button class="btn btn-dark position-relative" id="close-details" style="height: 2.2rem; top: 2rem; width: 2.2rem;"><i class="fas fa-times fa-lg"></i></button>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <section id="carrousel_details_section">
                </section>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container">
            <div class="d-flex mt-4">
                <div class="d-flex align-items-center me-sm-3">
                    <button class="btn btn-transparent color-gray"><i class="fas fa-users-cog fa-lg"></i></button>
                    <span>Sin titulación</span>
                </div>
                <div class="d-flex align-items-center me-sm-3">
                    <button class="btn btn-transparent color-gray"><i class="fas fa-users fa-lg"></i></button>
                    <span>Hasta 6</span>
                </div>
                <div class="d-flex align-items-center me-sm-3">
                    <button class="btn btn-transparent color-gray">
                        <i class="fas fa-arrow-left fa-lg"></i>
                        <i class="fas fa-arrow-right fa-lg"></i>
                    </button>
                    <span>4,9mts</span>
                </div>
                <div class="d-flex align-items-center me-sm-3">
                    <button class="btn btn-transparent color-gray"><i class="fas fa-anchor fa-lg"></i></button>
                    <span>15hp</span>
                </div>
            </div>

            <hr>
            <div class="d-flex align-items-center btn-extras">
                <span>Extra: </span>
                <button>Nevera</button>
                <button>Toldo</button>
                <button>Ducha exterior</button>
                <button>Sistema Stereo</button>
                <button>Cojines cockpit</button>
                <button>Escalera de baño</button>
            </div>
            <hr>

            <div class="div_name_s">
                <h5 class="mb-1" id="name_s">Namaré 485s</h5>
            </div>
            <p class="f-9">Namare es una barca cómoda y agil, para recorrer las calas circundantes, la recomendamos
                para familia y
                amigos. Disponemos de dos colores, Beige y Silver, ambas poseen las mismas prestaciones y
                comodidades.
            </p>

            <div class="row mt-5">
                <div class="col-12 col-md-6">
                    <input type="date" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                    <input type="date" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="container d-none mt-7" id="asistentes">
        <div class="row flex-lg-nyg-column-reverse">
            <div class="col-12 col-lg-9">
                <div class="d-flex justify-content-end btn-asistieron">
                    <span>
                        Personas a asistir:
                    </span>
                    <button class="btn">
                        <b class="color-blue">1</b>
                        <b class="color-gray-dark">/6</b>
                    </button>
                </div>
                <hr>
                <div class="row justify-content-around fa-gray">
                    <div class="d-flex flex-column align-items-center col-6 col-sm-3">
                        <h6 class="f-9 mt-3">Adultos</h6>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-transparent minus-action-asistentes" data-total="total_adultos" data-span="span_adultos"><i class="fas fa-minus-circle fa-lg"></i></button>
                            <span id="span_adultos" class="mx-2">0</span>
                            <button class="btn btn-transparent plus-action-asistentes" data-total="total_adultos" data-span="span_adultos"><i class="fas fa-plus-circle fa-lg"></i></button>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center col-6 col-sm-3">
                        <h6 class="f-9 mt-3">Menores (3 a 12 años)</h6>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-transparent minus-action-asistentes" data-total="total_3_12" data-span="span_3_12"><i class="fas fa-minus-circle fa-lg"></i></button>
                            <span id="span_3_12" class="mx-2">0</span>
                            <button class="btn btn-transparent plus-action-asistentes" data-total="total_3_12" data-span="span_3_12"><i class="fas fa-plus-circle fa-lg"></i></button>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center col-6 col-sm-3">
                        <h6 class="f-9 mt-3">Niños (1 a 3 años)</h6>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-transparent minus-action-asistentes" data-total="total_1_3" data-span="span_1_3"><i class="fas fa-minus-circle fa-lg"></i></button>
                            <span id="span_1_3" class="mx-2">0</span>
                            <button class="btn btn-transparent plus-action-asistentes" data-total="total_1_3" data-span="span_1_3"><i class="fas fa-plus-circle fa-lg"></i></button>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center col-6 col-sm-3">
                        <h6 class="f-9 mt-3">Bebés</h6>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-transparent minus-action-asistentes" data-total="total_bebes" data-span="total_bebes"><i class="fas fa-minus-circle fa-lg"></i></button>
                            <span id="total_bebes" class="mx-2">0</span>
                            <button class="btn btn-transparent plus-action-asistentes" data-total="total_bebes" data-span="total_bebes"><i class="fas fa-plus-circle fa-lg"></i></button>
                        </div>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="">Comentarios</label>
                                <textarea name="" id="" cols="30" rows="10" class="form-control h-6r"></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container mt-3">
                    <div class="d-flex">
                        <button class="btn btn-next-extra" id="asis-to-extras"><span>Siguiente</span> <i class="fas fa-arrow-alt-circle-right f-12 position-relative" style="top: 0.1rem;"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <button class="navbar-toggler btn-toggle-nyg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex flex-column align-items-between border mt-2 w-100">
                            <div class="contenido"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>


    </div>


    <script>
        var array = ['#type_booking', '#barco', '#seleecion_fechas', '#seleecion_hora', '#seleecion_registro', '#extras', '#pagos', '#resume', '#asistentes']
        var timeline = ['#timeline_barco', '#timeline_fecha', '#timeline_horario', '#timeline_asistencia', '#timeline_extras', '#timeline_pago']

        function barco_clean() {
            $('#row-image *').remove()
            $('.barco_resume *').remove()
        }

        function fecha_clean() {
            $('input[type="date"]').val('');
            // $('.colocarBotones .seguir_hora *').remove()
            $('#fecha_resume *').remove()
        }

        function horario_clean() {
            $('#barco_resume *').remove()
            $('#hour_resume *').remove()
            hour_end = ''
            hour_start = ''
            horaInicio_viaje = ''
            $('.seleccion_hora_vieje_final').css('background-color', '#FFF')
            $('.seleccion_hora_vieje').css('background-color', '#FFF')
        }


        function responsable_clean() {
            $('input[type="text"]').val('');
            $('responsable_resume *').remove()
        }

        function asistentes_clean() {
            $('#asistentes_resume *').remove()
            $('#span_adultos').text(0)
            $('#span_3_12').text(0)
            $('#span_1_3').text(0)
            $('#total_bebes').text(0)
        }

        function extras_clean() {
            $('.extra_resume *').remove()
            array_plus.forEach(element => {
                $(element).text(0)
            })
        }

        timeline.forEach((item, position) => {
            $('body').on('click', item, function() {
                let bandera = $(this).data('bandera')

                switch (bandera) {
                    case 1:
                        barco_clean()
                        fecha_clean()
                        horario_clean()
                        responsable_clean()
                        asistentes_clean()
                        extras_clean()
                        break;
                    case 2:
                        fecha_clean()
                        horario_clean()
                        responsable_clean()
                        asistentes_clean()
                        extras_clean()
                        break;
                    case 3:
                        horario_clean()
                        responsable_clean()
                        asistentes_clean()
                        extras_clean()
                        break;
                    case 4:
                        asistentes_clean()
                        extras_clean()
                        responsable_clean()
                    case 5:
                        extras_clean()
                        break;
                    default:
                        break;
                }

                array.forEach((i, index) => {
                    if (index == bandera) $(i).removeClass('d-none')
                    else $(i).addClass('d-none')
                })
            })
        })

        $('body').on('click', '#timeline_barco', function() {

            //-------------------------------------------------------------------------
            // Tabla reserva
            //-------------------------------------------------------------------------

            id_vote = ''
            fecha_inicio_viaje = ''
            horaInicio_viaje = '';
            horafinal_viaje = '';
            cant_adultos = ''
            cant_tres_doce = ''
            cant_uno_tres = ''
            cant_bebes = ''

            //-------------------------------------------------------------------------
            // User reserva
            //-------------------------------------------------------------------------

            nombre = ''
            apellido = ''
            direccion = ''
            telefono = ''
            email = ''
            num_dni = ''
            image = ''
            alert_email = ''
            alert_whatsapp = ''
            tipo_doc = ''

            //-------------------------------------------------------------------------
            // Tabla extras reserva
            //-------------------------------------------------------------------------

            id_reserva = ''
            id_extra = ''

        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>
        //-------------------------------------------------------------------------
        // Tabla reserva
        //-------------------------------------------------------------------------

        id_vote = ''
        fecha_inicio_viaje = ''
        horaInicio_viaje = '';
        horafinal_viaje = '';
        cant_adultos = ''
        cant_tres_doce = ''
        cant_uno_tres = ''
        cant_bebes = ''

        //-------------------------------------------------------------------------
        // User reserva
        //-------------------------------------------------------------------------

        nombre = ''
        apellido = ''
        direccion = ''
        telefono = ''
        email = ''
        num_dni = ''
        image = ''
        alert_email = ''
        alert_whatsapp = ''
        tipo_doc = ''

        //-------------------------------------------------------------------------
        // Tabla extras reserva
        //-------------------------------------------------------------------------

        id_reserva = ''
        id_extra = ''

        contenido = "";
        $('body').on('click', '#por_barco', function() {
            $('#type_booking').addClass('d-none')
            $('#barco').removeClass('d-none')
        })
        var total_barco = 0
        var hour_end = 0
        var hour_start = 0
        var difference = 0
        detalle = '';
        valores = '';

        $('body').on('click', '.zone_hour', function() {
            $('#seleecion_fechas').addClass('d-none')
            $('#barco').removeClass('d-none')
        })
        var precio = 0
        var valor_hora = 0
        $('body').on('click', '.barco-to-asis', function() {
            imagen = $(this).attr('imagen');
            nombre = $(this).attr('nombre');
            valor_hora = $(this).data('valor')

            // console.log('valor ==> ', valor);
            detalle = JSON.parse($(this).attr('detalle'));
            valores = JSON.parse($(this).attr('valores'));

            id_vote = $(this).attr('id')

            contenido = `<div class='row' id='row-image'><img src="${imagen}" style='width:100%'></div>`;


            var botones = "";
            $.each(detalle, function(key, val) {
                console.log(val);
                botones += `<button type="button" class="container-btn seguir_hora color-gray" horaIni="${val.hora_inicio}" horaFin="${val.hora_final}"   horario='${val.horario}' texto="${(val.horario==1?'Por la mañana':(val.horario==2?'Por la tarde':(val.horario==3?'Por la Noche':(val.horario==4?'Todo el día':''))))}">${(val.horario==1?'Por la mañana':(val.horario==2?'Por la tarde':(val.horario==3?'Por la Noche':(val.horario==4?'Todo el día':''))))}</button>`;
            })
            $('.colocarBotones').html(botones);

            $('.contenido').append(contenido)
            $('#barco').addClass('d-none')
            if (type_screen == 0) {
                $('#seleecion_fechas').removeClass('d-none')
            } else if (type_screen == 1) {
                // Here go the route
                $('#seleecion_hora').removeClass('d-none')
            }
        })
        var hour_start = 0
        var type_screen = 0;
        $('body').on('change', '#fecha_asignada', function() {
            7
            // alert('llego')
            fecha_inicio_viaje = $(this).val()
            if (type_screen == 0) {
                $('.colocarBotones').removeClass('d-none')
            } else if (type_screen == 1) {
                $('.buttons-defect').removeClass('d-none')
            }
        })

        $('body').on('change', '#date_selected_for_date', function() {
            $('.next-date-selected-div').removeClass('d-none')
        })
        $('body').on('click', '.next-date-selected', function() {
            let fecha = document.getElementById('date_selected_for_date').value

            contenido = `<div class="d-flex justify-content-between">
					<div class="d-flex" style="
					justify-content: space-between;
					align-items: center;
				">
						<button class="btn btn-transparent"><i class="fas fa-calendar-alt"></i></button>
						<b class="f-8"> Fecha </b>
					</div>
					<label class="nombre_vote">${fecha}</label>
				</div>`
            $('.contenido').append(contenido)
            $('#fecha_deseada').addClass('d-none')
            $('#barco').removeClass('d-none')
        })

        $('body').on('click', '.seguir_hora', function() {
            var horaIni = $(this).attr('horaIni');
            horaIni = horaIni.split(':');
            var horaFin = $(this).attr('horaFin');
            horaFin = horaFin.split(':');
            var botonHora = "<div class='row'>";
            for (i = (parseInt(horaIni[0])); i < (parseInt(horaFin[0])); i++) {
                for (h = 0; h < 2; h++) {
                    botonHora += `<div class="col-6 col-sm-3 col-md-3 col-lg-2 d-flex justify-content-center"><button type="button" class="btn btn-info seleccion_hora_vieje" final='${parseInt(horaFin[0])}' minutos='${h}' hora="${i+":"+(h==0?'00':'30') }" >${i+":"+(h==0?'00':'30') }</button></div>`;
                }
            }
            botonHora += "</div>";
            let fecha = document.getElementById('fecha_asignada').value
            contenido = `<div class="d-flex justify-content-between" id="fecha_resume">
    <div class="d-flex" style="
    justify-content: space-between;
    align-items: center;
">
        <button class="btn btn-transparent"><i class="fas fa-calendar-alt"></i></button>
        <b class="f-8"> Fecha </b>
    </div>
    <label class="nombre_vote">${fecha}</label>
</div>`
            $('.contenido').append(contenido)
            $('.incluirBotonesHorario').html(botonHora);

            var horario = $(this).attr('horario');
            var texto = $(this).attr('texto');
            $('.texto_seleccion').html(texto);
            $('#seleecion_fechas').addClass('d-none')
            $('#seleecion_hora').removeClass('d-none')
        })

        var hora_inicio_axios = '';
        $('body').on('click', '.seleccion_hora_vieje', function() {
            $(this).attr('id', 'from-here')
            let array = $('.seleccion_hora_vieje')
            let progress = false
            for (i = 0; i < array.length; i++) {
                if (array[i].id == 'from-here') {
                    hour_start = array[i].innerText
                    horaInicio_viaje = hour_start

                    progress = true
                    array[i].removeAttribute('id')
                }
                if (progress == true) {
                    array[i].style.backgroundColor = '#31d2f2'
                } else {
                    array[i].style.backgroundColor = 'white'
                }
            }
            horaInicio_viaje = $(this).attr('hora');
            hora_inicio_axios = horaInicio_viaje
            minutos = $(this).attr('minutos');
            horaInicio_viaje = horaInicio_viaje.split(':')
            final = $(this).attr('final');
            var botonHoraFinal = "<div class='row'><label>Regreso</label></div>";
            botonHoraFinal += "<div class='row'>";
            hh = 0;
            for (i = (parseInt(horaInicio_viaje[0])); i < (parseInt(final) + 2); i++) {
                for (h = 0; h < 2; h++) {
                    if (hh == 0) {
                        h = (minutos + 1);
                        hh++;
                    }
                    if (h < 2) {
                        botonHoraFinal += `<div class="col-6 col-sm-3 col-md-3 col-lg-2 d-flex justify-content-center"><button type="button" class="btn btn-info seleccion_hora_vieje_final" hora="${i+":"+(h==0?'00':'30') }" >${i+":"+(h==0?'00':'30') }</button></div>`;
                    }

                }
            }
            botonHoraFinal += "</div>";
            $('.regresoBotonesHorario').html(botonHoraFinal);
            horafinal_viaje = '';
        })

        $('body').on('click', '.seleccion_hora_vieje_final', function() {

            horafinal_viaje = $(this).attr('hora');
            let hora_axios = horafinal_viaje
            horafinal_viaje = $(this).attr('id', 'until-here');
            let url = window.location.origin + '/boats/wp-content/themes/twentytwentytwo/validar_horas.php?fecha_inicio_viaje=' + fecha_inicio_viaje + '&id_vote=' + id_vote + '&hora_fin=' + hora_axios + '&hora_inicio=' + hora_inicio_axios
            axios.post(url).then(res => {
                if (res.data.desocupado != true) {
                    $('#seleccionar_horario_button').addClass('d-none')
                    alert('Este barco está ocupado en este horario')
                } else {
                    $('#seleccionar_horario_button').removeClass('d-none')
                }
                // alert('llego')
            })
            let array = $('.seleccion_hora_vieje_final')
            let progress = false
            for (i = 0; i < array.length; i++) {
                if (progress == false) {
                    array[i].style.backgroundColor = '#31d2f2'
                }
                if (array[i].id == 'until-here') {
                    hour_end = array[i].innerText
                    horafinal_viaje = hour_end
                    array[i].removeAttribute('id')
                    progress = true
                }
            }
        })

        $('body').on('click', '.seguir_registro', function() {

            var startTime = moment(horaInicio_viaje, 'hh:mm');
            var endTime = moment(horafinal_viaje, 'hh:mm');
            difference = endTime.diff(startTime, 'minutes');
            difference = difference / 30
            total_barco = valor_hora * difference
            console.log('total_barco ==> ', total_barco)
            $('.label-value-barco').text(total_barco + ' ' + '€')

            if (!hour_start || !hour_end) {
                alert('Seleccione una hora de inicio y hora de llegada')
                return
            }

            contenido = `<div class='row' id="barco_resume"><div class='col-md-8'><button class="btn btn-transparent"><i class='ico-circle fas fa-ship'></i></button><label class='nombre_vote' style="font-weight: bold" >${nombre}</label></div><div class='col-md-4 d-flex align-items-center justify-content-end'><label class='label-value-barco f-8 me-2'>${total_barco} €</label></div></div>`;

            contenido += `
<div class="d-flex justify-content-between" id="hour_resume">
	<div class="d-flex flex-column">
		<div>
			<button class="btn btn-transparent resume_button_icon"><i class="fas fa-clock"></i></button>
			<b class="f-8"> Salida </b>
		</div>
			<b class="f-8 ms-5"> Regreso </b>
	</div>
	<div class="d-flex flex-column">
		<span class="f-8" style="margin-bottom: .7rem"> ${hour_start} </span>
		<span class="f-8"> ${hour_end} </span>
	</div>
</div>`

            $('.contenido').append(contenido)
            $('#seleecion_hora').addClass('d-none')
            $('#seleecion_registro').removeClass('d-none')

        })
        var send_form = {}
        $('body').on('click', '.seguir_asistente', function() {
            let form = $('#form_responsable').serializeArray()
            console.log('form ==> ', form)
            let validator = empty_form(form)
            if (validator == true) {
                alert('Completa los campos obligatorios')
                return
            }

            form.forEach(item => {
                if (item.name == 'nombre') nombre = item.value
                if (item.name == 'apellido') apellido = item.value
                if (item.name == 'direccion') direccion = item.value
                if (item.name == 'telefono') telefono = item.value
                if (item.name == 'email') email = item.value
                if (item.name == 'numeroId') num_dni = item.value
                if (item.name == 'image') image = item.value
                if (item.name == 'aleta_email') alert_email = item.value
                if (item.name == 'aleta_whatsapp') alert_whatsapp = item.value
                if (item.name == 'tipo_doc') tipo_doc = item.value
                send_form = {
                    nombre: nombre,
                    apellido: apellido,
                    direccion: direccion,
                    telefono: telefono,
                    email: email,
                    num_dni: num_dni,
                    image: image,
                    alert_email: alert_email,
                    alert_whatsapp: alert_whatsapp,
                    tipo_doc: tipo_doc
                }
                console.log('item ==> ', item)
            })
            image = $('#archivo').val()

            let name_complete = form[0].value + ' ' + form[1].value
            contenido = `<div class="d-flex justify-content-between" id="responsable_resume">
    <div class="d-flex" style="
    justify-content: space-between;
    align-items: center;
">
        <button class="btn btn-transparent resume_button_icon"><i class="fas fa-user"></i></button>
        <b class="f-8"> Responsable</b>
    </div>
    <label class="nombre_vote">${name_complete}</label>
</div>`
            $('.contenido').append(contenido)
            $('#seleecion_registro').addClass('d-none')
            $('#asistentes').removeClass('d-none')
        })

        function isEmpty($value) {
            if ($value == '' || $value == undefined || $value == null || $value == false || $value == 0) return true
            else return false
        }

        function empty_form(array, index = 0, response = false) {
            if (index < array.length && response == false) {
                if (isEmpty(array[index].value)) return empty_form(array, index += 1, true)
                else return empty_form(array, index += 1, false)
            } else return response
        }

        function guardarTodo() {
            let formulario = new FormData()
            let fecha_reserva = ''
            send_form.id_vote = id_vote
            send_form.fecha_inicio_viaje = fecha_inicio_viaje
            send_form.horaInicio_viaje = horaInicio_viaje
            send_form.horafinal_viaje = horafinal_viaje
            send_form.cant_adultos = cant_adultos
            send_form.cant_tres_doce = cant_tres_doce
            send_form.cant_uno_tres = cant_uno_tres
            send_form.cant_bebes = cant_bebes
            send_form.image = $('#archivo')[0].files[0]

            if(send_form.horaInicio_viaje) send_form.horaInicio_viaje = (send_form.horaInicio_viaje+'').replaceAll(',', ':')
            for (const key in send_form) {
                formulario.append(key, send_form[key])
            }

            let url = window.location.origin + '/boats/wp-content/themes/twentytwentytwo/StoreReservaController.php'
            axios.post(url, formulario).then(res => {
                console.log('res.data ==> ', res.data);
            })
        }


        $('body').on('click', '#asis-to-extras', function() {
            let adultos = parseInt($('#span_adultos').text())
            let span2 = parseInt($('#span_1_3').text())
            let span3 = parseInt($('#span_3_12').text())
            let bebes = parseInt($('#total_bebes').text())

            cant_adultos = adultos
            cant_uno_tres = span2
            cant_tres_doce = span3
            cant_bebes = bebes

            let total = adultos + span2 + span3 + bebes
            let ninios = span2 + span3 + bebes
            if (adultos == 0) {
                alert('Debe ir por lo menos un adulto')
                return
            }

            contenido = `<div class="d-flex justify-content-between" id="asistentes_resume">
					<div class="d-flex" style="
					justify-content: space-between;
					align-items: start;
				">
						<button class="btn btn-transparent resume_button_icon"> <i class="fas fa-users"></i> </button>
						<b class="f-8"> Asistentes </b>
					</div>
					<div class="d-flex flex-column f-8">
						<div class="d-flex">
							<span class="me-1"> ${adultos} </span> Adultos
						</div>
						<div class="d-flex">
							<span class="me-1"> ${ninios} </span> Niños
						</div>
					</div>
				</div>`
            $('.contenido').append(contenido)
            $('#asistentes').addClass('d-none')
            $('#extras').removeClass('d-none')
        })


        $('body').on('click', '#extras-siguiente', function() {

            let array = $('.extras-price .span-quantity')
            let general = []
            let quantitys = []
            for (index = 0; index < array.length; index++) {
                quantitys.push(array[index].textContent)
            }

            array = $('.extras-price .span-descrip')
            let descriptions = []
            for (index = 0; index < array.length; index++) {
                descriptions.push(array[index].textContent)
            }

            array = $('.extras-price .span-price')
            let price = []
            for (index = 0; index < array.length; index++) {
                price.push(array[index].textContent)
            }

            for (index = 0; index < array.length; index++) {
                general.push({
                    quantity: quantitys[index],
                    description: descriptions[index],
                    price: price[index]
                })
            }

            var resume_extras = general.filter((item) => item.quantity != '0');
            console.log('resume_extras ==> ', resume_extras);


            contenido = ''
            resume_extras.forEach((item, index) => {
                contenido += `
					<div class="d-flex justify-content-between extra_resume">
						<div class="d-flex f-8">`
                if (index == 0) {
                    contenido += `<button class="btn btn-transparent resume_button_icon"> 
								  <i class="fas fa-swimmer"></i> </button>
								  <b> ${item.description} x ${item.quantity}</b> </div>`
                } else {
                    contenido += `<b class="ml-5"> ${item.description} x ${item.quantity}</b>
								</div>
						`
                }
                contenido += `<div class="f-9">
									<b class="color-blue"> ${item.price} €</b>
								</div>
							</div> `
            })
            $('.contenido').append(contenido)
            $('#extras').addClass('d-none')
            $('#pagos').removeClass('d-none')
        })

        $('body').on('click', '#to-navegar', function() {
            if (!$('#check_terminos').prop('checked')) {
                alert('Para continuar debes aceptar terminos y condiciones')
                return
            }
            let email_resposable_end = $('#email').val()
            let fecha_asignada = $('#fecha_asignada').val()
            $('#correo_end_responsable').text(email_resposable_end)
            $('.fecha_end_reserva').text(fecha_asignada)
            guardarTodo()
            $('#pagos').addClass('d-none')
            $('#resume').removeClass('d-none')
        })

        $('body').on('click', '#por_fechas', function() {
            $('#type_booking').addClass('d-none')
            type_screen = 1
            $('#seleecion_fechas').removeClass('d-none')
        })

        $('body').on('click', '.btn-atras-extras', function() {
            $('#barco').removeClass('d-none')
            $('#extras').addClass('d-none')
        })

        $('body').on('click', '.btn-atras-pagos', function() {
            $('#extras').removeClass('d-none')
            $('#pagos').addClass('d-none')
        })

        $('body').on('click', '.btn-atras-resume', function() {
            $('#pagos').removeClass('d-none')
            $('#resume').addClass('d-none')
        })
        $('body').on('change', '#date1', function() {
            $('#button-day').removeClass('d-none')
        })

        $('body').on('click', '.container-btn', function() {
            $('.container-btn').removeClass('selected-btn')
            $(this).addClass('selected-btn')
        })

        var id_barco;
        $('body').on('click', '.details_barco', function() {
            id_barco = $(this).data('vote')
            let registros = $(this).data('registros')
            let images_carrousel = ['/boats/' + id_barco.imagen1,
                '/boats/' + id_barco.imagen2,
                '/boats/' + id_barco.imagen3
            ]
            console.log('registros ==>', registros)
            $('.value_hs').remove()
            if (registros != null || registros != undefined) {
                let data_precios = ''
                registros.forEach((item, index) => {
                    data_precios += `<b class="value_hs me-4"> ${item.horas}hs ${item.valor}€</b>`
                })

                $('.horas_valor').append(data_precios)
            }
            let carrousel = '<div class="carousel-inner" id="carrousel_details">'
            let active = 'active'
            for (x = 0; x < 3; x++) {
                carrousel += '<div class="carousel-item '
                if (x == 0) carrousel += active
                carrousel += '"><img '
                carrousel += `src="${images_carrousel[x]}" class="d-block w-100" alt="...">
				</div>`
            }
            carrousel += '</div>'
            $('#carrousel_details').remove()
            $('#carrousel_details_section').append(carrousel)

            $('#name_details').remove()
            let name = `<h4 class="me-5" id="name_details">${id_barco.nombre}</h4>`
            $('#div_name_details').append(name)

            $('#name_s').remove()
            name = `<h5 class="mb-1" id="name_s">${id_barco.nombre}</h5>`
            $('.div_name_s').append(name)

            $('#barco').addClass('d-none')
            $('#detail_barco_individual').removeClass('d-none')
        })

        $('body').on('click', '#close-details', function() {
            $('#barco').removeClass('d-none')
            $('#detail_barco_individual').addClass('d-none')
            $('#asistentes').addClass('d-none')
        })

        // $('body').on('click', '.container-btn', function(){
        //    $('#fecha_deseada').addClass('d-none')
        //    $('#barco').removeClass('d-none')
        //})

        let html = `
        <div class="w-90 cont-table-det">
                            <label for="">Resumen</label>
                            <div>
                                <img src="./images/Screenshot_1.png" alt="">
                            </div>
                            <div class="d-flex mt-2 ">
                                <div class="ico-circle">
                                    <i class="fas fa-ship"></i>
                                </div>
                                <label for="">Namaré</label>
                                <label class="label-txt-blu">175,00€</label>
                            </div>
                            <hr class="m-0">

                            <div class="d-flex mt-1 mb-0">
                                <div class="ico-circle">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <label for="">Fecha:</label>
                                <label class="label-txt">14/09/2022</label>
                            </div>
                            <div class="d-flex mt-0 mb-0">
                                <div class="ico-circle">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <label for="">Salida:</label>
                                <label class="label-txt">09h30</label>
                            </div>
                            <div class="d-flex mt-0 mb-0">
                                <div class="ico-circle-vacio">
                                    <!-- <i class="fas fa-calendar-alt"></i> -->
                                </div>
                                <label for="">Regreso:</label>
                                <label class="label-txt">(+) 15h30</label>
                            </div>
                            <div class="d-flex mt-0 mb-0">
                                <div class="ico-circle-vacio">
                                    <!-- <i class="fas fa-calendar-alt"></i> -->
                                </div>
                                <label for=""></label>
                                <label class="label-txt-blu">+75€</label>
                            </div>
                        </div>
        `

        $('.resume_general').append(html)
    </script>

<?php
    plugin_reservas_estilo();
}
