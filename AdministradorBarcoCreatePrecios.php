<div>
    <div class="bg-gray pt-3 pb-4 px-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 border-bottom pb-4 min-heigth-19rem-card">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                            <strong class="fs-5 color-dark-extras">Antelaciones</strong>
                            <div class="blue-claro-inicio">
                                <i class="fa-solid fa-calendar fa-2x"></i>
                            </div>
                        </div>
                        <p class="card-text mb-5 color-dark-extras">Con cuanta antelación mínima se puede
                            hacer una reserva
                        </p>
                        <div class="d-flex">
                            <input class="form-control me-4" type="text">
                            <select class="form-select color-dark-extras" name="" id="">
                                <option value="">Horas</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                            <strong class="fs-5 color-dark-extras">Fianza</strong>
                            <div class="blue-claro-inicio">
                                <i class="fa-solid fa-money-bill fa-2x"></i>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="fianza_embarcacion">
                            <label class="form-check-label color-dark-extras" for="fianza_embarcacion">
                                Solicitar fianza para alquilar la embarcación
                            </label>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex mb-2" style="width: 80%;">
                                <input class="form-control me-4" type="text">
                                <select class="form-select color-dark-extras" name="" id="" style="width: 30%;">
                                    <option value="">€</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <p class="color-dark-extras">Tipo de pago aceptado para la fianza</p>
                            </div>
                            <div>
                                <select class="form-select color-dark-extras" name="" id="">
                                    <option value="">Seleccione los medios aceptados</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                            <strong class="fs-5 color-dark-extras">Reserva Flex</strong>
                            <div class="blue-claro-inicio">
                                <i class="fa-solid fa-right-left fa-2x"></i>
                            </div>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label color-dark-extras" for="flexCheckDefault">
                                Ofrecer seguro de reserva flexible
                            </label>
                        </div>
                        <div class="d-flex mb-2" style="width: 80%;">
                            <input class="form-control me-4" type="text">
                            <select class="form-select color-dark-extras" name="" id="" style="width: 30%;">
                                <option value="">€</option>
                            </select>
                        </div>
                        <p class="color-dark-extras">¿Con cuántos días se puede realizar una
                            Cancelación/Modificación?</p>
                        <div class="d-flex align-items-center mb-3">
                            <span class="me-3 color-dark-extras" for="">Hasta</span>
                            <select class="form-select me-3 color-dark-extras" name="" id="" style="width: 20%;">
                                <option value="">1</option>
                            </select>
                            <span class="color-dark-extras" for="">Día/s</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <strong class="color-gray-dark">Temporadas</strong>
            <p class="mt-3">Añade temporadas de acuerdo a las fechas que darás el servicio. Y después añade
                tus precios
                por
                el rango de fecha. (Al menos crear una temporada)</p>

            <div class="row mt-3 color-dark-extras">
                <div class="col-md-3">
                    <label class="form-label" for="">Nombre de la temporada*</label>
                    <input class="form-control" type="text" placeholder="Temporada Regular">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="">Del*</label>
                    <input class="form-control" type="text" placeholder="Temporada Regular">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="">Al*</label>
                    <input class="form-control" type="text" placeholder="Temporada Regular">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div>
                        <button class="btn-tareas">Crea una temporada</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="d-flex">
            <strong class="color-dark-blue me-2">[ Nombre de la temporada 01 ]</strong>
            <strong class="color-dark-extras me-2">del</strong>
            <strong class="color-dark-blue me-2">25/08/2023</strong>
            <strong class="color-dark-extras me-2">al</strong>
            <strong class="color-dark-blue me-2">05/09/2023</strong>
        </div>
        <div class="d-flex justify-content-end border-bottom pb-3 my-3 flex-column flex-md-row">
            <div class="d-flex justify-content-between mb-3">
                <div class="me-2">
                    <button class="btn-gray-icon-red">Eliminar temporada <i class="fa-solid fa-trash-can"></i></button>
                </div>
                <div class="me-2">
                    <button class="btn-gray-icon">Editar Fecha <i class="fa-solid fa-calendar-days"></i></button>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="me-2">
                    <button class="btn-gray-icon">Duplicar temporada <i class="fa-solid fa-copy"></i></button>
                </div>
                <div>
                    <button class="btn-tareas-blue">Guardar Temporada</button>
                </div>
            </div>
            <!-- <div class="d-flex justify-content-between mb-3 flex-column flex-sm-row">
                        </div>
                        <div class="d-flex justify-content-between mb-3 flex-column flex-sm-row">
                        </div> -->
        </div>
        <div class="row border-bottom mb-4">
            <div class="col-xxl-6">
                <div class="d-flex flex-column mt-4">
                    <div class="d-flex flex-column">
                        <strong>Horarios de Reserva</strong>
                        <span class="mt-4">Por la Mañana</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Salida (mínimo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Salida (máximo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Llegada (mínimo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Llegada (máximo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                </div>
                <div class="d-flex flex-column mt-4">
                    <div class="d-flex flex-column">
                        <strong>Por la tarde</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Salida (mínimo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Salida (máximo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Llegada (mínimo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Llegada (máximo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                </div>
                <div class="d-flex flex-column mt-4">
                    <div class="d-flex flex-column">
                        <strong>Amanecer & Atardecer</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Salida (mínimo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Salida (máximo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Horario de Llegada (mínimo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Horario de Llegada (máximo)</span>
                        <input class="form-control" type="text" style="width: 20%;" value="09:00">
                    </div>
                </div>
            </div>
            <div class="col-xxl-6">
                <div class="d-flex flex-column mt-4">
                    <div class="d-flex flex-column">
                        <strong>Precio Horarios Básicos</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Dos horas</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Medio día:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Día completo:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column mt-4">
                    <div class="d-flex flex-column">
                        <strong>Precio Horarios Especiales</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>30 minutos por la mañana:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>30 minutos por la tarde:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>30 minutos por la noche:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Amanecer:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pt-4 pb-2">
                        <span>Atardecer:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column mt-4">
                    <div class="d-flex flex-column">
                        <strong>Precio Múltiples días</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Dos días:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Tres días:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Cinco días:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                        <span>Una semana:</span>
                        <div class="d-flex justify-content-end">
                            <input class="form-control me-3" type="text" value="09:00" style="width: 50%;">
                            <select class="form-select" name="" id="" style="width: 50%;">
                                <option value="">€</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray p-5">
        <div class="d-flex justify-content-center">
            <div class="p-4 bg-white border-radius shadow-alquiler">
                <div class="d-flex justify-content-between mb-4">
                    <strong class="color-dark-extras">Precios Alquiler de capitán</strong>
                    <div>
                        <i class="fa-solid fa-graduation-cap fa-2x blue-claro-inicio"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 border-end pe-5">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">1H</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id="">
                                        <option value="">€</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">1D</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id=""></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">2H</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id="">
                                        <option value="">€</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">2D</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id=""></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">3H</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id="">
                                        <option value="">€</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">3D</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id=""></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">4H</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id="">
                                        <option value="">€</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">4D</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id=""></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">8H</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id="">
                                        <option value="">€</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2rem">8D</span>
                                    <input class="form-control w-50 me-3" type="text">
                                    <select class="form-select w-50" name="" id=""></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ps-5">
                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="">Amanecer</label>
                                    <div class="d-flex">
                                        <input class="form-control w-50 me-3" type="text">
                                        <select class="form-select w-50" name="" id="">
                                            <option value="">€</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="">Atardecer</label>
                                    <div class="d-flex">
                                        <input class="form-control w-50 me-3" type="text">
                                        <select class="form-select w-50" name="" id="">
                                            <option value="">€</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="">Salida Nocturna</label>
                                    <div class="d-flex">
                                        <input class="form-control w-50 me-3" type="text">
                                        <select class="form-select w-50" name="" id="">
                                            <option value="">€</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>