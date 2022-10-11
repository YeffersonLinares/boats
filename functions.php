<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<link rel="stylesheet" href="./wp-content/themes/twentytwentytwo/style.css">
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

<div x-data="app_alpine()">
    <?php include_once 'ReservaUsuarioTimeline.html' ?>

    <div class="spinner" x-show="loading">
        <div class="caja_img">
            <img src="https://www.eltiempo.com/files/article_main/files/crop/uploads/2022/08/06/62ef1d80a6c12.r_1659856219327.0-18-1574-804.jpeg" width="100px">
        </div>
    </div>

    <?php include_once "reserva.php"; ?>
    <template x-if="pantalla!='reserva_usuario'">
        <div class="row flex-lg-nyg-column-reverse mt-7">
            <div class="col-12 col-lg-9 px-lg-5">
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
                <?php include_once "ReservaUsuarioResume.html"; ?>
            </div>
        </div>
    </template>
    <?php

    $reserva = $_SERVER["REQUEST_URI"];
    if ($reserva == '/boats/reservas_admin/') require 'Reserva_mes.html';

    add_shortcode('reservas_admin', 'plugin_reservas_admin');

    function plugin_reservas_admin()
    {
        global $wpdb;
        global $current_user, $user_login;
        //$ID = $current_user->ID;
        // include 'logica.php';
        ob_start();


    ?>

        <div tab=1>
            <?php //echo plugin_create_b() 
            ?>
        </div>
        <div tab=2>
            <?php //echo admin_clientes() 
            ?>
        </div>

        <!-- Inicio de dashboard admin -->

        <div class="container-fluid px-md-5 d-none" id="dashboard-admin">
            <h4 class="text-center mt-3 color-dark-blue"> <b> Dashboard </b> </h4>
            <hr>

            <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center">
                <div class="col-12 me-4 col-lg-8">
                    <div class="d-flex mt-4">
                        <h3 class="me-4"> <b> Bienvenido </b> </h3>
                        <h3 class="color-dark-blue"> <b> Usuario #12244 </b> </h3>
                    </div>

                    <p class="my-2 color-gray">Te dejamos un resumen de los movimientos de tus reservas y tareas por
                        hacer en tus
                        embarcaciones</p>

                    <div class="container-fluid bg-container-gray pt-5 px-4">
                        <div class="d-flex justify-content-between">
                            <h3 class="color-dark-blue"><b>Reservas</b></h3>
                            <button class="btn btn-next-extra nueva-reserva" style="border-radius: 12px;">Nueva Reserva
                                <i class="fa-solid fa-circle-right"></i></button>
                        </div>
                        <p class="mt-4 color-gray">Intrinsicly create backend infrastructures before best-of-breed web
                            services.
                            Compellingly
                            reintermediate intuitive human capital before strategic technologies. Completely network
                            covalent
                            communities before fully researched “outside the box” thinking.</p>

                        <div class="row mt-5">
                            <div class="col-12 col-md-8 mb-5">
                                <button class="btn btn-transparent color-blue me-4">
                                    <i class="fa-solid fa-square"></i>
                                    <span class="color-gray">Fecha de reserva</span>
                                </button>
                                <button class="btn btn-transparent color-light-blue me-4">
                                    <i class="fa-solid fa-square"></i>
                                    <span class="color-gray">Fecha Bloqueada parcialmente</span>
                                </button>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <p>Porcentaje del mes ocupado</p>
                                        <p class="color-blue">34%</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Daños de equipos</p>
                                        <p class="color-blue">43 veces</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Stats importante</p>
                                        <p class="color-blue">12%</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Otro Stat importante</p>
                                        <p class="color-blue">80%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mt-5">
                    <div class="d-flex flex-column">
                        <img src="../images/mapa.png" style="height: 16rem;">
                        <span class="f-7 color-light-gray">Actualización cada 0,2 segundos</span>
                    </div>

                    <div class="container-fluid bg-container-gray pt-2">
                        <div class="d-flex align-items-center justify-content-between my-3">
                            <h4 class="color-dark-blue"><b>Notificaciones</b></h4>
                            <button class="btn btn-next-extra" style="width: 14rem !important; border-radius: 12px;">
                                <span class="d-none d-sm-inline">Nueva Notificación</span>
                                <i class="fa-solid fa-circle-right"></i></button>
                        </div>
                        <div class="d-flex flex-column hr-notificacion">
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-red"></i></button>
                                        <b>Revisión de Motor y desperfecto y...</b>
                                    </div>
                                    <b class="color-dark-blue">Urgente</b>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-transparent"></i></button>
                                        <span>Atención: </span>
                                    </div>
                                    <b class="color-dark-blue">ASAP</b>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-red"></i></button>
                                        <b>Comprar pistones para motor del …</b>
                                    </div>
                                    <b class="color-dark-blue">Urgente</b>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-transparent"></i></button>
                                        <span>Atención: </span>
                                    </div>
                                    <b class="color-dark-blue">ASAP</b>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-yellow"></i></button>
                                        <b>Comprar utensilios para paseo…</b>
                                    </div>
                                    <b class="color-dark-blue">Alerta</b>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-transparent"></i></button>
                                        <span>Atención: </span>
                                    </div>
                                    <b class="color-dark-blue">14/09/2022</b>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-yellow"></i></button>
                                        <b>Cambio de aceite en barco Naut…</b>
                                    </div>
                                    <b class="color-dark-blue">Alerta</b>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-transparent me-2"><i class="fa-solid fa-triangle-exclamation color-transparent"></i></button>
                                        <span>Atención: </span>
                                    </div>
                                    <b class="color-dark-blue">22/09/2022</b>
                                </div>
                                <hr class="my-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Fin de dashboard admin -->

        <!-- Inicio equipamiento de barco -->

        <div class="container-fluid px-md-5 d-none" id="equipamiento-admin">
            <div class="text-center mt-3">
                <h6 class="color-dark-blue"> <b> Barcos </b> </h6>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn-atras" id="atras-equipamiento">
                        <i class="fa-solid fa-arrow-left"></i>
                        <b> Atras </b>
                    </button>
                </div>
                <div>
                    <h5> <b> Ingreso de Nuevo Barco / Equipamiento </b> </h5>
                </div>
                <div>
                    <button class="btn-descartar"> <b> Descartar </b> <i class="fa-solid fa-trash-can"></i> </button>
                </div>
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <span>Octubre 2022</span> <i
                            class="fa-solid fa-angle-right color-dark-blue fa-lg ms-3"></i> </button>
                </div> -->
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-9 mt-3">
                    <h6 class="color-dark-extras"><b> Indica el equipamiento que posee tu embarcación
                            [nombre_de_la_barca] * </b></h6>
                    <p class="color-extras-gray f-9">Si tu embarcación consta con un equipamiento que no está en estos
                        listados, por favor dirígete
                        hasta
                        la pestaña de <span class="color-dark-blue"> Extras </span> para generarlo y vuelve a esta
                        sección a adherir el equipamiento.</p>

                    <div class="row">

                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong>Exterior</strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio1" checked>
                                    <label class="f-9" for="exterior-radio1"> Toldo </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio2">
                                    <label class="f-9" for="exterior-radio2"> Ducha exterior </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio3">
                                    <label class="f-9" for="exterior-radio3"> Mesa comedor </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio4">
                                    <label class="f-9" for="exterior-radio4"> Sistema estéreo </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio5">
                                    <label class="f-9" for="exterior-radio5"> Cubierta de teca </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio6">
                                    <label class="f-9" for="exterior-radio6"> Salarium en proa </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio7">
                                    <label class="f-9" for="exterior-radio7"> Salarium en popa </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio8">
                                    <label class="f-9" for="exterior-radio8"> Plataforma de baño </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="exterior-radio" id="exterior-radio9">
                                    <label class="f-9" for="exterior-radio9"> Escalera de baño </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong>Comfort</strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio1" checked>
                                    <label class="f-9" for="comform-radio1"> Agua caliente </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio2">
                                    <label class="f-9" for="comform-radio2"> Desalinizadora </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio3">
                                    <label class="f-9" for="comform-radio3"> Aire acondicionado </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio4">
                                    <label class="f-9" for="comform-radio4"> Ventiladores </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio5">
                                    <label class="f-9" for="comform-radio5"> Calefacción </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio6">
                                    <label class="f-9" for="comform-radio6"> WC eléctrico </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio7">
                                    <label class="f-9" for="comform-radio7"> Ropa de cama </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio8">
                                    <label class="f-9" for="comform-radio8"> Toallas de baño </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio9">
                                    <label class="f-9" for="comform-radio9"> Toallas de playa </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio10">
                                    <label class="f-9" for="comform-radio10"> Puerto USB </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="comform-radio" id="comform-radio11">
                                    <label class="f-9" for="comform-radio11"> Televisión </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong> De Navegación </strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio1" checked>
                                    <label class="f-9" for="navegation-radio1"> Anexo </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio2">
                                    <label class="f-9" for="navegation-radio2"> Ducha exterior </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio3">
                                    <label class="f-9" for="navegation-radio3"> Mesa comedor </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio4">
                                    <label class="f-9" for="navegation-radio4"> Sistema estéreo </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio5">
                                    <label class="f-9" for="navegation-radio5"> Cubierta de teca </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio6">
                                    <label class="f-9" for="navegation-radio6"> Salarium en proa </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio7">
                                    <label class="f-9" for="navegation-radio7"> Salarium en popa </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio8">
                                    <label class="f-9" for="navegation-radio8"> Plataforma de baño </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="navegation-radio" id="navegation-radio9">
                                    <label class="f-9" for="navegation-radio9"> Escalera de baño </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong> Cocina </strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio1" checked>
                                    <label class="f-9" for="cocina-radio1"> Frigorífico </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio2">
                                    <label class="f-9" for="cocina-radio2"> Congelador </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio3">
                                    <label class="f-9" for="cocina-radio3"> Horno/cocina </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio4">
                                    <label class="f-9" for="cocina-radio4"> Parrilla/barbacoa </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio5">
                                    <label class="f-9" for="cocina-radio5"> Microondas </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio6">
                                    <label class="f-9" for="cocina-radio6"> Máquina de café </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio7">
                                    <label class="f-9" for="cocina-radio7"> Máquina de hielo </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="cocina-radio" id="cocina-radio8">
                                    <label class="f-9" for="cocina-radio8"> Congelador </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong> Ocio </strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio1" checked>
                                    <label class="f-9" for="ocio-radio1"> Tabla de Paddle </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio2">
                                    <label class="f-9" for="ocio-radio2"> Kayak </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio3">
                                    <label class="f-9" for="ocio-radio3"> Gafas y tubos </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio4">
                                    <label class="f-9" for="ocio-radio4"> Equipos de pesca </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio5">
                                    <label class="f-9" for="ocio-radio5"> Equipos de buceo </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio6">
                                    <label class="f-9" for="ocio-radio6"> Seabob </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio7">
                                    <label class="f-9" for="ocio-radio7"> Bicicleta </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio8">
                                    <label class="f-9" for="ocio-radio8"> Patinente eléctrico</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio9">
                                    <label class="f-9" for="ocio-radio9"> Dron </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="ocio-radio" id="ocio-radio10">
                                    <label class="f-9" for="ocio-radio10"> Cámara </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong> Deportes Acuáticos </strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="sport-radio" id="sport-radio1" checked>
                                    <label class="f-9" for="sport-radio1"> Esquí acuático </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="sport-radio" id="sport-radio2">
                                    <label class="f-9" for="sport-radio2"> Mono Esquí </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="sport-radio" id="sport-radio3">
                                    <label class="f-9" for="sport-radio3"> Wakeboard </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="sport-radio" id="sport-radio4">
                                    <label class="f-9" for="sport-radio4"> Donut </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="sport-radio" id="sport-radio5">
                                    <label class="f-9" for="sport-radio5"> Plátano hinchable </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="sport-radio" id="sport-radio6">
                                    <label class="f-9" for="sport-radio6"> Kneeboard </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong> Energía eléctrica </strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="energy-radio" id="energy-radio1" checked>
                                    <label class="f-9" for="energy-radio1"> Generador </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="energy-radio" id="energy-radio2">
                                    <label class="f-9" for="energy-radio2"> Inversor </label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="energy-radio" id="energy-radio3">
                                    <label class="f-9" for="energy-radio3"> Toma corriente (220 V) </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <strong> Ningún equipamiento </strong>
                            <div class="d-flex flex-column mt-3">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="me-2" type="radio" name="sin-radio" id="sin-radio3">
                                    <label class="f-9" for="sin-radio3"> Ninguno en especial </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 my-5">
                        <button class="btn-siguiente-general" id="next-equipamiento"> <span> Siguiente </span> <i class="fa-solid fa-arrow-right"></i> </button>
                    </div>


                </div>
                <div class="col-12 col-lg-4 col-xl-3 mt-3 ps-xxl-5">
                    <div class="container bg-gray py-3">
                        <p class="color-gray-dark">
                            Recuerda que entre más llenes los campos, tendrás más chances en que encuentren mejor tu
                            barca y sus atributos y dejarás en claro lo que ofreces sin tener ninguna sorpresa al
                            momento del alquiler.
                        </p>
                        <p class="color-gray-dark">
                            Ingresa todos los campos obligatorios (*) y presiona el botón
                            siguiente para que la sección se marque como terminada.
                        </p>
                        <button class="btn bnt-transparent d-flex align-items-center mt-5">
                            <i class="fa-solid fa-life-ring me-2"></i>
                            <strong class="color-gray">
                                ¿Necesitas Ayuda?
                            </strong>
                        </button>

                        <hr class="mt-3 mb-2">

                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-message color-gray-dark me-2"></i>
                                    <span class="color-blue"> Chat online</span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-phone color-gray-dark me-2"></i>
                                    <span class="color-blue"> Por Teléfono: </span>
                                    <span class="color-gray-dark"> +34 966 655 433 </span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-envelope color-gray-dark me-2"></i>
                                    <span class="color-blue"> E-mail: support@MBM.es </span>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <!-- Fin equipamiento de barco -->

        <!-- Inicio de resumen reserva barco -->

        <div class="container-fluid px-md-5 d-none" id="resume-reserva-admin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-transparent color-extras-gray"> <i class="fa-solid fa-angle-left color-dark-blue fa-lg me-3"></i> <span>Jueves
                            02/09/2022</span>
                    </button>
                </div>
                <div>
                    <h5 class="text-center mt-3 color-dark-blue"> <b> Barco </b> </h5>
                </div>
                <div></div>
            </div>
            <hr>

            <div class="w-100 my-3">
                <span class="color-dark-blue"> Septiembre 2022 </span>
                <span class="color-dark-blue"> | </span>
                <span class="color-dark-blue"> 12/12/2021 </span>
                <span class="color-dark-extras"> | </span>
                <span class="color-dark-extras">Barco Namaré </span>
                <strong class="color-dark-extras">
                    11:00 a 12:00
                </strong>
            </div>
            <div class="d-flex justify-content-between flex-column flex-md-row">
                <div>
                    <button class="btn-atras" id="atras-resume"> <i class="fa-solid fa-arrow-left"></i> Atrás </button>
                </div>
                <div class="d-flex">
                    <button class="btn-cancelar-reserva me-3 px-2"> Cerrar reserva <i class="fa-solid fa-power-off color-dark-red ms-2"></i> </button>
                    <button class="btn-cancelar-reserva me-3">Cancelar reserva <i class="fa-solid fa-circle-xmark color-dark-red ms-2"></i> </button>
                    <button class="btn-guardar-mod px-4"> <span class="position-relative right-5rem"> Guardar
                            modificaciones </span> <i class="fa-solid fa-floppy-disk position-relative left-7rem"></i>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 mt-3">
                    <div class="container-fluid bg-container-gray">
                        <h5><b>Datos de la reserva</b></h5>
                        <div class="d-flex flex-column">
                            <div class="py-3">
                                <div class="p-2 bg-blue-light color-dark-extras">
                                    <span> Bloqueada parcialmente </span>
                                </div>
                            </div>
                            <div class="d-flex p-2 py-3 justify-content-between">
                                <div class="col-4 col-md-6 col-xl-2">
                                    <span> Barco </span>
                                </div>
                                <div class="col-8 col-md-6 col-xl-4">
                                    <select class="form-select" name="" id="">
                                        <option value=""><?php echo $reserva_data?->nombre  ?></option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between p-2">
                                <span> Fecha: </span>
                                <div class="d-flex align-items-center">
                                    <span class="color-dark-extras me-2">
                                        <?php echo $reserva_data?->fecha ?>
                                    </span>
                                    <button class="btn btn-transparent color-dark-extras">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-between">
                                <div class="col-2">
                                    <span> Salida: </span>
                                </div>
                                <div class="col-6 col-sm-5 col-lg-3 col-xl-2">
                                    <select class="form-select" name="" id="">
                                        <option value="">
                                            <?php echo $reserva_data?->hora_inicio ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-between">
                                <div class="col-2">
                                    <span> Regreso: </span>
                                </div>
                                <div class="col-6 col-sm-5 col-lg-3 col-xl-2">
                                    <select class="form-control" name="" id="">
                                        <option value="">(+) <?php echo $reserva_data?->hora_fin ?></option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between p-2">
                                <div class="col-2">
                                    <span> Responsable: </span>
                                </div>
                                <div class="col-8 col-md-6 col-xl-4 d-flex">
                                    <button class="btn btn-transparent color-dark-extras position-absolute left-25rem">
                                        <i class="fa-solid fa-address-card fa-xl"></i>
                                    </button>
                                    <input class="form-control text-end" type="text" value="Salavarria Guillermo">
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-between">
                                <div class="col-2">
                                    <span> Titulado: </span>
                                </div>
                                <div class="col-8 col-md-6 col-xl-4">
                                    <select class="form-control" name="" id="">
                                        <option value="">Ex-marino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-between">
                                <div class="col-2">
                                    <span> Teléfono: </span>
                                </div>
                                <div class="col-8 col-md-6 col-xl-4">
                                    <input class="form-control" type="text" value="+543 345 2334 22">
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-between">
                                <div class="col-2">
                                    <span> Email: </span>
                                </div>
                                <div class="col-8 col-md-6 col-xl-4">
                                    <input class="form-control" type="text" value="Salvarriag@gmail.com">
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="" id="" cols="30" style="height: 6rem;" rows="10">Nota: Voy a estar yendo con una persona des-capacitada y necesito tener buen acceso para silla de rueda.
                                </textarea>
                            </div>
                            <hr>



                            <div class="d-flex py-4 ps-2 align-items-center">
                                <h5 class="me-3 mt-1 color-dark-extras">Asistentes: </h5>
                                <div class="d-flex flex-1602-column me-3">
                                    <div class="d-flex fa-gray justify-content-between mb-3 me-1602-2">
                                        <span class="me-2 color-extras-gray"> Adultos </span>
                                        <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                        <span class="mx-2 color-dark-extras">
                                            <?php echo $reserva_data?->cant_adultos ?>
                                        </span>
                                        <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="d-flex fa-gray justify-content-between me-1602-2">
                                        <span class="me-2 color-extras-gray"> 4 a 12 </span>
                                        <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                        <span class="mx-2 color-dark-extras"> <?php echo $reserva_data?->cant_tres_doce ?> </span>
                                        <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="d-flex flex-1602-column">
                                    <div class="d-flex fa-gray mb-3 justify-content-between me-1602-2">
                                        <span class="me-2 color-extras-gray"> 1 a 3 </span>
                                        <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                        <span class="mx-2 color-dark-extras"> <?php echo $reserva_data?->cant_uno_tres ?> </span>
                                        <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="d-flex fa-gray justify-content-between me-1602-2">
                                        <span class="me-2 color-extras-gray"> Bebés </span>
                                        <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                        <span class="mx-2 color-dark-extras"> <?php echo $reserva_data?->cant_bebes ?> </span>
                                        <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>



                            <hr>
                            <div class="d-flex flex-column py-4 ps-2 fa-gray">
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Padel Board:</span>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                        <span class="mx-2">3</span>
                                        <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span> Snorkel Clásicos: </span>
                                    <div class="d-flex align-items-center">
                                        <span class="color-extras-gray"> S </span>
                                        <div class="d-flex align-items-center mx-2">
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2">3</span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <div class="d-flex align-items-center mx-2">
                                            <span class="color-extras-gray me-2"> M </span>
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 2 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <div class="d-flex align-items-center mx-2">
                                            <span class="color-extras-gray me-2"> L </span>
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 0 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span> Snorkel Fullface: </span>
                                    <div class="d-flex align-items-center">
                                        <span class="color-extras-gray"> S </span>
                                        <div class="d-flex align-items-center mx-2">
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2">3</span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <div class="d-flex align-items-center mx-2">
                                            <span class="color-extras-gray me-2"> M </span>
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 2 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <div class="d-flex align-items-center mx-2">
                                            <span class="color-extras-gray me-2"> L </span>
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 0 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span> Set de Aletas: </span>
                                    <div class="d-flex align-items-center">
                                        <span class="color-extras-gray"> S </span>
                                        <div class="d-flex align-items-center mx-2">
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2">3</span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <div class="d-flex align-items-center mx-2">
                                            <span class="color-extras-gray me-2"> M </span>
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 2 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <div class="d-flex align-items-center mx-2">
                                            <span class="color-extras-gray me-2"> L </span>
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 0 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="color-dark-extras"> Catering Básico: </span>
                                    <div class="d-flex align-items-center">
                                        <span class="f-8 me-3 color-extras-gray">Cada paquete es para 3 Personas
                                            aprox.</span>
                                        <div class="d-flex align-items-center mx-2">
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 1 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="color-dark-extras"> Catering Standard: </span>
                                    <div class="d-flex align-items-center">
                                        <span class="f-8 me-3 color-extras-gray"> Cada paquete es para 5 Personas aprox.
                                        </span>
                                        <div class="d-flex align-items-center mx-2">
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 1 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="color-dark-extras"> Catering Premium: </span>
                                    <div class="d-flex align-items-center">
                                        <span class="f-8 me-3 color-extras-gray"> Cada paquete es para 5 Personas aprox.
                                        </span>
                                        <div class="d-flex align-items-center mx-2">
                                            <button class="btn btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                            <span class="mx-2"> 1 </span>
                                            <button class="btn btn-plus-white btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="mt-3">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 color-dark-extras"> Provisiones Extra: </h6>
                                    <span class="mb-3 f-9 color-gray-dark"> 3 Bolsas de chips medianas </span>
                                    <span class="mb-3 f-9 color-extras-gray"> 2 Gaseosas Cocacola de 3 litros </span>
                                    <span class="mb-3 f-9 color-extras-gray"> 3 Pastillas para el mareo (caja) </span>
                                </div>
                            </div>
                            <hr>

                            <section>
                                <div class="d-flex justify-content-between mt-4 mb-3">
                                    <span class="color-extras-gray f-8"> Botella de champagne (de preferencia Don
                                        Perignon) del año 78 </span>
                                    <button class="btn btn-transparent color-dark-red"> <i class="fa-solid fa-trash-can"></i> </button>
                                </div>

                                <div class="row add-provision">
                                    <div class="col-7 col-lg-6">
                                        <input class="form-control" type="text" placeholder="Agregar nueva provisión">
                                    </div>
                                    <div class="col-5 col-lg-3">
                                        <input class="form-control" type="text" placeholder="Importe Neto €*">
                                    </div>
                                    <div class="col-12 col-lg-3 my-lg-0 my-3 d-flex d-lg-inline justify-content-center">
                                        <button class="btn btn-add-provision f-8">Agregar provisión</button>
                                    </div>

                                </div>
                            </section>

                            <hr class="my-3">

                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-2">
                                        <span>Reserva desde: </span>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control text-end" type=" text" value="Empresa Nautal S.A.">
                                    </div>
                                </div>
                                <hr class="my-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-2">
                                        <span>Tipo de Reserva: </span>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control" name="" id="">
                                            <option value="">Flexible</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="my-3">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-5">
                                        <span>Reserva hecha/modificada: </span>
                                    </div>
                                    <div class="col-3 text-end">
                                        <span>14/09/2022 20:34</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <h5 class="mb-3"><b> Ingresos </b></h5>
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9">Barco (en concesión)</span>
                            <span class="color-blue f-9">175 €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9">Barco (en concesión)</span>
                            <span class="color-blue f-9">175 €</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-column mt-3">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9">Paddle Board x 3</span>
                            <span class="color-blue f-9">175 €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9">Set Snorkel Clásico x 5</span>
                            <span class="color-blue f-9">175 €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9">Set Snorketl Fullface x 1</span>
                            <span class="color-blue f-9">175 €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9">Set Aletas x 3</span>
                            <span class="color-blue f-9">175 €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9">Categering básico x 1</span>
                            <span class="color-blue f-9">175 €</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-column mt-3">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9"> Extra 1 x 3 </span>
                            <span class="color-blue f-9"> 8€ </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9"> Extra 2 x 2 </span>
                            <span class="color-blue f-9"> 8€ </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9"> Extra 2 x 3 </span>
                            <span class="color-blue f-9"> 8€ </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9"> Extra 3 x 1 </span>
                            <span class="color-blue f-9"> 8€ </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9"> Extra 4 x 1 </span>
                            <span class="color-blue f-9"> 8€ </span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="f-9"> Reserva Flexible </span>
                            <span class="color-blue f-9">25€</span>
                        </div>
                        <div class="bg-container-gray p-2 mb-3 px-3">
                            <div class="d-flex justify-content-between">
                                <span class="f-9"> Total Ingresos </span>
                                <strong class="color-dark-extras f-9">115€</strong>
                            </div>
                        </div>

                        <h5 class="my-3"> <b> Gastos </b></h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="f-9"> Comisión reserva [Empresa Nautal.S.A.] </span>
                            <span class="color-blue f-9"> 65€ </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="f-9"> Barco en concesión dueño </span>
                            <span class="color-blue f-9"> 40€ </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="f-9"> Barco en concesión Gestor de comisión </span>
                            <span class="color-blue f-9"> 40€ </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="f-9"> Gastos por peaje extra </span>
                            <span class="color-blue f-9"> 40€ </span>
                        </div>

                        <div class="w-100">
                            <input class="form-control f-9" type="text" placeholder="Descripción de nuevo gasto*">
                        </div>
                        <div class="row add-provision mt-3">
                            <div class="col-7 col-lg-6">
                                <input class="form-control" type="text" placeholder="Agregar nueva provisión">
                            </div>
                            <div class="col-5 col-lg-3">
                                <input class="form-control" type="text" placeholder="Importe Neto €*">
                            </div>
                            <div class="col-12 col-lg-3 my-lg-0 my-3 d-flex d-lg-inline justify-content-center">
                                <button type="button" class="btn btn-add-provision f-8" id="btn-img-factura"> <span class="me-2">Adjuntar Factura</span>
                                    <i class="fa-solid fa-camera fa-lg"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-add-provision position-relative right-18rem f-8"> <span class="me-2 f-8">agregar nuevo pago</span>
                            </button>
                        </div>

                        <div class="bg-container-gray p-2 mb-3 px-3">
                            <div class="d-flex justify-content-between">
                                <span class="f-9"> Total Ingresos </span>
                                <strong class="color-dark-extras f-9">115€</strong>
                            </div>
                        </div>
                        <div class="bg-blue p-2 px-3">
                            <div class="d-flex justify-content-between">
                                <strong class="color-white f-8"> Total Gastos </strong>
                                <strong class="color-white f-8">320€</strong>
                            </div>
                        </div>

                        <h5 class="my-3 color-dark-extras"> <b> Abono del cliente </b> </h5>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="f-8 me-4">Pago de 30% de reserva </span>
                                <span class="f-8 color-blue me-2">Paypal</span>
                                <button class="btn btn-transparent color-extras-gray">
                                    <i class="fa-solid fa-camera fa-lg"></i>
                                </button>
                            </div>
                            <div class="d-flex">
                                <strong class="me-2 color-dark-extras"> 125€ </strong>
                                <button class="btn btn-transparent color-red"> <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>

                        <div class="w-100 mt-3">
                            <input class="form-control f-9 color-extras-gray" type="text" placeholder="Descripción de nuevo pago*">
                        </div>
                        <div class="row add-provision mt-3">
                            <div class="col-7 col-lg-6">
                                <input class="form-control" type="text" placeholder="Agregar nueva provisión">
                            </div>
                            <div class="col-5 col-lg-3">
                                <input class="form-control" type="text" placeholder="Importe Neto €*">
                            </div>
                            <div class="col-12 col-lg-3 my-lg-0 my-3 d-flex d-lg-inline justify-content-center">
                                <button type="button" class="btn btn-add-provision f-8" id="btn-img-factura"> <span class="me-2">Adjuntar Factura</span>
                                    <i class="fa-solid fa-camera fa-lg"></i>
                                </button>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <button class="btn btn-transparent color-yellow me-2"> <i class="fa-solid fa-triangle-exclamation"></i> </button>
                                <span class="f-9 color-dark-extras"> Saldo para cobrar </span>
                            </div>
                            <strong class="">
                                292€
                            </strong>
                        </div>

                        <div class="w-100 mt-3">
                            <div class="form-group">
                                <label class="form-label" for=""><b> Observaciones </b></label>
                                <textarea class="form-control" name="" id="" cols="30" rows="10" style="height: 10rem;"></textarea>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <button class="btn btn-transparent color-gray-dark me-2"> <i class="fa-solid fa-triangle-exclamation"></i> </button>
                            <span class="color-dark-extras f-9">Esta observación sobre [responsable] se te advertirá
                                cada vez que haga una reserva.</span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="d-flex flex-column mt-5 ms-2">
                <div>
                    <button class="btn-downloads-reserva px-3 py-1 f-9">
                        <span class="me-2">Descargar instructivo de embaración</span>
                        <i class="fa-solid fa-file-pdf"></i>
                    </button>
                </div>
                <div class="d-flex mt-3">
                    <button class="me-3 btn-downloads-reserva px-4 py-1">
                        <span class="me-2"> Descargar Contrato </span>
                        <i class="fa-solid fa-file-pdf"></i>
                    </button>
                    <button class="btn-downloads-reserva px-4 py-1"> <span class="me-2"> Descargar Recibo </span> <i class="fa-solid fa-file-pdf"></i></button>
                </div>
            </div>


            <input class="d-none" type="file" name="" id="input-img-factura" accept="image/*">

        </div>

        <!-- Fin de resumen reserva barco -->


        <!-- Inicio de seguro de barco -->

        <div class="container-fluid px-md-5 d-none" id="seguro-admin">
            <div class="text-center mt-3">
                <h6 class="color-dark-blue"> <b> Barcos </b> </h6>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn-atras" id="atras-seguro">
                        <i class="fa-solid fa-arrow-left"></i>
                        <b> Atras </b>
                    </button>
                </div>
                <div>
                    <h5> <b> Ingreso de Nuevo Barco / Seguro </b> </h5>
                </div>
                <div>
                    <button class="btn-descartar"> <b> Descartar </b> <i class="fa-solid fa-trash-can"></i> </button>
                </div>
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <span>Octubre 2022</span> <i
                            class="fa-solid fa-angle-right color-dark-blue fa-lg ms-3"></i> </button>
                </div> -->
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-9 mt-3">
                    <div class="d-flex flex-column">
                        <h5 class="color-dark-extras mb-4"> <b> Seguro </b> </h5>
                        <span class="color-dark-extras mb-4">Fianza *</span>
                        <div class="d-flex mb-4">
                            <input class="form-control" type="text" style="width: 15rem; padding-right: 2rem;">
                            <button disabled class="btn btn-transparent position-relative" style="right: 1.5rem;">
                                <i class="fa-solid fa-euro-sign"></i></button>
                        </div>
                        <span class="color-dark-extras mb-4">Aproximadamente 200 €</span>
                        <strong class="color-dark-extras mb-3">Certificado de seguros *</strong>
                        <input class="mb-3" type="file">
                        <div class="container-fluid d-flex justify-content-center py-4 border-dotted mb-4">
                            <h5 class="color-dark-extras"> <b> Mallorca, España </b> </h5>
                        </div>
                        <span class="color-dark-extras mb-3">¿Está asegurada su embarcación?*</span>
                        <div>
                            <select class="form-select mb-3" name="" id="" style="width: 25rem">
                                <option value="A todo riesgo">A todo riesgo</option>
                            </select>
                        </div>
                        <div class="form-check mb-5">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label ms-3 color-dark-extras" for="flexCheckDefault">
                                Declaro que mi embarcación estará asegurada (a terceros o a todo riesgo) siempre que se
                                alquile y que informaré a mi aseguradora sobre mi actividad de alquiler entre
                                particulares, excepto en caso de alquiler en el muelle o conavegación.
                            </label>
                        </div>

                        <div class="w-100">
                            <button class="btn-siguiente-general" id="btn-next-seguro">
                                <span> Siguiente </span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                        <!-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Checked checkbox
                            </label>
                        </div> -->

                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-3 mt-3 ps-xxl-5">
                    <div class="container bg-gray py-3">
                        <p class="color-gray-dark">
                            Recuerda que entre más llenes los campos, tendrás más chances en que encuentren mejor tu
                            barca y sus atributos y dejarás en claro lo que ofreces sin tener ninguna sorpresa al
                            momento del alquiler.
                        </p>
                        <p class="color-gray-dark">
                            Ingresa todos los campos obligatorios (*) y presiona el botón
                            siguiente para que la sección se marque como terminada.
                        </p>
                        <button class="btn bnt-transparent d-flex align-items-center mt-5">
                            <i class="fa-solid fa-life-ring me-2"></i>
                            <strong class="color-gray">
                                ¿Necesitas Ayuda?
                            </strong>
                        </button>

                        <hr class="mt-3 mb-2">

                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-message color-gray-dark me-2"></i>
                                    <span class="color-blue"> Chat online</span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-phone color-gray-dark me-2"></i>
                                    <span class="color-blue"> Por Teléfono: </span>
                                    <span class="color-gray-dark"> +34 966 655 433 </span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-envelope color-gray-dark me-2"></i>
                                    <span class="color-blue"> E-mail: support@MBM.es </span>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <!-- Fin de seguro de barco -->

        <!-- Inicio de precios de barco -->

        <div class="container-fluid px-md-5 d-none mt-7" id="precio-de-barco">
            <div class="text-center mt-3">
                <h6 class="color-dark-blue"> <b> Barcos </b> </h6>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn-atras" id="atras-precio">
                        <i class="fa-solid fa-arrow-left"></i>
                        <b> Atras </b>
                    </button>
                </div>
                <div>
                    <h5> <b> Ingreso de Nuevo Barco / Precios </b> </h5>
                </div>
                <div>
                    <button class="btn-descartar"> <b> Descartar </b> <i class="fa-solid fa-trash-can"></i> </button>
                </div>
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <span>Octubre 2022</span> <i
                            class="fa-solid fa-angle-right color-dark-blue fa-lg ms-3"></i> </button>
                </div> -->
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-9 mt-3">
                    <h6 class="color-dark-extras my-4"> <b> Precio de referencia </b> </h6>
                    <p class="color-dark-extras mb-5">
                        Establece un precio determinado para alquilar tu barco, equivalente al precio mas barato que
                        puedas aceptar y fuera de los periodos especiales. Luego, podrás crear periodos de precios
                        personalizados
                    </p>

                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <strong class="color-dark-extras"> Precios y opciones * </strong>
                        <button class="btn-new-precio px-4 py-2"> Crear nuevo periodo de precio </button>
                    </div>

                    <div class="d-flex mb-5">
                        <span class="me-4"> Precio por día: </span>
                        <input type="text">
                    </div>

                    <div class="mb-5">
                        <h5> Opciones avanzados </h5>
                    </div>

                    <div class="mb-5">
                        <h5> Parámetros de configuración </h5>
                    </div>
                    <div class="w-100 mt-5">
                        <button class="btn-siguiente-general" id="btn-next-precios"> <span> Siguiente </span> <i class="fa-solid fa-arrow-right"></i> </button>
                    </div>


                </div>
                <div class="col-12 col-lg-4 col-xl-3 mt-3 ps-xxl-5">
                    <div class="container bg-gray py-3">
                        <p class="color-gray-dark">
                            Recuerda que entre más llenes los campos, tendrás más chances en que encuentren mejor tu
                            barca y sus atributos y dejarás en claro lo que ofreces sin tener ninguna sorpresa al
                            momento del alquiler.
                        </p>
                        <p class="color-gray-dark">
                            Ingresa todos los campos obligatorios (*) y presiona el botón
                            siguiente para que la sección se marque como terminada.
                        </p>
                        <button class="btn bnt-transparent d-flex align-items-center mt-5">
                            <i class="fa-solid fa-life-ring me-2"></i>
                            <strong class="color-gray">
                                ¿Necesitas Ayuda?
                            </strong>
                        </button>

                        <hr class="mt-3 mb-2">

                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-message color-gray-dark me-2"></i>
                                    <span class="color-blue"> Chat online</span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-phone color-gray-dark me-2"></i>
                                    <span class="color-blue"> Por Teléfono: </span>
                                    <span class="color-gray-dark"> +34 966 655 433 </span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-envelope color-gray-dark me-2"></i>
                                    <span class="color-blue"> E-mail: support@MBM.es </span>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <!-- Fin de precios de barco -->

        <!-- Inicio reservas de barco -->


        <div class="container-fluid px-md-5 d-none" id="reserva-barco">

            <div class="text-center mt-3">
                <h6 class="color-dark-blue"> <b> Barcos </b> </h6>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn-atras" id="atras-reserva">
                        <i class="fa-solid fa-arrow-left"></i>
                        <b> Atras </b>
                    </button>
                </div>
                <div>
                    <h5> <b> Ingreso de Nuevo Barco / Reservas </b> </h5>
                </div>
                <div>
                    <button class="btn-descartar"> <b> Descartar </b> <i class="fa-solid fa-trash-can"></i> </button>
                </div>
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <span>Octubre 2022</span> <i
                            class="fa-solid fa-angle-right color-dark-blue fa-lg ms-3"></i> </button>
                </div> -->
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-9 mt-3">
                    <h6 class="color-dark-extras my-4"> <b> Precio de referencia </b> </h6>
                    <p class="color-dark-extras mb-5">
                        Establece un precio determinado para alquilar tu barco, equivalente al precio mas barato que
                        puedas aceptar y fuera de los periodos especiales. Luego, podrás crear periodos de precios
                        personalizados
                    </p>

                    <div class="d-flex justify-content-end">
                        <button class="btn-new-precio px-3 py-2">Crear un nuevo periodo de precio</button>
                    </div>
                    <div class="container-fluid">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active rounded-top-pill tab-reserva me-1" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Precios y opciones</button>
                                <button class="nav-link rounded-top-pill tab-reserva me-1" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Opciones avanzados</button>
                                <button class="nav-link rounded-top-pill tab-reserva me-1" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Parámetros de
                                    configuración</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active border border-light-gray" id="nav-home" role="tabpanel" style="height: 27rem;" aria-labelledby="nav-home-tab">
                                ...
                            </div>
                            <div class="tab-pane fade border-light-gray" id="nav-profile" role="tabpanel" style="height: 27rem;" aria-labelledby="nav-profile-tab">
                                ...
                            </div>
                            <div class="tab-pane fade border-light-gray" id="nav-contact" role="tabpanel" style="height: 27rem;" aria-labelledby="nav-contact-tab">
                                ...
                            </div>
                        </div>
                    </div>


                    <div class="mt-5 ms-4">
                        <button class="btn-siguiente-general" id="btn-next-reserva">
                            <span> Siguiente </span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                </div>
                <div class="col-12 col-lg-4 col-xl-3 mt-3 ps-xxl-5">
                    <div class="container bg-gray py-3">
                        <p class="color-gray-dark">
                            Recuerda que entre más llenes los campos, tendrás más chances en que encuentren mejor tu
                            barca y sus atributos y dejarás en claro lo que ofreces sin tener ninguna sorpresa al
                            momento del alquiler.
                        </p>
                        <p class="color-gray-dark">
                            Ingresa todos los campos obligatorios (*) y presiona el botón
                            siguiente para que la sección se marque como terminada.
                        </p>
                        <button class="btn bnt-transparent d-flex align-items-center mt-5">
                            <i class="fa-solid fa-life-ring me-2"></i>
                            <strong class="color-gray">
                                ¿Necesitas Ayuda?
                            </strong>
                        </button>

                        <hr class="mt-3 mb-2">

                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-message color-gray-dark me-2"></i>
                                    <span class="color-blue"> Chat online</span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-phone color-gray-dark me-2"></i>
                                    <span class="color-blue"> Por Teléfono: </span>
                                    <span class="color-gray-dark"> +34 966 655 433 </span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-envelope color-gray-dark me-2"></i>
                                    <span class="color-blue"> E-mail: support@MBM.es </span>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <!-- Fin reservas de barco -->

        <!-- Inicio de descripción -->

        <div class="container-fluid px-md-5 d-none" id="descripcion-barco-admin">
            <div class="text-center mt-3">
                <h6 class="color-dark-blue"> <b> Barcos </b> </h6>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn-atras" id="atras-descripcion">
                        <i class="fa-solid fa-arrow-left"></i>
                        <b> Atras </b>
                    </button>
                </div>
                <div>
                    <h5> <b> Ingreso de Nuevo Barco / Descripción </b> </h5>
                </div>
                <div>
                    <button class="btn-descartar"> <b> Descartar </b> <i class="fa-solid fa-trash-can"></i> </button>
                </div>
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <span>Octubre 2022</span> <i
                            class="fa-solid fa-angle-right color-dark-blue fa-lg ms-3"></i> </button>
                </div> -->
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-9 mt-3">
                    <h6 class="color-dark-extras my-4"> <b> Tipo de barco </b> </h6>
                    <h4> <b> [Nombre_del_barco_99] </b> </h4>
                    <h6> <b> Descripción * </b> </h6>

                    <div class="form-group mb-3">
                        <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                    </div>

                    <p class="color-extras-gray f-9">
                        Habla de tu barco, capacidad a bordo, equipamiento, seguridad. La historia del barco, el uso que
                        le das (excursiones en familia, regates, etc). Habla de ti! Porque obtuviste este barco. En qué
                        puerto se encuentra. Alguna anécdota particular. Por qué con esta embarcación es la óptima para
                        pasar un rato ameno.
                    </p>

                    <hr class="my-3" style="height: 2px;">

                    <h5 class="color-dark-extras"> <b> Aspectos Técnicos </b> </h5>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4">
                            <label class="f-9" for="">Capacidad a bordo autorizada *</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4">
                            <label class="f-9" for="">Capacidad a bordo recomendada *</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4">
                            <label class="f-9" for="">Número de cabinas *</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4">
                            <label class="f-9" for="">Número de camas *</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4">
                            <label class="f-9" for="">Número de baños *</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-xl-8 d-flex justify-content-between flex-column flex-lg-row" id="screen-computer">
                            <div>
                                <label class="f-8" for="">Eslora (largo de la embarcación) *</label>
                                <input class="form-control w-xxl-80" type="text">
                                <span class="float-end position-relative f-9 position-medida">m</span>
                            </div>
                            <div>
                                <section class="d-flex">
                                    <div>
                                        <label class="f-9" for=""> Combustible *</label>
                                        <input class="form-control" type="text">
                                        <span class="float-end position-relative f-9" style="bottom: 1.7rem; right: .5rem;">L/h</span>
                                    </div>
                                    <div class="ms-3">
                                        <label class="f-9" for=""> Velocidad de crucero </label>
                                        <input class="form-control" type="text">
                                        <span class="float-end position-relative f-9" style="bottom: 1.7rem; right: .5rem;">Kn</span>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <label class="f-9" for=""> Año de la embarcación *</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <label class="f-9" for=""> Renovación </label>
                            <input class="form-control" type="text">
                        </div>
                    </div>

                    <div class="my-5 ms-4">
                        <button class="btn-siguiente-general" id="next-resume-reserva-admin">
                            <span> Siguiente </span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                </div>
                <div class="col-12 col-lg-4 col-xl-3 mt-3 ps-xxl-5">
                    <div class="container bg-gray py-3">
                        <p class="color-gray-dark">
                            Recuerda que entre más llenes los campos, tendrás más chances en que encuentren mejor tu
                            barca y sus atributos y dejarás en claro lo que ofreces sin tener ninguna sorpresa al
                            momento del alquiler.
                        </p>
                        <p class="color-gray-dark">
                            Ingresa todos los campos obligatorios (*) y presiona el botón
                            siguiente para que la sección se marque como terminada.
                        </p>
                        <button class="btn bnt-transparent d-flex align-items-center mt-5">
                            <i class="fa-solid fa-life-ring me-2"></i>
                            <strong class="color-gray">
                                ¿Necesitas Ayuda?
                            </strong>
                        </button>

                        <hr class="mt-3 mb-2">

                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-message color-gray-dark me-2"></i>
                                    <span class="color-blue"> Chat online</span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-phone color-gray-dark me-2"></i>
                                    <span class="color-blue"> Por Teléfono: </span>
                                    <span class="color-gray-dark"> +34 966 655 433 </span>
                                </button>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-transparent f-xl-8">
                                    <i class="fa-solid fa-envelope color-gray-dark me-2"></i>
                                    <span class="color-blue"> E-mail: support@MBM.es </span>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- </div> -->

        <!-- Fin de descripción -->

        <script>
            $('body').on('click', '.btn-ellipsis-script', function() {
                let id = $(this).data('id')
                let url = window.location.pathname
                window.location.href = url + '?id=' + id

            })

            $(document).ready(function() {
                if (screen.width < 1 < 603) {
                    $('#screen-computer').removeClass('col-xl-8')
                    $('#screen-computer').addClass('col-xl-10')
                }
            })

            $('body').on('click', '#button-reserva-home', function() {
                $('#home_reserva').addClass('d-none')
                $('#equipamiento-admin').removeClass('d-none')
            })

            $('body').on('click', '.nueva-reserva', function() {
                $('#dashboard-admin').addClass('d-none')
                $('#equipamiento-admin').removeClass('d-none')
            })


            $('body').on('click', '#next-equipamiento', function() {
                $('#equipamiento-admin').addClass('d-none')
                $('#seguro-admin').removeClass('d-none')
            })

            $('body').on('click', '#btn-next-seguro', function() {
                $('#seguro-admin').addClass('d-none')
                $('#precio-de-barco').removeClass('d-none')
            })

            $('body').on('click', '#btn-next-precios', function() {
                $('#precio-de-barco').addClass('d-none')
                $('#reserva-barco').removeClass('d-none')
            })

            $('body').on('click', '#btn-next-reserva', function() {
                $('#reserva-barco').addClass('d-none')
                $('#descripcion-barco-admin').removeClass('d-none')
            })

            $('body').on('click', '#next-resume-reserva-admin', function() {
                $('#descripcion-barco-admin').addClass('d-none')
                $('#resume-reserva-admin').removeClass('d-none')
            })
        </script>

        <!-- Fin links adelante -->

        <!-- Inicio links atrás -->

        <script>
            $(document).ready(function() {
                if (screen.width < 1 < 603) {
                    $('#screen-computer').removeClass('col-xl-8')
                    $('#screen-computer').addClass('col-xl-10')
                }
            })

            $('body').on('click', '#atras-equipamiento', function() {
                $('#equipamiento-admin').addClass('d-none')
                $('#dashboard-admin').removeClass('d-none')
            })


            $('body').on('click', '#atras-seguro', function() {
                $('#seguro-admin').addClass('d-none')
                $('#equipamiento-admin').removeClass('d-none')
            })

            $('body').on('click', '#atras-precio', function() {
                $('#precio-de-barco').addClass('d-none')
                $('#seguro-admin').removeClass('d-none')
            })

            $('body').on('click', '#atras-reserva', function() {
                $('#reserva-barco').addClass('d-none')
                $('#precio-de-barco').removeClass('d-none')
            })

            $('body').on('click', '#atras-descripcion', function() {
                $('#reserva-barco').removeClass('d-none')
                $('#descripcion-barco-admin').addClass('d-none')
            })

            $('body').on('click', '#atras-resume', function() {
                $('#descripcion-barco-admin').removeClass('d-none')
                $('#resume-reserva-admin').addClass('d-none')
            })
        </script>

        <!-- Fin links atrás -->

    <?php
    }

    function imagen($id)
    {
        global $wpdb;
        global $current_user, $user_login;
        $registros2 = $wpdb->get_results("SELECT * FROM `imagenes` where id=" . $id);
        return "." . $registros2[0]->imagen1;
    }

    if (!function_exists('twentytwentytwo_support')) :

        function twentytwentytwo_support()
        {

            // Add support for block styles.
            add_theme_support('wp-block-styles');

            // Enqueue editor styles.
            add_editor_style('style.css');
        }

    endif;

    add_action('after_setup_theme', 'twentytwentytwo_support');

    if (!function_exists('twentytwentytwo_styles')) :

        /**
         * Enqueue styles.
         *
         * @since Twenty Twenty-Two 1.0
         *
         * @return void
         */
        function twentytwentytwo_styles()
        {
            // Register theme stylesheet.
            $theme_version = wp_get_theme()->get('Version');

            $version_string = is_string($theme_version) ? $theme_version : false;
            wp_register_style(
                'twentytwentytwo-style',
                get_template_directory_uri() . '/style.css',
                array(),
                $version_string
            );

            // Enqueue theme stylesheet.
            wp_enqueue_style('twentytwentytwo-style');
        }

    endif;

    add_action('wp_enqueue_scripts', 'twentytwentytwo_styles');

    // Add block patterns
    require get_template_directory() . '/inc/block-patterns.php';


    add_shortcode('plugin_create_boat', 'plugin_create_b');

    function plugin_create_b()
    {
        global $wpdb;
        global $current_user, $user_login;
        //$ID = $current_user->ID;
        ob_start();


        if (isset($_POST['nombre'])) {

            $data = array(
                'nombre' => $_REQUEST['nombre'],
                'pasajero' => $_REQUEST['pasajero'],
                'valor' => $_REQUEST['valor'],
                'matricula' => $_REQUEST['matricula'],
                'bluetooth' => $_REQUEST['bluetooth'],
                'nevera' => $_REQUEST['nevera'],
                'solarium' => $_REQUEST['solarium'],
                'largo' => $_REQUEST['largo'],
                'descripcion' => $_REQUEST['descripcion'],
                'requiere' => $_REQUEST['requiere'],
                'estado' => 1
            );

            if (!empty($_FILES['principal']['name'])) {
                $archivo = subir_archivo('principal', 'vote', null);
                $data['principal'] = $archivo;
            }
            if (!empty($_FILES['imagen1']['name'])) {
                $archivo = subir_archivo('imagen1', 'vote', null);
                $data['imagen1'] = $archivo;
            }
            if (!empty($_FILES['imagen2']['name'])) {
                $archivo = subir_archivo('imagen2', 'vote', null);
                $data['imagen2'] = $archivo;
            }

            if (!empty($_FILES['imagen3']['name'])) {
                $archivo = subir_archivo('imagen3', 'vote', null);
                $data['imagen3'] = $archivo;
            }
            if (!empty($_REQUEST['id_vote'])) {
                $wpdb->update('vote', $data, array('id' => $_REQUEST['id_vote']));
                $id = $_REQUEST['id_vote'];
            } else {
                $wpdb->insert('vote', $data);
                $id = $wpdb->insert_id;
            }

            if (isset($_POST['horario'])) {
                if (!empty($_POST['horario'])) {
                    for ($i = 0; $i < count($_POST['horario']); $i++) {
                        $data = array(
                            'id_vote' => $id,
                            'horario' => $_POST['horario'][$i],
                            'hora_inicio' => $_POST['inicio'][$i] . ":" . $_POST['inicio_minutos'][$i] . ":00",
                            'hora_final' => $_POST['final'][$i] . ":" . $_POST['fin_minutos'][$i] . ":00"
                        );
                        if (!empty($_POST['id'][$i])) {
                            $wpdb->update('vote_detalle', $data, array('id' => $_POST['id'][$i]));
                        } else {
                            $wpdb->insert('vote_detalle', $data);
                        }
                    }
                }
            }
            if (isset($_POST['horario_valor'])) {
                if (!empty($_POST['horario_valor'])) {
                    for ($i = 0; $i < count($_POST['horario_valor']); $i++) {
                        $data = array(
                            'id_vote' => $id,
                            'horario' => $_POST['horario_valor'][$i],
                            'horas' => $_POST['horas_valor'][$i],
                            'valor' => $_POST['valor'][$i]
                        );
                        if (!empty($_POST['id_valor'][$i])) {
                            $wpdb->update('vote_valores', $data, array('id' => $_POST['id_valor'][$i]));
                        } else {
                            $wpdb->insert('vote_valores', $data);
                        }
                    }
                }
            }
        }


        if (isset($_REQUEST['r'])) {
            $data = array('estado' => 0);
            $wpdb->update('vote', $data, array('id' => $_REQUEST['r']));
        }

        $registros = $wpdb->get_results("SELECT count(*) contar FROM vote ");

        if (!isset($registros[0]->contar)) {



            $wpdb->get_results("CREATE TABLE `vote` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `nombre` varchar(255) DEFAULT NULL,
                            `pasajero` varchar(255) DEFAULT NULL,
                            `valor` varchar(255) DEFAULT NULL,
                            `matricula` varchar(255) DEFAULT NULL,
                            `bluetooth` varchar(255) DEFAULT NULL,
                            `nevera` varchar(255) DEFAULT NULL,
                            `solarium` varchar(255) DEFAULT NULL,
                            `largo` varchar(255) DEFAULT NULL,
                            `descripcion` varchar(255) DEFAULT NULL,
                            `requiere` varchar(255) DEFAULT NULL,
                            `principal` varchar(255) DEFAULT NULL,
							`imagen1` varchar(255) DEFAULT NULL,
							`imagen2` varchar(255) DEFAULT NULL,
							`imagen3` varchar(255) DEFAULT NULL,
                            `estado` varchar(2) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ");

            $wpdb->get_results("CREATE TABLE `vote_detalle` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `id_vote` int(11) DEFAULT NULL,
                            `horario` int(11) DEFAULT NULL,
                            `hora_inicio` time DEFAULT NULL,
                            `hora_final` time DEFAULT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ");

            $wpdb->get_results("CREATE TABLE `vote_valores` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `id_vote` int(11) DEFAULT NULL,
                            `horario` int(11) DEFAULT NULL,
                            `horas` int(11) DEFAULT NULL,
                            `valor` varchar(50) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ");
        }

        $registros = $wpdb->get_results("SELECT * FROM `vote` where estado=1 ");
    ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" type="button" id="crearvote">Crear</button>
                </div>
            </div>
            <hr>
            <div id="creacion" style="display: none">
                <form method="POST" action="" enctype="multipart/form-data" id="form_create">
                    <input type="hidden" id="id_vote" name="id_vote">
                    <div class="row">
                        <div class="col-12">
                            <h1>Vote</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Pasajero </label>
                                <input type="text" class="form-control" name="pasajero" id="pasajero">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Valor adicional</label>
                                <input type="text" class="form-control" name="valor" id="valor">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Matricula </label>
                                <input type="text" class="form-control" name="matricula" id="matricula">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Bluetooth</label>
                                <select class="form-control" name="bluetooth" id="bluetooth">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nevera </label>
                                <select class="form-control" name="nevera" id="nevera">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Solarium</label>
                                <select class="form-control" name="solarium" id="solarium">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Requiere </label>
                                <select class="form-control" name="requiere" id="requiere">
                                    <option value="Sin Titulacion">Sin Titulacion</option>
                                    <option value="Titulin">Titulin</option>
                                    <option value="PNB">PNB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Largo </label>
                                <input type="text" class="form-control" name="largo" id="largo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="principal" id="principal">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen1" id="imagen1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen2" id="imagen2">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen3" id="imagen3">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Horarios</label>
                                <button class="btn btn-success nuevo_horario" type="button">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="agregar_horarios">
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Valores</label>
                                <button class="btn btn-success nuevo_valor" type="button">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="agregar_valor">
                    </div>




                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="submit" id="atras">Atras</button>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
            <div id="listado">
                <table class="table table-border table-hover">
                    <thead>
                        <th>nombre</th>
                        <th>pasajero</th>
                        <th>valor</th>
                        <th>matricula</th>
                        <th>bluetooth</th>
                        <th>nevera</th>
                        <th>descripcion</th>
                        <th>Principal</th>
                        <th>Imagen 1</th>
                        <th>Imagen 2</th>
                        <th>Imagen 3</th>
                        <th>Acción</th>
                    </thead>
                    <?php
                    foreach ($registros as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value->nombre ?></td>
                            <td><?php echo $value->pasajero ?></td>
                            <td><?php echo $value->valor ?></td>
                            <td><?php echo $value->matricula ?></td>
                            <td><?php echo $value->bluetooth ?></td>
                            <td><?php echo $value->nevera ?></td>
                            <td><?php echo $value->descripcion ?></td>
                            <td><?php if (!empty($value->principal)) { ?><img src=".<?php echo $value->principal ?>" width="150px"><?php } ?></td>
                            <td><?php if (!empty($value->imagen1)) { ?><img src=".<?php echo $value->imagen1 ?>" width="150px"><?php } ?></td>
                            <td><?php if (!empty($value->imagen2)) { ?><img src=".<?php echo $value->imagen2 ?>" width="150px"><?php } ?></td>
                            <td><?php if (!empty($value->imagen3)) { ?><img src=".<?php echo $value->imagen3 ?>" width="150px"><?php } ?></td>
                            <td>

                                <?php
                                $registros2 = $wpdb->get_results("SELECT * FROM `vote_detalle` where id_vote=" . $value->id);
                                $registros3 = $wpdb->get_results("SELECT * FROM `vote_valores` where id_vote=" . $value->id);
                                ?>

                                <button type="button" class="btn editar_vote" nombre="<?php echo $value->nombre ?>" pasajero="<?php echo $value->pasajero ?>" valor="<?php echo $value->valor ?>" matricula="<?php echo $value->matricula ?>" bluetooth="<?php echo $value->bluetooth ?>" nevera="<?php echo $value->nevera ?>" descripcion="<?php echo $value->descripcion ?>" id="<?php echo $value->id ?>" detalle='<?php echo json_encode($registros2) ?>' valores='<?php echo json_encode($registros3) ?>'>Editar</button>
                                <button type="button" class="btn eliminar_vote" id="<?php echo $value->id ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            </div>
        </div>




        <script>
            function pintar_valor(id = '', horario = '', horas = '', valor = '') {
                var html = `<div class="row">
                    <div class="col-2">
                        <div class="form-group">
							<label>Horario</label>
							<input type="hidden" name="id_valor[]" value="${id}">
							<select name="horario_valor[]" class="form-control">
								<option value="1" ${horario==1?'selected':''} >Mañana</option>
								<option value="2" ${horario==2?'selected':''}>Tarde</option>
								<option value="3" ${horario==3?'selected':''}>Noche</option>
								<option value="4" ${horario==4?'selected':''}>Dia</option>
							</select>
                        </div>
                    </div>
					<div class="col-2">
                        <div class="form-group">
							<label>Horas</label>
							<input type="text" class="form-control" name="horas_valor[]" value="${horas}">
                        </div>
                    </div>
					<div class="col-2">
                        <div class="form-group">
							<label>Valor</label>
							<input type="text" name='valor[]' class="form-control" value="${valor}">
                        </div>
                    </div>
					<div class="col-2">
                        <div class="form-group">
							<button class="btn btn-danger remover" type="button">Eliminar</button>
                        </div>
                    </div>
                </div>`;
                $('.agregar_valor').append(html);
            }

            function pintar(id = '', horario = '', hora_ini = '', min_ini = '', hora_fin = '', min_fin = '') {
                var html = `<div class="row">
                    <div class="col-2">
                        <div class="form-group">
							<label>Horario</label>
							<input type="hidden" name="id[]" value="${id}">
							<select name="horario[]" class="form-control">
								<option value="1" ${horario==1?'selected':''} >Mañana</option>
								<option value="2" ${horario==2?'selected':''}>Tarde</option>
								<option value="3" ${horario==3?'selected':''}>Noche</option>
								<option value="4" ${horario==4?'selected':''}>Dia</option>
							</select>
                        </div>
                    </div>
					<div class="col-2">
                        <div class="form-group">
							<label>Hora Inicial</label>
							<select name="inicio[]" class="form-control">
								<option value="00" ${hora_ini=='00'?'selected':''} >00</option>
								<option value="01" ${hora_ini=='01'?'selected':''}>01</option>
								<option value="02" ${hora_ini=='02'?'selected':''}>02</option>
								<option value="03" ${hora_ini=='03'?'selected':''}>03</option>
								<option value="04" ${hora_ini=='04'?'selected':''}>04</option>
								<option value="05" ${hora_ini=='05'?'selected':''}>05</option>
								<option value="06" ${hora_ini=='06'?'selected':''}>06</option>
								<option value="07" ${hora_ini=='07'?'selected':''}>07</option>
								<option value="08" ${hora_ini=='08'?'selected':''}>08</option>
								<option value="09" ${hora_ini=='09'?'selected':''}>09</option>
								<option value="10" ${hora_ini=='10'?'selected':''}>10</option>
								<option value="11" ${hora_ini=='11'?'selected':''}>11</option>
								<option value="12" ${hora_ini=='12'?'selected':''}>12</option>
								<option value="13" ${hora_ini=='13'?'selected':''}>13</option>
								<option value="14" ${hora_ini=='14'?'selected':''}>14</option>
								<option value="15" ${hora_ini=='15'?'selected':''}>15</option>
								<option value="16" ${hora_ini=='16'?'selected':''}>16</option>
								<option value="17" ${hora_ini=='17'?'selected':''}>17</option>
								<option value="18" ${hora_ini=='18'?'selected':''}>18</option>
								<option value="19" ${hora_ini=='19'?'selected':''}>19</option>
								<option value="20" ${hora_ini=='20'?'selected':''}>20</option>
								<option value="21" ${hora_ini=='21'?'selected':''}>21</option>
								<option value="22" ${hora_ini=='22'?'selected':''}>22</option>
								<option value="23" ${hora_ini=='23'?'selected':''}>23</option>
							</select>
                        </div>
                    </div>
					<div class="col-2">
                        <div class="form-group">
							<label>Minutos</label>
							<select name="inicio_minutos[]" class="form-control">
								<option value="00" ${min_ini=='00'?'selected':''}>00</option>
								<option value="30" ${min_ini=='30'?'selected':''}>30</option>
							</select>
                        </div>
                    </div>
					
					
					
					
					<div class="col-2">
                        <div class="form-group">
							<label>Hora Final</label>
							<select name="final[]" class="form-control">
								<option value="00" ${hora_fin=='00'?'selected':''}>00</option>
								<option value="01" ${hora_fin=='01'?'selected':''}>01</option>
								<option value="02" ${hora_fin=='02'?'selected':''}>02</option>
								<option value="03" ${hora_fin=='03'?'selected':''}>03</option>
								<option value="04" ${hora_fin=='04'?'selected':''}>04</option>
								<option value="05" ${hora_fin=='05'?'selected':''}>05</option>
								<option value="06" ${hora_fin=='06'?'selected':''}>06</option>
								<option value="07" ${hora_fin=='07'?'selected':''}>07</option>
								<option value="08" ${hora_fin=='08'?'selected':''}>08</option>
								<option value="09" ${hora_fin=='09'?'selected':''}>09</option>
								<option value="10" ${hora_fin=='10'?'selected':''}>10</option>
								<option value="11" ${hora_fin=='11'?'selected':''}>11</option>
								<option value="12" ${hora_fin=='12'?'selected':''}>12</option>
								<option value="13" ${hora_fin=='13'?'selected':''}>13</option>
								<option value="14" ${hora_fin=='14'?'selected':''}>14</option>
								<option value="15" ${hora_fin=='15'?'selected':''}>15</option>
								<option value="16" ${hora_fin=='16'?'selected':''}>16</option>
								<option value="17" ${hora_fin=='17'?'selected':''}>17</option>
								<option value="18" ${hora_fin=='18'?'selected':''}>18</option>
								<option value="19" ${hora_fin=='19'?'selected':''}>19</option>
								<option value="20" ${hora_fin=='20'?'selected':''}>20</option>
								<option value="21" ${hora_fin=='21'?'selected':''}>21</option>
								<option value="22" ${hora_fin=='22'?'selected':''}>22</option>
								<option value="23" ${hora_fin=='23'?'selected':''}>23</option>
							</select>
                        </div>
                    </div>
					<div class="col-2">
                        <div class="form-group">
							<label>Minutos</label>
							<select name="fin_minutos[]" class="form-control">
								<option value="00" ${min_fin=='00'?'selected':''}>00</option>
								<option value="30" ${min_fin=='30'?'selected':''}>30</option>
							</select>
                        </div>
                    </div>
					<div class="col-1">
                        <div class="form-group">
							<button class="btn btn-danger remover" type="button">Eliminar</button>
                        </div>
                    </div>
                </div>`;
                $('.agregar_horarios').append(html);
            }
            $('.nuevo_horario').click(function() {
                pintar();
            });
            $('.nuevo_valor').click(function() {
                pintar_valor();
            });
            $('body').delegate('.remover', 'click', function() {
                $(this).parent().parent().parent().remove();
            })
            $('.eliminar_vote').click(function() {
                if (confirm('¿Desea eliminar el vote?')) {
                    var id = $(this).attr('id');
                    window.location.href = '?r=' + id;
                }
            })

            $('body').on('click', '.circle', function() {
                $(this).addClass('verde')
                $(this).parent().addClass('verde')
            })

            $('.editar_vote').click(function() {
                $('#nombre').val($(this).attr('nombre'));
                $('#pasajero').val($(this).attr('pasajero'));
                $('#matricula').val($(this).attr('matricula'));
                $('#bluetooth').val($(this).attr('bluetooth'));
                $('#nevera').val($(this).attr('nevera'));
                $('#descripcion').val($(this).attr('descripcion'));
                $('#id_vote').val($(this).attr('id'));

                detalle = JSON.parse($(this).attr('detalle'))
                $.each(detalle, function(key, val) {
                    var hora = val.hora_inicio;
                    hora = hora.split(':');

                    var hora2 = val.hora_final;
                    hora2 = hora2.split(':');
                    pintar(val.id, val.horario, hora[0], hora[1], hora2[0], hora2[1])
                });
                ///////////////////////

                valores = JSON.parse($(this).attr('valores'))
                $.each(valores, function(key, val) {
                    pintar_valor(val.id, val.horario, val.horas, val.valor)
                });
                $('#creacion').show('show');
                $('#listado').hide('show');
            });
            $('#crearvote').click(function() {
                $('#creacion').show('show');
                $('#listado').hide('show');
                $('#form_create input').val('');
            });
            $('#atras').click(function() {
                $('#creacion').hide('show');
                $('#listado').show('show');
            });
        </script>
    <?php
        return ob_get_clean();
    }


    add_shortcode('plugin_create_extras', 'plugin_create_e');

    function plugin_create_e()
    {
        global $wpdb;
        global $current_user, $user_login;
        //$ID = $current_user->ID;
        ob_start();


        if (isset($_POST['nombre'])) {

            $data = array(
                'nombre' => $_REQUEST['nombre'],
                'descripcion' => $_REQUEST['descripcion'],
                'tipo' => $_REQUEST['tipo'],
                'estado' => 1
            );

            if (!empty($_FILES['principal']['name'])) {
                $archivo = subir_archivo('principal', 'vote', null);
                $data['principal'] = $archivo;
            }
            if (!empty($_FILES['imagen1']['name'])) {
                $archivo = subir_archivo('imagen1', 'vote', null);
                $data['imagen1'] = $archivo;
            }
            if (!empty($_FILES['imagen2']['name'])) {
                $archivo = subir_archivo('imagen2', 'vote', null);
                $data['imagen2'] = $archivo;
            }

            if (!empty($_FILES['imagen3']['name'])) {
                $archivo = subir_archivo('imagen3', 'vote', null);
                $data['imagen3'] = $archivo;
            }
            if (!empty($_REQUEST['id_vote'])) {
                $wpdb->update('extra', $data, array('id' => $_REQUEST['id_vote']));
                $id = $_REQUEST['id_vote'];
            } else {
                $wpdb->insert('extra', $data);
                $id = $wpdb->insert_id;
            }

            $wpdb->update('extra_detalle', ['estado' => 0], array('id_extra' => $id));
            if (isset($_POST['descripcion_d'])) {
                if (!empty($_POST['descripcion_d'])) {
                    for ($i = 0; $i < count($_POST['descripcion_d']); $i++) {
                        $data = array(
                            'id_extra' => $id,
                            'valor' => $_POST['valor'][$i],
                            'descripcion' => $_POST['descripcion_d'][$i],
                            'estado' => 1
                        );
                        if (!empty($_POST['id'][$i])) {
                            $wpdb->update('extra_detalle', $data, array('id' => $_POST['id'][$i]));
                        } else {
                            $wpdb->insert('extra_detalle', $data);
                        }
                    }
                }
            }
        }


        if (isset($_REQUEST['r'])) {
            $data = array('estado' => 0);
            $wpdb->update('extra', $data, array('id' => $_REQUEST['r']));
        }

        $registros = $wpdb->get_results("SELECT count(*) contar FROM extra ");

        if (!isset($registros[0]->contar)) {



            $datas = $wpdb->get_results("CREATE TABLE `extra` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `nombre` varchar(255) DEFAULT NULL,
							`tipo` varchar(255) DEFAULT NULL,
                            `descripcion` varchar(255) DEFAULT NULL,
                            `principal` varchar(255) DEFAULT NULL,
							`imagen1` varchar(255) DEFAULT NULL,
							`imagen2` varchar(255) DEFAULT NULL,
							`imagen3` varchar(255) DEFAULT NULL,
                            `estado` varchar(2) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ");

            $datas = $wpdb->get_results("CREATE TABLE `extra_detalle` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `id_extra` varchar(255) DEFAULT NULL,
                            `tipo` int(11) DEFAULT NULL,
                            `descripcion` varchar(255) DEFAULT NULL,
                            `valor` varchar(255) DEFAULT NULL,
							`estado` varchar(2) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ");
        }

        $registros = $wpdb->get_results("SELECT * FROM `extra` where estado=1 ");
    ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" type="button" id="crearvote">Crear</button>
                </div>
            </div>
            <hr>
            <div id="creacion" style="display: none">
                <form method="POST" action="" enctype="multipart/form-data" id="form_create">
                    <input type="hidden" id="id_vote" name="id_vote">
                    <div class="row">
                        <div class="col-12">
                            <h1>Extra</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control" name="tipo">
                                    <option value="Extras Predefinidos">Extras Predefinidos</option>
                                    <option value="Comestibles & Cartering">Comestibles & Cartering</option>
                                    <option value="Juguetes Acuáticos">Juguetes Acuáticos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Principal</label>
                                <input type="file" class="form-control" name="principal" id="principal">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen1" id="imagen1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen2" id="imagen2">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen3" id="imagen3">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Detalle</label>
                                <button class="btn btn-success nuevo_horario" type="button">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="agregar_horarios">
                    </div>





                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="submit" id="atras">Atras</button>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
            <div id="listado">
                <table class="table table-border table-hover">
                    <thead>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Principal</th>
                        <th>Imagen 1</th>
                        <th>Imagen 2</th>
                        <th>Imagen 3</th>
                        <th>Acción</th>
                    </thead>
                    <?php
                    foreach ($registros as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value->tipo ?></td>
                            <td><?php echo $value->nombre ?></td>
                            <td><?php echo $value->descripcion ?></td>
                            <td><?php if (!empty($value->principal)) { ?><img src=".<?php echo $value->principal ?>" width="150px"><?php } ?></td>
                            <td><?php if (!empty($value->imagen1)) { ?><img src=".<?php echo $value->imagen1 ?>" width="150px"><?php } ?></td>
                            <td><?php if (!empty($value->imagen2)) { ?><img src=".<?php echo $value->imagen2 ?>" width="150px"><?php } ?></td>
                            <td><?php if (!empty($value->imagen3)) { ?><img src=".<?php echo $value->imagen3 ?>" width="150px"><?php } ?></td>
                            <td>

                                <?php
                                $registros2 = $wpdb->get_results("SELECT * FROM `extra_detalle` where estado=1 and id_extra=" . $value->id);
                                ?>

                                <button type="button" class="btn editar_vote" nombre="<?php echo $value->nombre ?>" tipo="<?php echo $value->tipo ?>" descripcion="<?php echo $value->descripcion ?>" id="<?php echo $value->id ?>" detalle='<?php echo json_encode($registros2) ?>'>Editar</button>
                                <button type="button" class="btn eliminar_vote" id="<?php echo $value->id ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            </div>
        </div>




        <script>
            function pintar(id = '', descripcion_d = '', valor = '') {
                var html = `<div class="row">
                    <div class="col-9">
                        <div class="form-group">
							<label>Descripción</label>
							<input type="hidden" name="id[]" value="${id}">
							<input type="text" name='descripcion_d[]' class="form-control" value="${descripcion_d}">
                        </div>
                    </div>
					
					<div class="col-2">
                        <div class="form-group">
							<label>Valor</label>
							<input type="text" name='valor[]' class="form-control" value="${valor}">
                        </div>
                    </div>
					<div class="col-1">
                        <div class="form-group">
							<button class="btn btn-danger remover" type="button">Eliminar</button>
                        </div>
                    </div>
                </div>`;
                $('.agregar_horarios').append(html);
            }
            $('.nuevo_horario').click(function() {
                pintar();
            })
            $('body').delegate('.remover', 'click', function() {
                $(this).parent().parent().parent().remove();
            })
            $('.eliminar_vote').click(function() {
                if (confirm('¿Desea eliminar el vote?')) {
                    var id = $(this).attr('id');
                    window.location.href = '?r=' + id;
                }
            })
            $('.editar_vote').click(function() {
                $('#nombre').val($(this).attr('nombre'));
                $('#tipo').val($(this).attr('tipo'));
                $('#descripcion').val($(this).attr('descripcion'));
                $('#id_vote').val($(this).attr('id'));

                detalle = JSON.parse($(this).attr('detalle'))
                $.each(detalle, function(key, val) {

                    pintar(val.id, val.descripcion, val.valor);
                })
                $('#creacion').show('show');
                $('#listado').hide('show');
            });
            $('#crearvote').click(function() {
                $('#creacion').show('show');
                $('#listado').hide('show');
                $('#form_create input').val('');
            });
            $('#atras').click(function() {
                $('#creacion').hide('show');
                $('#listado').show('show');
            });
        </script>
    <?php
        return ob_get_clean();
    }

    add_shortcode('plugin_create_imagenes', 'plugin_create_i');

    function plugin_create_i()
    {
        global $wpdb;
        global $current_user, $user_login;
        //$ID = $current_user->ID;
        ob_start();


        if (isset($_POST['nombre'])) {

            $data = array(
                'nombre' => $_REQUEST['nombre'],
                'estado' => 1
            );
            if (!empty($_FILES['imagen1']['name'])) {
                $archivo = subir_archivo('imagen1', 'vote', null);
                $data['imagen1'] = $archivo;
            }
            if (!empty($_REQUEST['id_vote'])) {
                $wpdb->update('imagenes', $data, array('id' => $_REQUEST['id_vote']));
                $id = $_REQUEST['id_vote'];
            } else {
                $wpdb->insert('imagenes', $data);
                $id = $wpdb->insert_id;
            }
        }

        $registros = $wpdb->get_results("SELECT count(*) contar FROM imagenes ");

        if (!isset($registros[0]->contar)) {

            $datas = $wpdb->get_results("CREATE TABLE `imagenes` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `nombre` varchar(255) DEFAULT NULL,
							`imagen1` varchar(255) DEFAULT NULL,
							`estado` varchar(2) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ");
        }

        $registros = $wpdb->get_results("SELECT * FROM `imagenes` where estado=1 ");
    ?>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" type="button" id="crearvote">Crear</button>
                </div>
            </div>
            <hr>
            <div id="creacion" style="display: none">
                <form method="POST" action="" enctype="multipart/form-data" id="form_create">
                    <input type="hidden" id="id_vote" name="id_vote">
                    <div class="row">
                        <div class="col-12">
                            <h1>Imagenes</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen1" id="imagen1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="submit" id="atras">Atras</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="listado">
                <table class="table table-border table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Imagen</th>

                        <th>Acción</th>
                    </thead>
                    <?php
                    foreach ($registros as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value->nombre ?></td>
                            <td><?php if (!empty($value->imagen1)) { ?><img src=".<?php echo $value->imagen1 ?>" width="150px"><?php } ?></td>
                            <td>
                                <button type="button" class="btn editar_vote" nombre="<?php echo $value->nombre ?>" id="<?php echo $value->id ?>">Editar</button>

                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            </div>
        </div>
        <script>
            $('.editar_vote').click(function() {
                $('#nombre').val($(this).attr('nombre'));
                $('#id_vote').val($(this).attr('id'));
                $('#creacion').show('show');
                $('#listado').hide('show');
            });
            $('#crearvote').click(function() {
                $('#creacion').show('show');
                $('#listado').hide('show');
                $('#form_create input').val('');
            });
            $('#atras').click(function() {
                $('#creacion').hide('show');
                $('#listado').show('show');
            });
        </script>
    <?php
        return ob_get_clean();
    }
    ?>

</div>

<!-- Inicio Alpine -->

<script>
    function app_alpine() {
        return {
            // pantalla: 'ReservaUsuarioPagos',
            pantalla: 'reserva_usuario',
            loading: false,
            // base_url: 'https://192.168.0.18:443',
            base_url: 'https://192.168.5.112:443',
            headers: {
                Authorization: `Bearer 6TQzUrFu82YrwiCwG4ZUcb1IEmLpOZN0wbDwJ284`
            },

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

                //-------------------------------------------------------------------------
                // User reserva
                //-------------------------------------------------------------------------

                nombre: '',
                apellido: '',
                direccion: '',
                telefono: '',
                email: '',
                num_dni: '',
                image: '',
                alert_email: '',
                alert_whatsapp: '',
                tipo_doc: '',
                tutilado: '',

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

            },
            cant_personas: 0,
            precio_horas_extra: 0,
            auxiliares: {
                tipo_reserva: ''
            },
        }
    }
</script>

<style>
    .spinner {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: black;
        top: 0;
        left: 0;
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 999999;
        opacity: .75;
    }

    .caja_img {
        width: 25%;
        height: 100px;
        background-color: #fff;
        text-align: center;


    }
</style>