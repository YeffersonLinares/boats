<?php

/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */

// function incluirphp($atts){
// include 'prueba.php';
// include 'home.php';
// }

add_shortcode('reservas_admin', 'plugin_reservas_admin');

function plugin_reservas_admin()
{
    global $wpdb;
    global $current_user, $user_login;
    //$ID = $current_user->ID;
    ob_start();


?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>


    <!-- Inicio de home admin -->


    <div id="app">


        <div class="px-md-5" id="home_reserva">
            <div class="d-flex justify-content-center align-items-center">
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <i
                            class="fa-solid fa-angle-left color-dark-blue fa-lg me-3"></i> <span>Agosto 2022</span>
                    </button>
                </div> -->
                <div>
                    <?php

                    if (!empty($_POST['submit-date-input'])) {
                        $date = $_POST['submit-date-input'];
                    } else {
                        $date = date('Y-m-d');
                    }
                    ?>
                    <!-- <h4 class="text-center mt-3 color-dark-blue"> <b> Septiembre 2022 </b> </h4> -->
                    <h4 class="text-center mt-3 color-dark-blue"> <b> <?php echo $date ?> </b> </h4>
                </div>
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <span>Octubre 2022</span> <i
                            class="fa-solid fa-angle-right color-dark-blue fa-lg ms-3"></i> </button>
                </div> -->
            </div>
            <hr>

            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-blue-reserva me-5" id="button-reserva-home"><span class="">Nueva Reserva</span> <i class="fa-solid fa-circle-arrow-right"></i> </button>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-lg-7 col-xl-7">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-transparent">
                            <i class="fa-solid fa-square color-blue"></i>
                            <span class="color-dark-extras">Fecha Reservada</span>
                        </button>
                        <button class="btn btn-transparent color-light-blue">
                            <i class="fa-solid fa-square"></i>
                            <span class="color-dark-extras">Fecha Bloqueada Parcialmente</span></button>
                        <button class="btn btn-transparent color-dark-red">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            <span>No hay suficiente personal para cubrir todos los turnos del día</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-lg-1 col-xl-2"></div>
                <div class="col-12 col-lg-4 col-xl-3">
                    <div class="d-flex justify-content-between">
                        <form method="POST" action="">
                            <input type="date" class="select-gray form-control me-3" name="submit-date-input" id="submit-date-input" />
                            <button type="submit" class="d-none" id="submit-date-button"></button>
                        </form>
                        <script>
                            $('body').on('change', '#submit-date-input', function() {
                                $('#submit-date-button').trigger('click')
                            })
                        </script>
                        <!-- <select class="select-gray form-select me-3" name="" id="">
                            <option value="">Ver todos los barcos</option>
                        </select> -->
                        <button class="btn bg-dark-blue color-white w-3rem me-3">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <button class="btn bg-dark-blue color-white w-3rem">
                            <i class="fa-solid fa-calendar-days"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php
            $horas_array = [
                '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00',
                '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
                '20:00', '20:30', '21:00', '21:30'
            ];
            ?>
            <div class="contaner-fluid mt-4">
                <div class="table-responsive mb-5">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td></td>
                                <?php foreach ($horas_array as $value) : ?>
                                    <td><?php echo $value; ?></td>
                                <?php endforeach; ?>
                                <td>Cierre</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            # header("Location: https://www.google.com");
                            $sql = "SELECT vote.id, vote.nombre, reserva.hora_inicio, reserva.hora_fin, reserva.id as reserva_id 
				FROM vote, reserva
				WHERE vote.id = reserva.id_vote AND
				reserva.fecha = '$date' AND
				estado = 1";
                            $botes = $wpdb->get_results($sql);

                            $data[] = array();

                            foreach ($botes as $key => $value) :
                                $data[$value->id]['nombre'] = $value->nombre;
                                $data[$value->id]['reserva_id'] = $value->reserva_id;
                                foreach ($horas_array as $index => $h) :
                                    $first = 0;
                                    if ($key >= 1 && $first = 0) {
                                        $first = 1;
                                        $horas_array[$index - 1]    = 2;
                                    }



                                    if (!isset($data[$value->id]['horas'][$h]) ||  $data[$value->id]['horas'][$h] == 0) :
                                        if ($value->hora_inicio <= $h and $value->hora_fin >= $h) :
                                            $data[$value->id]['horas'][$h] = 1;
                                            $data[$value->id]['horas'][$horas_array[$index - 1]] = 1;
                                            if (
                                                $value->hora_inicio == $horas_array[$index - 1] . ":00" &&
                                                $value->hora_inicio != '09:00:00'
                                            ) :
                                                $data[$value->id]['horas'][$horas_array[$index - 2]] = 2;
                                            endif;
                                            if ($h . ':00' == $value->hora_fin &&  $value->hora_fin != '21:30:00') :
                                                # echo "$value->hora_fin ==>  " . $h  . "<br>";
                                                $data[$value->id]['horas'][$h] = 3;
                                            endif;
                                        else :
                                            $data[$value->id]['horas'][$h] = 0;
                                        endif;
                                    endif;
                                endforeach;
                            endforeach;
                            # print_y($data);
                            foreach ($data as $key => $value) :
                                if ($key != 0) :
                            ?>
                                    <tr class="recorrido-bote">
                                        <td><?php echo $value['nombre'] ?> </td>
                                        <?php foreach ($value['horas'] as $index => $hour) :  ?>
                                            <td class="<?php if ($hour == 1 || $hour == 2 || $hour == 3) echo 'recorrido-bote-td'; ?>">
                                                <?php if ($hour == 3) : ?>
                                                    <button class="btn btn-transparent color-dark-blue button-ellipsis btn-ellipsis-script" data-id="<?php echo $value['reserva_id'] ?>">
                                                        <i class="fa-solid fa-ellipsis button-ellipsis"></i></button>
                                                    <button class="btn btn-transparent color-dark-blue"><i class="fa-solid fa-flag-checkered"></i></button>
                                                <?php elseif ($hour == 1 || $hour  == 2) : ?>
                                                    <button class="btn btn-transparent color-dark-blue">
                                                        <?php if ($hour == 1) : ?>
                                                            <i class="fa-solid fa-sailboat"></i>
                                                        <?php elseif ($hour == 2) : ?>
                                                            <i class="fa-solid fa-hand-sparkles"></i>
                                                        <?php endif; ?>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <!--     <td class="recorrido-bote-td"><button class="btn btn-transparent color-dark-blue"><i class="fa-solid fa-sailboat"></i></button></td>
                                <td class="recorrido-bote-td"></td>
                                <td class="recorrido-bote-td"></td>
                                <td class="recorrido-bote-td"></td>
                                <td class="recorrido-bote-td"></td>
                                <td class="recorrido-bote-td"></td>
                                <td class="recorrido-bote-td">
                                    <button class="btn btn-transparent color-dark-blue button-ellipsis"><i class="fa-solid fa-ellipsis button-ellipsis"></i></button>
                                    <button class="btn btn-transparent color-dark-blue"><i class="fa-solid fa-flag-checkered"></i></button>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td> -->
                                        <td>
                                            <button class="btn btn-transparent color-dark-blue"> <i class="fa-solid fa-power-off"></i> </button>
                                        </td>
                                    </tr>
                            <?php endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Fin de home admin -->

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
            <?php
            // it go here
            $reserva_data = [];
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *,  reserva.id as reserva_id
							FROM reserva, vote
							WHERE reserva.id = vote.id AND
							reserva.id = $id LIMIT 1";
                $reserva_data = $wpdb->get_results($sql);
                # $wpdb->getResults($sql);
                $reserva_data = $reserva_data[0];
                # print_y($reserva_data);

            ?>
                <script>
                    $("#home_reserva").addClass('d-none')
                    $("#resume-reserva-admin").removeClass('d-none')
                </script>
            <?php
            }

            # echo $reserva_data;
            # print_y($reserva_data?->id_user_reserva);
            ?>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-transparent color-extras-gray"> <i class="fa-solid fa-angle-left color-dark-blue fa-lg me-3"></i> <span>Jueves
                            02/09/2022</span>
                    </button>
                </div>
                <div>
                    <h5 class="text-center mt-3 color-dark-blue"> <b> Barco <?php
                                                                            $value = $reserva_data?->nombre . ' ' . $reserva_data?->hora_inicio . ' a ' . $reserva_data?->hora_fin;
                                                                            echo $value;

                                                                            ?> </b> </h5>
                </div>
                <div></div>
                <!-- <div>
                    <button class="btn btn-transparent color-extras-gray"> <span>Octubre 2022</span> <i
                            class="fa-solid fa-angle-right color-dark-blue fa-lg ms-3"></i> </button>
                </div> -->
            </div>
            <hr>

            <div class="w-100 my-3">
                <span class="color-dark-blue"> Septiembre 2022 </span>
                <span class="color-dark-blue"> | </span>
                <span class="color-dark-blue"> <?php echo $reserva_data?->fecha ?> </span>
                <span class="color-dark-extras"> | </span>
                <span class="color-dark-extras">Barco <?php echo $reserva_data?->nombre ?> </span>
                <strong class="color-dark-extras">
                    <?php echo $reserva_data?->hora_inicio ?> a
                    <?php echo $reserva_data?->hora_fin ?>
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
    </div>

    <!-- Fin de descripción -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Inicio links adelante -->

    <script>
        // Scripts for admin

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

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        span,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        b,
        strong,
        label,
        button {
            font-family: 'Poppins', sans-serif !important;
            /* font-size: .9rem; */
        }

        .d-flex>h2 {
            font-weight: bold;
        }

        :root {
            --blue-primary: #31A6FB
        }

        .flex-lg-nyg-column-reverse .col-lg-3 nav {
            width: 100%;
        }

        .bg-blue {
            background-color: var(--blue-primary);
        }

        .color-blue {
            color: var(--blue-primary);
        }

        .right-18rem {
            right: 1.8rem;
        }

        .select-gray,
        .select-gray>option {
            color: #B5B5B5;
        }

        .select-gray {
            border-color: #B5B5B5;
        }

        .color-white {
            color: #FFF !important;
        }

        .fs-13 {
            font-size: 1.3rem;
        }

        .color-dark-blue {
            color: #1D6CAF !important;
        }

        .bg-dark-blue {
            background-color: #1D6CAF;
        }

        .w-3rem {
            width: 3.9rem;
        }

        .color-dark-red {
            color: #FF0000 !important;
        }

        .f-12r {
            font-size: 1.2rem;
        }

        .btn-blue-reserva {
            background-color: #31A6FB;
            color: white;
            width: 13rem;
            padding: .4rem !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 2rem !important;
            padding-right: 2rem !important;
            border-radius: 8px;
        }

        .btns-hour button {
            background-color: #FFF;
            border-radius: 8px;
            width: 7rem;
            border: 1px solid #B5B5B5;
            margin-right: 1rem;
            padding: .3rem;
            margin-bottom: 1rem;
        }

        .btns-hour button:disabled {
            background-color: #F5F5F5;
            /* border: 1px solid #B5B5B5; */
            color: #FFF;
        }

        .btn-extras button {
            background-color: #F5F5F5;
            border: none;
            color: #464646;
            padding: .2rem;
            width: 8rem;
            margin-left: .7rem;
            margin-right: .7rem;
            font-size: .8rem;
        }

        .btn-check:focus+.btn,
        .btn:focus {
            box-shadow: none !important;
        }

        .btn-enviar-embarcacion {
            background: #F5F5F5 !important;
            border: 1px solid #B5B5B5 !important;
            padding: .8rem !important;
            width: 8rem !important;
            color: #B5B5B5 !important;
        }

        .btn-next-extra {
            background-color: var(--blue-primary) !important;
            border-color: var(--blue-primary) !important;
            color: white !important;
            padding: .5rem !important;
            width: 10rem !important;
            font-weight: bold !important;
        }

        .f-12 {
            font-size: 1.2rem;
        }

        .color-oranged {
            color: #ffa354;
        }

        .btn {
            padding: 0;
        }

        .img-paypal {
            width: 67px;
            height: 39px;
            border: 1px solid #707070;
            background-color: #FFF;
        }

        .start-35 {
            left: 35%;
        }

        .button-enviar-cupon {
            border: 1px solid #B5B5B5 !important;
            background-color: #F5F5F5 !important;
            width: 6rem !important;
        }

        .size-card {
            width: 19rem;
            height: 28rem;
            border-radius: 14px;
        }

        .color-blue {
            color: var(--blue-primary) !important;
        }

        .btn-embarcacion {
            background-color: #31a6fb !important;
            color: white !important;
            width: 18rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-resume {
            background-color: #31a6fb !important;
            color: white !important;
            width: 11rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-instuctivo {
            background-color: #E20909 !important;
            color: white !important;
            width: 19rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-instuctivo-pdf {
            background-color: #E20909 !important;
            color: white !important;
            width: 18rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-navegar {
            background-color: #27C313 !important;
            color: white !important;
            width: 15rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .size-img-grid {
            width: 19rem !important;
            height: 14rem !important;
            border-top-left-radius: 14px !important;
            border-top-right-radius: 14px !important;
        }

        .btn-add-provision {
            background-color: #F5F5F5 !important;
            color: #464646 !important;
            border-color: #B5B5B5 !important;
            border-radius: 8px !important;
            font-size: .9rem !important;
            font-weight: bold !important;
            width: 10.7rem;
            height: 2.3rem;
        }

        .color-extras-gray {
            color: #B5B5B5;
        }

        .color-dark-extras {
            color: #464646;
        }

        .btn-minus {
            /* border-color: #B5B5B5 !important; */
            background-color: transparent !important;
            color: #b5b5b5 !important;
            /* border-radius: 50rem; */
        }

        .bg-red {
            background-color: #ff0000;
        }

        .color-red {
            color: #ff0000;
        }

        .author {
            /* font-weight: bold; */
            color: #B5B5B5;
        }

        .top-25 {
            top: 25%;
        }

        .w-75 {
            width: 75%;
        }

        .h-6r {
            height: 6rem !important;
        }

        hr {
            margin: 0;
        }

        .bg-gray {
            background-color: #f5f5f5 !important;
        }

        .bg-container-gray {
            background-color: #fafafa;
        }

        .color-gray {
            color: #464646 !important;
        }

        .icon-gray {
            color: #b5b5b5 !important;
        }

        .btn-direction {
            background-color: #aebec9 !important;
            color: #464646 !important;
            opacity: .6 !important;
            height: 2.5rem !important;
            width: 2rem !important;
            border-radius: 0px !important;
        }

        .btn-blue {
            background-color: #31A6FB !important;
            color: #FFF !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-weight: bold !important;
            font-size: .9rem !important;
            width: 9rem !important;
            margin-right: 1rem !important;
        }

        .f-8 {
            font-size: .8rem !important;
        }

        .f-7 {
            font-size: .7rem !important;
        }

        .f-9 {
            font-size: .9rem !important;
        }

        .top-20 {
            top: 20% !important;
        }

        .container .w-card {
            border: none !important;
            /* box-shadow: 6px 6px 6px 6px #d3c5c5 !important; */
            -webkit-box-shadow: 1px 0px 12px 0.2px rgba(246, 245, 250, 1) !important;
            -moz-box-shadow: 1px 0px 12px 0.2px rgba(246, 245, 250, 1) !important;
            box-shadow: 1px 0px 12px 0.2px rgba(246, 245, 250, 1) !important;
            transition: -webkit-box-shadow .5s !important;
            transition: -moz-box-shadow .5s !important;
            transition: box-shadow .5s !important;
        }


        .w-card:hover {
            -webkit-box-shadow: 1px 0px 12px 0.2px rgba(194, 190, 209, 1) !important;
            -moz-box-shadow: 1px 0px 12px 0.2px rgba(194, 190, 209, 1) !important;
            box-shadow: 1px 0px 12px 0.2px rgba(194, 190, 209, 1) !important;
            /* width: 300px; */
        }

        .timeline {
            list-style-type: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .li {
            transition: all 200ms ease-in !important;
        }

        .circle {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            color: #FFF !important;
        }

        .text-transparent {
            color: transparent;
        }

        .timestamp {
            margin-bottom: 20px !important;
            padding: 0px 40px !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            font-weight: 100 !important;
        }

        .status {
            width: 10rem;
            padding: 0px 40px;
            display: flex;
            justify-content: center;
            border-top: 2px solid var(--blue-primary);
            /* border-top: 2px solid #D6DCE0; */
            position: relative;
            transition: all 200ms ease-in;
            background-color: var(--blue-primary);
            /* background-color: #D6DCE0; */
        }

        .status h4 {
            font-weight: 600;
        }

        .status .circle {
            content: "";
            width: 25px;
            height: 25px;
            background-color: white;
            border-radius: 25px;
            /* border: 1px solid #ddd; */
            border: 1px solid var(--blue-primary);
            position: absolute;
            top: -15px;
            left: 42%;
            transition: all 200ms ease-in;
        }



        .cont-table-det {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #F5F5F5;
            border-radius: 8px;
            opacity: 1;
        }

        .cont-table-det label {
            padding: 0.2rem 1rem;
        }

        .cont-table-det img {
            width: 100%;
        }

        .checkboxFechas {
            margin: 1rem 0.5rem;
        }

        .container-btn {
            border: 1px solid #e5e5e5;
            padding: 0.2rem 6rem;
            border-radius: 8px;
            margin: 1rem 1.5rem;
            cursor: pointer;
            background-color: #f5f5f5;
            color: #e5e5e5;
        }

        .size-img-resume {
            height: 25rem;
            width: 42rem;
        }

        .border-right-dotted {
            border-right: dotted;
            border-width: 2px;
            border-color: lightgray;
        }

        .selected-btn {
            background-color: #A9DAE3;
            border: 1px solid #A9DAE3 !important;
            color: #FFF;
        }

        .msn-alert-css {
            width: 80%;
            background-color: #FCF8E3;
            color: #464646;
            padding: 1rem;
            opacity: 1;
        }

        .bg-yellow-light {
            background-color: #FCF8E3;
        }

        .color-yellow {
            color: #febe2f;
        }

        .fs-xl {
            font-size: 3rem;
        }

        .checkboxNotificaciones {
            position: relative;
            margin-top: 6px;
            margin-right: 0.5rem;
        }

        .cont-table-det {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #F5F5F5;
            border-radius: 8px;
            opacity: 1;
        }

        .cont-table-det label {
            padding: 0.2rem 1rem;
        }

        .cont-table-det img {
            width: 100%;
        }

        .cont-table-det .label-txt {
            color: #464646;
            font-size: 1.2rem;
            margin-top: -0.2rem;
            font-weight: 600;
            position: absolute;
            right: 0px;
        }

        .cont-table-det .label-txt-blu {
            color: #31a6fb;
            font-size: 1.5rem;
            margin-top: -0.5rem;
            font-weight: 600;
            position: absolute;
            right: 0px;
        }

        li:first-child .circle {
            left: 0%;
        }

        li:last-child .circle {
            left: 93%;
        }

        i {
            font-size: .9rem;
        }

        .li .status {
            border-top: 4.5px solid var(--blue-primary);
        }

        /* .li.complete .status {
    border-top: 3px solid var(--blue-primary);
  } */
        .li.complete .status .circle {
            background-color: var(--blue-primary);
            border: none;
            transition: all 200ms ease-in;
        }

        .li .status .circle {
            background-color: var(--blue-primary);
            border: none;
            transition: all 200ms ease-in;
        }

        .li.complete .status h4 {
            color: #ddd;
        }

        #btn-atras {
            width: 100px;
            padding: 4px;
            background-color: #F5F5F5;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #DFDFDF;
            position: relative;
            top: -2rem;
            left: 4rem;
        }

        @media (min-device-width: 320px) and (max-device-width: 700px) {
            /* .timeline {
      list-style-type: none;
      display: block;
    }
  
    .li {
      transition: all 200ms ease-in;
      display: flex;
      width: inherit;
    }
  
    .timestamp {
      width: 100px;
    }
  
    .status .circle {
      left: -8%;
      top: 30%;
      transition: all 200ms ease-in;
    } */
        }

        @media(max-width: 420px) {
            .size-img-grid {
                width: 18rem;
            }

            .size-card {
                height: 26rem;
            }
        }

        /* button {
    position: absolute;
    width: 100px;
    min-width: 100px;
    padding: 20px;
    margin: 20px;
    font-family: "Titillium Web", sans serif;
    border: none;
    color: white;
    font-size: 16px;
    text-align: center;
  } */

        #toggleButton {
            position: absolute;
            left: 50px;
            top: 20px;
            background-color: #75C7F6;
        }

        .border-dotted {
            border: dotted;
            border-width: 1px;
        }

        .font-32 {
            font-size: 3.2rem;
        }

        .fa-gray button {
            box-shadow: none !important;
        }

        .fa-gray .btn-minus-plus {
            background-color: #F5F5F5;
            border-radius: 69px;
            padding: .1rem;
            display: flex;
            border-color: #B5B5B5;
            width: 25px;
            height: 25px;
            justify-content: center;
            align-items: center;
        }

        .fa-gray i {
            color: #F5F5F5;
        }

        .fa-gray i::before {
            background-color: #B5B5B5;
            border-radius: 50rem;
            border: .1px solid #B5B5B5;
        }

        .fa-gray svg {
            color: #B5B5B5;
        }

        .btn-asistieron button {
            background-color: #F5F5F5;
            border-color: #B5B5B5;
            border-radius: 6px;
            width: 6rem;
            margin-left: 2rem;
        }

        .btn-plus-white {
            background-color: white !important;
        }

        .color-gray-dark {
            color: #707070;
        }

        .color-light-blue {
            color: #8acdd9;
        }

        .hr-notificacion hr {
            color: #e8e8e8;
            opacity: 1;
            height: 1.7px;
        }

        .color-transparent {
            color: transparent;
        }

        .active-gray button {
            color: #1D6CAF;
        }

        .active-gray strong,
        .active-gray span {
            color: #464646;
        }

        .bg-white {
            background-color: white;
        }

        .bg-gray-light {
            background-color: #B5B5B5;
        }

        .btn-cancelar-reserva {
            background-color: #F5F5F5;
            border: 1px solid #B5B5B5;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .3rem;
        }

        .btn-guardar-mod {
            background-color: #1D6CAF;
            border: 1px solid #1D6CAF;
            border-radius: 8px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-7rem {
            left: .7rem;
        }

        .right-5rem {
            right: .5rem;
        }

        .bg-blue-light {
            background-color: #8ACDD9;
        }

        .left-25rem {
            left: 2.5rem;
        }

        .fa-gray span {
            font-size: .9rem;
        }

        .add-provision input::placeholder,
        .add-provision input {
            color: #B5B5B5 !important;
            font-size: .9rem;
        }

        .btn-add-provision {
            background-color: #F5F5F5;
            border: 1px solid #B5B5B5;
            padding: .4rem;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            border-radius: 8px;
            color: #464646;
        }

        .btn-downloads-reserva {
            background-color: #B5B5B5;
            border: 1px solid #B5B5B5;
            border-radius: 8px;
            color: white;
            font-weight: bold;
        }


        .border-gray-semi-dark {
            border: 1px solid #B5B5B5;
        }

        .border-8px {
            border-radius: 8px;
        }

        .color-light-gray {
            color: #F5F5F5;
        }

        .p-15rem {
            padding: .15rem;
        }

        .btn-atras {
            background-color: #f5f5f5;
            border: 1px solid #B5B5B5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            padding-top: .5rem;
            padding-bottom: .5rem;
            padding-left: 1rem;
            padding-right: 1rem;
            color: #464646;
        }

        .btn-atras>svg,
        .tbn-atras>i {
            width: 14px;
            height: 14px;
            padding: .15rem;
            border-radius: 50rem;
            font-size: .9rem;
            margin-right: 1rem;
            background-color: #B5B5B5;
            color: #F5F5F5;
        }

        .btn-atras>b,
        .btn-atras>strong {
            font-size: .8rem;
        }

        .btn-descartar {
            background-color: #F5F5F5;
            border: 1px solid #B5B5B5;
            border-radius: 8px;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: .25rem;
            padding-bottom: .25rem;
        }

        .btn-descartar strong,
        .btn-descartar b {
            margin-right: .8rem;
            color: #464646;
        }

        .btn-descartar svg,
        .btn-descartar i {
            color: #FF0000;
        }

        .ps-xxl-5 {
            padding-left: 3rem;
        }

        .btn-siguiente-general {
            background-color: var(--blue-primary) !important;
            border: 1px solid var(--blue-primary);
            display: flex;
            align-items: center;
            padding-left: 1.3rem;
            padding-right: 1.3rem;
            padding-top: .4rem;
            padding-bottom: .4rem;
            border-radius: 8px;
        }

        .btn-siguiente-general span {
            margin-right: .7rem;
            color: white;
            font-size: .9rem;
            font-weight: bold;
        }


        .btn-siguiente-general svg,
        .btn-siguiente-general i {
            width: 14px;
            height: 14px;
            padding: .15rem;
            background: white;
            color: var(--blue-primary);
            border-radius: 50rem;
            margin-top: .1rem;
        }

        .btn-new-precio {
            background-color: #1D6CAF;
            color: #FFF;
            border: 1px solid #1D6CAF;
            font-size: .9rem;
            border-radius: 8px;
        }

        .border-light-gray {
            border: 1px solid #dee2e6 !important;
            border-top: none !important;
        }

        .rounded-top-pill {
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }

        .tab-reserva {
            background-color: #F5F5F5 !important;
            color: #464646;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #FFF !important;
        }

        .w-xxl-80 {
            width: 80%;
        }

        .position-medida {
            bottom: 1.7rem;
            right: 3.5rem;
        }

        @media(max-width: 1602px) {
            .flex-1602-column {
                flex-direction: column;
            }

            .ps-xxl-5 {
                padding-left: 0% !important;
            }

            .w-xxl-80 {
                width: 100%;
            }

            .position-medida {
                bottom: 1.7rem;
                right: .5rem;
            }


        }

        @media(max-width: 1388px) and (min-width: 992px) {
            .f-xl-8 {
                font-size: .8rem;
            }
        }

        @media(min-width: 1602px) {
            .me-1602-2 {
                margin-right: 1rem;
            }
        }

        .recorrido-bote .recorrido-bote-td {
            border-bottom-width: 5px;
            border-bottom-color: #31A6FB;
        }

        .button-ellipsis {
            background-color: #E8E8E8;
            padding: .05rem .3rem;
            color: black !important;
        }

        .circle {
            cursor: pointer;
        }
    </style>


<?php
}

///////////////////////////////////////////////
///////////Imagenes///////////////////
///////////////////////////////////////////////


function imagen($id)
{
    global $wpdb;
    global $current_user, $user_login;
    $registros2 = $wpdb->get_results("SELECT * FROM `imagenes` where id=" . $id);
    return "." . $registros2[0]->imagen1;
}

///////////////////////////////////////////////
///////////Usuario///////////////////
///////////////////////////////////////////////
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
                    <input type="date" name="fecha_asignada" id="fecha_asignada">
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





                <button class="btn btn-blue seguir_registro">Seleccionar <i class="fas fa-arrow-alt-circle-right"></i></button>

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
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="f-9">Apellido/s*:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="f-9">Dirección/Ciudad*:</label>
                                <input type="text" name="nombre" id="ciudad" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label class="f-9">Telefono*:</label>
                                <input type="text" name="telefono" id="telefono" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label class="f-9">Email*:</label>
                                <input type="text" name="email" id="email" class="form-control">
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
                                <input type="file" name="archivo" id="archivo" class="form-control d-none" accept="image/*">
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
                        <b>26 septiembre 2021</b>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 border-right-dotted d-flex flex-column">
                        <span>EMAIL:</span>
                        <b>CORREO@CORREO</b>
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
                        por ejemplo: "Asunto: Reserva 20/JUNIO/2022" N° de la reserva". Tu pedido no se
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
            horafinal_viaje = $(this).attr('id', 'until-here');
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
            let fecha_reserva = ''
            send_form.id_vote = id_vote
            send_form.fecha_inicio_viaje = fecha_inicio_viaje
            send_form.horaInicio_viaje = horaInicio_viaje
            send_form.horafinal_viaje = horafinal_viaje
            send_form.cant_adultos = cant_adultos
            send_form.cant_tres_doce = cant_tres_doce
            send_form.cant_uno_tres = cant_uno_tres
            send_form.cant_bebes = cant_bebes

            $.post('', {
                form: send_form
            }).done(function(msg) {
                msg = msg.split('///////////////////////////');
                console.log('message ==> ', msg[1]);
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
}



add_shortcode('estilos_reserva', 'plugin_reservas_estilo');

function plugin_reservas_estilo()
{
?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        span,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        b,
        strong,
        label,
        body {
            /* font-family: 'Open Sans', sans-serif; */
            font-weight: 300;
        }

        *,
        *:after,
        *:before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .fa-calendar-alt {
            color: #FFF;
            background-color: #31a6fb;
            margin-left: 1rem;
            border-radius: 18px;
            padding: 8px;
        }

        .center-li-icon {
            position: relative;
            right: 1.4rem;
            bottom: .7rem;
            color: #FFF;
            cursor: pointer;
        }

        .center-li-icon-barco {
            position: relative;
            right: 1.65rem;
            bottom: .7rem;
            color: #FFF;
            cursor: pointer;
        }

        .center-li-icon-horario {
            position: relative;
            right: 1.8rem;
            bottom: .7rem;
            color: #FFF;
            cursor: pointer;
        }

        .center-li-icon-fecha {
            position: relative;
            right: 1.55rem;
            bottom: .7rem;
            color: #FFF;
            cursor: pointer;
        }

        .center-li-icon-responsable {
            position: relative;
            right: 2.86rem;
            bottom: .69rem;
            color: #FFF;
            cursor: pointer;
        }

        .center-li-icon-asistencia {
            position: relative;
            right: 2.4rem;
            bottom: .69rem;
            color: #FFF;
            cursor: pointer;
        }

        .center-li-icon-pago {
            position: relative;
            right: 1.5rem;
            bottom: .69rem;
            color: #FFF;
            cursor: pointer;
        }

        .center-li-icon-end {
            position: relative;
            right: 1.25rem;
            bottom: .69rem;
            color: #FFF;
            cursor: pointer;
        }

        .timeline {
            width: 100%;
            height: 100px;
            /*max-width: 800px; */
            margin: 0 auto;
            display: flex;
            justify-content: center;
        }

        .timeline .events {
            position: relative;
            background-color: #606060;
            height: 3px;
            width: 100%;
            border-radius: 4px;
            margin: 5em 0;
        }

        .timeline .events ol {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .timeline .events ul {
            list-style: none;
        }

        .timeline .events ul li {
            display: inline-block;
            width: 9.65%;
            margin: 0;
            padding: 0;
        }

        .timeline .events ul li a {
            font-family: 'Arapey', sans-serif;
            font-size: .7em;
            color: #606060;
            text-decoration: none;
            position: relative;
            top: -32px;
        }

        .timeline .events ul li a:after {
            content: '';
            position: absolute;
            bottom: -25px;
            left: 50%;
            right: auto;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            border: 3px solid #606060;
            background-color: #fff;
            transition: 0.3s ease;
            transform: translateX(-50%);
        }

        .timeline .events ul li a:hover::after {
            background-color: #194693;
            border-color: #194693;
        }

        .timeline .events ul li a.selected:after {
            background-color: #194693;
            border-color: #194693;
            padding: .6rem;
        }

        .timeline .events ul li a:after {
            padding: .6rem;
        }

        .events-content {
            width: 100%;
            height: 100px;
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            justify-content: left;
        }

        .events-content li {
            display: none;
            list-style: none;
        }

        .events-content li.selected {
            display: initial;
        }

        .events-content li h2 {
            font-family: 'Frank Ruhl Libre', serif;
            font-weight: 500;
            color: #919191;
            font-size: 2.5em;
        }



        button {
            font-family: 'Poppins', sans-serif !important;
        }

        .btn-toggle-nyg {
            background: #1D6CAF;
            color: white !important;
            padding: .5rem 1rem .5rem 1rem;
            box-shadow: none;
            size-img-grid
        }

        @media(max-width: 992px) {
            .flex-lg-nyg-column-reverse {
                flex-direction: column-reverse;
            }

            .span-time-line {
                display: none;
            }

            .center-li-icon {
                right: .4rem;
            }

            .center-li-icon-barco {
                right: .5rem;
            }

            .center-li-icon-horario {
                right: .4rem;
            }

            .center-li-icon-fecha {
                right: .4rem;
            }

            .center-li-icon-responsable {
                right: .5rem;
            }

            .center-li-icon-asistencia {
                right: .5rem;
            }

            .center-li-icon-pago {
                right: .4rem;
            }

            .center-li-icon-end {
                right: .4rem;
            }
        }

        :root {
            --blue-primary: #31A6FB
        }

        .resume_button_icon .fa-clock {
            color: #FFF;
            background-color: #31a6fb;
            margin-left: 1rem;
            border-radius: 18px;
            padding: 8px;
        }

        .resume_button_icon .fa-swimmer {
            color: #FFF;
            background-color: #31a6fb;
            margin-left: 1rem;
            border-radius: 18px;
            padding: 8px;
        }

        .ml-5 {
            margin-left: 3.2rem
        }

        .bg-blue {
            background-color: var(--blue-primary);
        }

        .mt-7 {
            margin-top: 7rem;
        }

        .color-white {
            color: #FFF !important;
        }

        .fs-13 {
            font-size: 1.3rem;
        }

        .color-dark-blue {
            color: #1D6CAF !important;
        }

        .color-dark-red {
            color: #FF0000 !important;
        }

        .btns-hour button {
            background-color: #FFF;
            border-radius: 8px;
            width: 7rem;
            border: 1px solid #B5B5B5;
            margin-right: 1rem;
            padding: .3rem;
            margin-bottom: 1rem;
        }

        .btns-hour button:disabled {
            background-color: #F5F5F5;
            /* border: 1px solid #B5B5B5; */
            color: #FFF;
        }

        .btn-extras button {
            background-color: #F5F5F5;
            border: none;
            color: #464646;
            padding: .2rem;
            width: 8rem;
            margin-left: .7rem;
            margin-right: .7rem;
            font-size: .8rem;
        }

        .btn-enviar-embarcacion {
            background: #F5F5F5 !important;
            border: 1px solid #B5B5B5 !important;
            padding: .8rem !important;
            width: 8rem !important;
            color: #B5B5B5 !important;
        }

        .btn-next-extra {
            background-color: var(--blue-primary) !important;
            border-color: var(--blue-primary) !important;
            color: white !important;
            padding: .5rem !important;
            width: 10rem !important;
            font-weight: bold !important;
        }

        .f-12 {
            font-size: 1.2rem;
        }

        .color-oranged {
            color: #ffa354;
        }

        .btn {
            padding: 0;
        }

        .img-paypal {
            width: 67px;
            height: 39px;
            border: 1px solid #707070;
            background-color: #FFF;
        }

        .start-35 {
            left: 35%;
        }

        @media (max-width: 768px) {
            .start-35 {
                left: 12%;
            }

            .container .w-card {
                width: auto !important;
            }
        }

        .button-enviar-cupon {
            border: 1px solid #B5B5B5 !important;
            background-color: #F5F5F5 !important;
            width: 6rem !important;
        }

        .size-card {
            width: 19rem;
            height: 28rem;
            border-radius: 14px;
            margin-bottom: 1.5rem;
        }

        .color-blue {
            color: var(--blue-primary) !important;
        }

        .btn-embarcacion {
            background-color: #31a6fb !important;
            color: white !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-resume {
            background-color: #31a6fb !important;
            color: white !important;
            width: 11rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-instuctivo {
            background-color: #E20909 !important;
            color: white !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-instuctivo-pdf {
            background-color: #E20909 !important;
            color: white !important;
            width: 18rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .btn-navegar {
            background-color: #27C313 !important;
            color: white !important;
            width: 15rem !important;
            height: 2.2rem !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-size: .9rem !important;
        }

        .size-img-grid {
            /*width: 19rem !important;*/
            height: 14rem !important;
            border-top-left-radius: 14px !important;
            border-top-right-radius: 14px !important;
        }

        .btn-add-provision {
            background-color: #F5F5F5 !important;
            color: #464646 !important;
            border-color: #B5B5B5 !important;
            border-radius: 8px !important;
            font-size: .9rem !important;
            font-weight: bold !important;
            width: 10.7rem;
            height: 2.3rem;
        }

        .color-extras-gray {
            color: #B5B5B5;
        }

        .color-dark-extras {
            color: #464646;
        }

        .btn-minus {
            /* border-color: #B5B5B5 !important; */
            background-color: transparent !important;
            color: #b5b5b5 !important;
            /* border-radius: 50rem; */
        }

        .author {
            /* font-weight: bold; */
            color: #B5B5B5;
        }

        .top-25 {
            top: 25%;
        }

        .w-75 {
            width: 75%;
        }

        .h-6r {
            height: 6rem !important;
        }

        hr {
            margin: 0;
        }

        .bg-gray {
            background-color: #f5f5f5 !important;
        }

        .color-gray {
            color: #464646 !important;
        }

        .icon-gray {
            color: #b5b5b5 !important;
        }

        .btn-direction {
            background-color: #aebec9 !important;
            color: #464646 !important;
            opacity: .6 !important;
            height: 2.5rem !important;
            width: 2rem !important;
            border-radius: 0px !important;
        }

        .btn-blue {
            background-color: #31A6FB !important;
            color: #FFF !important;
            border-radius: 8px !important;
            padding: .3rem !important;
            font-weight: bold !important;
            font-size: .9rem !important;
            width: 9rem !important;
            margin-right: 1rem !important;
        }

        .f-8 {
            font-size: .8rem !important;
        }

        .f-7 {
            font-size: .7rem !important;
        }

        .f-9 {
            font-size: .9rem !important;
        }

        .top-20 {
            top: 20% !important;
        }

        .container .w-card {
            width: 30rem;
            border: none !important;
            /* box-shadow: 6px 6px 6px 6px #d3c5c5 !important; */
            -webkit-box-shadow: 1px 0px 12px 0.2px rgba(246, 245, 250, 1) !important;
            -moz-box-shadow: 1px 0px 12px 0.2px rgba(246, 245, 250, 1) !important;
            box-shadow: 1px 0px 12px 0.2px rgba(246, 245, 250, 1) !important;
            transition: -webkit-box-shadow .5s !important;
            transition: -moz-box-shadow .5s !important;
            transition: box-shadow .5s !important;
        }


        .w-card:hover {
            -webkit-box-shadow: 1px 0px 12px 0.2px rgba(194, 190, 209, 1) !important;
            -moz-box-shadow: 1px 0px 12px 0.2px rgba(194, 190, 209, 1) !important;
            box-shadow: 1px 0px 12px 0.2px rgba(194, 190, 209, 1) !important;
            /* width: 300px; */
        }

        .timeline {
            list-style-type: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .li {
            transition: all 200ms ease-in !important;
        }

        .circle {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            color: #FFF !important;
        }

        .text-transparent {
            color: transparent;
        }

        .timestamp {
            margin-bottom: 20px !important;
            padding: 0px 40px !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            font-weight: 100 !important;
        }

        .status {
            width: 10rem;
            padding: 0px 40px;
            display: flex;
            justify-content: center;
            border-top: 2px solid var(--blue-primary);
            /* border-top: 2px solid #D6DCE0; */
            position: relative;
            transition: all 200ms ease-in;
            background-color: var(--blue-primary);
            /* background-color: #D6DCE0; */
        }

        .status h4 {
            font-weight: 600;
        }

        .status .circle {
            content: "";
            width: 25px;
            height: 25px;
            background-color: white;
            border-radius: 25px;
            /* border: 1px solid #ddd; */
            border: 1px solid var(--blue-primary);
            position: absolute;
            top: -15px;
            left: 42%;
            transition: all 200ms ease-in;
        }

        .ico-circle,
        .ico-circle-vacio {
            color: #FFF;
            background-color: #31a6fb;
            margin-left: 1rem;
            border-radius: 18px;
            padding: 8px;
        }

        .nombre_vote {
            font-size: 12px;
        }

        .ico-circle-vacio {
            color: #FFF;
            background-color: #FFF;
        }

        .cont-table-det {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #F5F5F5;
            border-radius: 8px;
            opacity: 1;
        }

        .cont-table-det label {
            padding: 0.2rem 1rem;
        }

        .cont-table-det img {
            width: 100%;
        }

        .checkboxFechas {
            margin: 1rem 0.5rem;
        }

        .container-btn {
            border: 1px solid #e5e5e5;
            padding: 0.2rem 1rem;
            border-radius: 8px;
            margin: .5rem .5rem;
            cursor: pointer;
            background-color: #f5f5f5;
            color: #e5e5e5;
        }

        .size-img-resume {
            height: 25rem;
            width: 42rem;
        }

        .border-right-dotted {
            border-right: dotted;
            border-width: 2px;
            border-color: lightgray;
        }

        .selected-btn {
            background-color: #A9DAE3;
            border: 1px solid #A9DAE3 !important;
            color: #FFF;
        }

        .msn-alert-css {
            width: 80%;
            background-color: #FCF8E3;
            color: #464646;
            padding: 1rem;
            opacity: 1;
        }

        .bg-yellow-light {
            background-color: #FCF8E3;
        }

        .checkboxNotificaciones {
            position: relative;
            margin-top: 6px;
            margin-right: 0.5rem;
        }

        .cont-table-det {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #F5F5F5;
            border-radius: 8px;
            opacity: 1;
        }

        .cont-table-det label {
            padding: 0.2rem 1rem;
        }

        .cont-table-det img {
            width: 100%;
        }

        .cont-table-det .label-txt {
            color: #464646;
            font-size: 1.2rem;
            margin-top: -0.2rem;
            font-weight: 600;
            position: absolute;
            right: 0px;
        }

        .cont-table-det .label-txt-blu {
            color: #31a6fb;
            right: 0px;
        }

        li:first-child .circle {
            left: 0%;
        }

        li:last-child .circle {
            left: 93%;
        }

        i {
            font-size: .9rem;
        }

        .li .status {
            border-top: 4.5px solid var(--blue-primary);
        }

        /* .li.complete .status {
    border-top: 3px solid var(--blue-primary);
  } */
        .li.complete .status .circle {
            background-color: var(--blue-primary);
            border: none;
            transition: all 200ms ease-in;
        }

        .li .status .circle {
            background-color: var(--blue-primary);
            border: none;
            transition: all 200ms ease-in;
        }

        .li.complete .status h4 {
            color: #ddd;
        }

        #btn-atras {
            width: 100px;
            padding: 4px;
            background-color: #F5F5F5;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #DFDFDF;
        }

        @media (min-device-width: 320px) and (max-device-width: 700px) {
            /* .timeline {
      list-style-type: none;
      display: block;
    }
  
    .li {
      transition: all 200ms ease-in;
      display: flex;
      width: inherit;
    }
  
    .timestamp {
      width: 100px;
    }
  
    .status .circle {
      left: -8%;
      top: 30%;
      transition: all 200ms ease-in;
    } */
        }

        @media(max-width: 420px) {
            .size-img-grid {
                width: 19rem;
            }

            .size-card {
                height: 26rem;
            }
        }

        /* button {
    position: absolute;
    width: 100px;
    min-width: 100px;
    padding: 20px;
    margin: 20px;
    font-family: "Titillium Web", sans serif;
    border: none;
    color: white;
    font-size: 16px;
    text-align: center;
  } */

        #toggleButton {
            position: absolute;
            left: 50px;
            top: 20px;
            background-color: #75C7F6;
        }

        .border-dotted {
            border: dotted;
            border-width: 1px;
        }

        .font-32 {
            font-size: 3.2rem;
        }

        .fa-gray button {
            box-shadow: none !important;
        }

        .fa-gray i {
            color: #F5F5F5;
        }

        .fa-gray i::before {
            background-color: #B5B5B5;
            border-radius: 50rem;
            border: .1px solid #B5B5B5;
        }

        .btn-asistieron button {
            background-color: #F5F5F5;
            border-color: #B5B5B5;
            border-radius: 6px;
            width: 6rem;
            margin-left: 2rem;
        }

        .color-gray-dark {
            color: #707070;
        }

        .resume_button_icon .fa-user {
            color: #FFF;
            background-color: #31a6fb;
            margin-left: 1rem;
            border-radius: 18px;
            padding: 8px;
        }

        .resume_button_icon .fa-users {
            color: #FFF;
            background-color: #31a6fb;
            margin-left: 1rem;
            border-radius: 18px;
            padding: 8px;
        }


        .circle {
            cursor: pointer;
        }
    </style>

<?php
}




















if (!function_exists('twentytwentytwo_support')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @since Twenty Twenty-Two 1.0
     *
     * @return void
     */
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


function subir_archivo($archivo, $carpeta, $retornarName = null)
{
    $tumb = '';
    $target_path = '';
    if (!empty($_FILES[$archivo]['name'])) {
        $extencion = substr($_FILES[$archivo]['name'], -4, 4);

        $tumb = limpiarCaracteresString(date('Y_m_d H_i_s') . "_" . $_FILES[$archivo]['name']);

        $tumb = str_replace(' ', '_', $tumb);
        if (strpos($carpeta, 'uploads'))
            $targetPath = $carpeta;
        else
            $targetPath = "./uploads/" . $carpeta;
        if (!file_exists($targetPath)) {
            mkdir($targetPath, 0777, true);
        }
        $target_path = $targetPath . '/' . $tumb;
        if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $target_path)) {
        }
    }
    if ($retornarName != null) {
        return $tumb;
    } else
        return $target_path;
}

function sinTildes($cadena)
{
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function limpiarCaracteresString($string)
{
    $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã?", "Ã„", "Ã‹");
    $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
    $string = htmlentities($string);
    $string = preg_replace('/\&(.)[^;]*;/', '\\1', $string);
    $string = str_replace(' ', '-', $string);
    $string = str_replace($no_permitidas, $permitidas, $string);
    return sinTildes($string);
}

function print_y($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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





///////////////////////////////////////////////
//////////////////////////////////////////////
////////EXTRAS////////////////////////////////
//////////////////////////////////////////////

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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

///////////////////////////////////////////////
//////////////////////////////////////////////
////////IMAGENES////////////////////////////////
//////////////////////////////////////////////

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
