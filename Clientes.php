<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous">

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="//unpkg.com/alpinejs" defer></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.39/vue.cjs.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<style>
    .card_cliente {
        color: #707070;
        font-size: 0.9rem;
        margin: 0;
        padding: 0;
        font-weight: 200; 
    }

    .card_cliente-title {
        font-weight: bold;
        font-size: 1rem;
        color: #707070;
    }

    .text-blue {
        color: #1d6caf;
        font-weight: bold;
    }

    .card_cliente-button {
        color: white;
        background: #1d6caf;
        padding: .5rem;
        border: 0px;
    }

    .admin-navs-tabs,
    .nav-link {
        color: #707070;
        font-weight: bold;
    }

    .nav-tabs {
        --bs-nav-tabs-border-width: 1.8px;
        --bs-nav-tabs-border-color: #dee2e6;
        --bs-nav-tabs-border-radius: 0.375rem;
        --bs-nav-tabs-link-hover-border-color: #e9ecef #e9ecef #dee2e6;
        --bs-nav-tabs-link-active-color: #495057;
        --bs-nav-tabs-link-active-bg: #fff;
        --bs-nav-tabs-link-active-border-color: #b7b7b7 #b7b7b7 #fff;
        border-bottom: var(--bs-nav-tabs-border-width) solid #b7b7b7;
    }
    .width200px{
        width: 200px;
    }
</style>
<?php

function maskEmail($email)
{
    $mask = explode("@", $email);
    $email = $mask[0] . '@...';
    return $email;
}
$reserva = $_SERVER["REQUEST_URI"];
if ($reserva == '/boats/reservas_admin/') {
    require 'Reserva_mes.html';
}


add_shortcode('registrocliente', 'admin_clientes');

function admin_clientes()
{
    global $wpdb;
    global $current_user, $user_login;

    //join reserva on user_reserva.id=reserva.id_user_reserva
    $data = $wpdb->get_results("SELECT * FROM `user_reserva` ");
    // print_y($data);
?>
    <div class="container-fluid" >
        <div class="row mt-5">
            <nav class="admin-navs-tabs">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="width200px nav-link active" id="nav-inicio-tab" data-bs-toggle="tab" data-bs-target="#nav-inicio" type="button" role="tab" aria-controls="nav-inicio" aria-selected="true">Inicio</button>
                    <button class="width200px nav-link" id="nav-reservas-tab" data-bs-toggle="tab" data-bs-target="#nav-reservas" type="button" role="tab" aria-controls="nav-reservas" aria-selected="false">Reservas</button>
                    <button class="width200px nav-link" id="nav-barcos-tab" data-bs-toggle="tab" data-bs-target="#nav-barcos" type="button" role="tab" aria-controls="nav-barcos" aria-selected="false">Barcos</button>
                    <button class="width200px nav-link" id="nav-extras-tab" data-bs-toggle="tab" data-bs-target="#nav-extras" type="button" role="tab" aria-controls="nav-extras" aria-selected="false">Extras</button>
                    <button class="width200px nav-link" id="nav-clientes-tab" data-bs-toggle="tab" data-bs-target="#nav-clientes" type="button" role="tab" aria-controls="nav-clientes" aria-selected="false">Clientes</button> 
                    <button class="width200px nav-link" id="nav-empresa-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa" type="button" role="tab" aria-controls="nav-empresa" aria-selected="false">Empresa</button> 
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-empresa-tab">
                    <?php include_once "Empresa.php"; ?>
                </div>
                <div class="tab-pane fade show active" id="nav-inicio" role="tabpanel" aria-labelledby="nav-inicio-tab">
                    <?php include_once "Inicio.php"; ?>
                </div>
                <div class="tab-pane fade" id="nav-reservas" role="tabpanel" aria-labelledby="nav-reservas-tab">
                <?php include_once "Reserva_mes.html"; ?>
                </div>
                <div class="tab-pane fade" id="nav-barcos" role="tabpanel" aria-labelledby="nav-barcos-tab">Barcos</div>
                <div class="tab-pane fade" id="nav-extras" role="tabpanel" aria-labelledby="nav-extras-tab">Extras</div>
                <div class="tab-pane fade" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">

                    <div class="row">
                        <div class="col-12 text-center mb-2">
                            <b class="text-blue">Clientes</b>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <span><i class="fa-solid fa-filter"></i> <?php echo count($data) ?> Clientes Ingresados</h5>
                                <hr>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        foreach ($data as $key => $value) {
                        ?>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card card_cliente">
                                    <img src=".<?php echo $value->image ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card_cliente-title"><?php echo $value->nombre . ' ' . $value->apellido ?></h5>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span> <i class="fa-solid fa-graduation-cap"></i> <?php if (!empty($value->titulado)) { ?> <?php echo $value->titulado ?> <?php } else echo 'Sin titulación' ?></span>
                                            <span><?php if (!empty($value->telefono)) { ?> <?php echo $value->telefono ?> <?php } ?><i class="fa-solid fa-phone"></i></span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span><i class="fa-solid fa-id-card"></i><?php if (!empty($value->num_dni)) { ?> <?php echo $value->num_dni ?> <?php } ?></span>
                                            <span><?php if (!empty($value->email)) { ?> <?php echo maskEmail($value->email) ?> <?php } ?><i class="fa-solid fa-envelope"></i></span>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-9 d-flex flex-column">
                                                <span class="mb-1">Reservas Abiertas: <b class="text-blue">0</b></span>
                                                <span class="mb-1">Reservas Confirmadas: <b class="text-blue">0</b></span>
                                                <span class="mb-1">Reservas Canceladas: <b class="text-blue">0</b></span>
                                                <span class="mb-1">Pagos Pendientes: <b class="text-blue">0</b></span>
                                            </div>
                                            <div class="col-md-3 d-flex flex-column align-items-lg-end">
                                                <span class="mb-1">Rating</span>
                                                <span class="mb-1 text-blue">2/5 <i class="fa-solid fa-star"></i></span>
                                                <span class="mb-1">Recorrido</span>
                                                <span class="mb-1 text-blue">2.031 Kms</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="card_cliente-button"> A deuda: 350 $</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div> 
            </div>
        </div>

    </div>
<?php
}
