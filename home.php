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