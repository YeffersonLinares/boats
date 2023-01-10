<div x-data="AdministradorBarcoCreatePromociones()">
    <div class="d-flex flex-column mb-3">
        <div class="bg-gray p-3">
            <span>Promoción en reserva anticipada</span>
            <p class="my-4">Establece un descuento si la reserva se realiza con una antelación máxima
                específica, ejemplo:
                10% de descuento si se reserva con menos de 24 horas de antelación.</p>
            <div class="row pb-3">
                <div class="col-3">
                    <label for=""><b>Periodo de reserva anticipada</b></label>
                    <select class="form-select" x-model="reserva_anticipada.periodo">
                        <option value="1">1 mes de anticipación</option>
                        <option value="2">2 meses de anticipación</option>
                        <option value="3">3 meses de anticipación</option>
                        <option value="4">4 meses de anticipación</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for=""><b>Descuento</b></label>
                    <div class="d-flex">
                        <input class="form-control me-3" type="text" x-model="reserva_anticipada.descuento">
                        <select class="form-select" x-model="reserva_anticipada.tipo_descuento">
                            <option value="%">%</option>
                            <option value="€">€</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <label for=""><b>Duración mínima de la reserva</b></label>
                    <select class="form-select" x-model="reserva_anticipada.duracion_minima">
                        <option value="Siempre">Siempre</option>
                        <option value="1">1 mes</option>
                        <option value="2">2 meses</option>
                    </select>
                </div>
                <div class="col-4 d-flex align-items-end">
                    <!-- <div class="d-flex"> -->
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input me-3" type="checkbox" value="" id="anticipada_promocion_barcos" x-model="reserva_anticipada.todos_los_barcos">
                        <label class="form-check-label" for="anticipada_promocion_barcos">
                            Aplicar a todos mis barcos
                        </label>
                    </div>
                    <button class="btn-regreso mx-3" @click="create_reserva_anticipada()">Crear</button>
                    <!-- </div> -->
                </div>
            </div>
            <template x-for="(i,index) in reservas_anticipadas.reverse()">
                <div class="d-flex justify-content-between border-top border-bottom py-3">
                    <div class="d-flex">
                        <span class="color-gray-dark me-2">Si reserva</span>
                        <span class="color-blue me-2" x-text="i.periodo + ' meses de anticipado'"></span>
                        <span class="color-blue me-2" x-text="i.descuento + i.tipo_descuento + ' de Descuento'">15%</span>
                        <span class="color-gray-dark me-2">Por</span>
                        <span class="color-blue me-2" x-text="i.duracion_minima + ' meses'"></span>
                        <span class="color-blue me-2" x-show="i.todos_los_barcos">Aplicado a todos tus barcos</span>
                    </div>
                    <div>
                        <button class="btn-icon-gray-dark" @click="edit_reserva_anticipada(i, index)"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn-icon-red" @click="eliminar_reserva_anticipada()"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <div class="d-flex flex-column mb-3">
        <div class="bg-gray p-3">
            <span>Promociones de reserva de último minuto</span>
            <p class="my-4">Establece un descuento si la reserva se realiza con una antelación máxima
                específica, ejemplo: 10% de descuento si se reserva con menos de 24 horas de antelación.</p>
            <div class="row pb-3">
                <div class="col-3">
                    <label for=""><b class="f-8">Periodo de reserva de último minuto</b></label>
                    <select class="form-select" x-model="reserva_ultimo_minuto.periodo">
                        <option value="1">1 mes de anticipación</option>
                        <option value="2">2 meses de anticipación</option>
                        <option value="3">3 meses de anticipación</option>
                        <option value="4">4 meses de anticipación</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for=""><b>Descuento</b></label>
                    <div class="d-flex">
                        <input class="form-control me-3" type="text" x-model="reserva_ultimo_minuto.descuento">
                        <select class="form-select" x-model="reserva_ultimo_minuto.tipo_descuento">
                            <option value="%">%</option>
                            <option value="€">€</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <label for=""><b>Duración mínima de la reserva</b></label>
                    <select class="form-select" x-model="reserva_ultimo_minuto.duracion_minima">
                        <option value="Siempre">Siempre</option>
                        <option value="1">1 Mes</option>
                        <option value="2">2 Meses</option>
                    </select>
                </div>
                <div class="col-4 d-flex align-items-end">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input me-3" type="checkbox" value="" id="ultimo_minuto_promocion_barcos" x-model="reserva_ultimo_minuto.todos_los_barcos">
                        <label class="form-check-label" for="ultimo_minuto_promocion_barcos">
                            Aplicar a todos mis barcos
                        </label>
                    </div>
                    <button class="btn-regreso mx-3" @click="create_ultimo_minuto()">Crear</button>
                </div>
            </div>
            <template x-for="(i,index) in reservas_ultimo_minuto">
                <div class="d-flex justify-content-between border-top border-bottom py-3">
                    <div class="d-flex">
                        <span class="color-gray-dark me-2">Si reserva</span>
                        <span class="color-blue me-2" x-text="i.periodo + ' meses de anticipado'"></span>
                        <span class="color-blue me-2" x-text="i.descuento + i.tipo_descuento + ' de Descuento'">15%</span>
                        <span class="color-gray-dark me-2">Por</span>
                        <span class="color-blue me-2" x-text="i.duracion_minima + ' meses'"></span>
                        <span class="color-blue me-2" x-show="i.todos_los_barcos">Aplicado a todos tus barcos</span>
                    </div>
                    <div>
                        <button class="btn-icon-gray-dark" @click="edit_reserva_ultimo_minuto(i,index)"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn-icon-red" @click="eliminar_reserva_ultimo_minuto(index)"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <div class="d-flex flex-column mb-3">
        <div class="bg-gray p-3">
            <span>Promoción en reserva anticipada</span>
            <p class="my-4">Establece un descuento si la reserva se realiza con una antelación máxima
                específica, ejemplo:
                10% de descuento si se reserva con menos de 24 horas de antelación.</p>
            <div class="row pb-3">
                <div class="col-3">
                    <label for=""><b>Periodo de reserva anticipada</b></label>
                    <select class="form-select">
                        <option value="">1 mes de anticipación</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for=""><b>Descuento</b></label>
                    <div class="d-flex">
                        <input class="form-control me-3" type="text">
                        <select class="form-select">
                            <option value="">%</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <label for=""><b>Duración mínima de la reserva</b></label>
                    <select class="form-select">
                        <option value="">Siempre</option>
                    </select>
                </div>
                <div class="col-4 d-flex align-items-end">
                    <!-- <div class="d-flex"> -->
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input me-3" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Aplicar a todos mis barcos
                        </label>
                    </div>
                    <button class="btn-regreso mx-3">Crear</button>
                    <!-- </div> -->
                </div>
            </div>
            <div class="d-flex justify-content-between border-top border-bottom py-3">
                <div class="d-flex">
                    <span class="color-gray-dark me-2">Si reserva</span>
                    <span class="color-blue me-2">3 meses de anticipado</span>
                    <span class="color-blue me-2">15% de Descuento</span>
                    <span class="color-gray-dark me-2">Por</span>
                    <span class="color-blue me-2">3 meses</span>
                    <span class="color-blue me-2">Aplicado a todos tus barcos</span>
                </div>
                <div>
                    <button class="btn-icon-gray-dark"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn-icon-red"><i class="fa-solid fa-trash-can"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column mb-3">
        <div class="bg-gray p-3">
            <span>Código de Promoción</span>
            <p class="my-4">Crea un código de descuento de acuerdo a un rango de fecha.</p>
            <div class="row pb-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for=""><b>Fecha de reserva</b></label>
                        </div>
                        <div class="col-6">
                            <label for="">Del</label>
                            <input class="form-control" type="date">
                        </div>
                        <div class="col-6">
                            <label for="">Al</label>
                            <input class="form-control" type="date">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for=""><b>Fecha del alquiler</b></label>
                        </div>
                        <div class="col-6">
                            <label for="">Del</label>
                            <input class="form-control" type="date">
                        </div>
                        <div class="col-6">
                            <label for="">Al</label>
                            <input class="form-control" type="date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <label for=""><b>Descuento</b></label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-6">
                            <select class="form-select mt-4" name="" id=""></select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <label for=""><b>Código</b></label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-6">
                            <button class="btn-regreso mx-3 mt-4">Crear</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 border-bottom pb-3">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Promoción aplicable (en porcentaje) también para un alquiler cuya duración es
                            inferior a la duración total del periodo
                        </label>
                    </div>
                </div>
                <div class="col-12 border-bottom pb-3">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Aplicar a todos mis barcos
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray">
        <div class="table-responsive">
            <table class="table table-striped table-padding-3">
                <thead>
                    <tr>
                        <th scope="col">Fecha de Rererva</th>
                        <th scope="col">Fecha del alquiler</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Código</th>
                        <th scope="col">Aplicable</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">
                            <div class="d-flex">
                                <span class="color-gray-dark me-2"> Del </span>
                                <span class="color-blue me-2"> 25/08/2021 </span>
                                <span class="color-gray-dark me-2"> Al </span>
                                <span class="color-blue me-2"> 25/09/2021 </span>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="d-flex">
                                <span class="color-gray-dark me-2"> Del </span>
                                <span class="color-blue me-2"> 25/08/2021 </span>
                                <span class="color-gray-dark me-2"> Al </span>
                                <span class="color-blue me-2"> 25/09/2021 </span>
                            </div>
                        </td>
                        <td class="color-blue">12%</td>
                        <td class="color-blue">EDFJJ&(*TGTE</td>
                        <td class="color-blue">Porcentaje</td>
                        <td class="color-blue">A todos mis barcos</td>
                        <td class="color-blue">
                            <div class="d-flex">
                                <button class="btn-icon-gray-dark"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-icon-red"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                            <div class="d-flex">
                                <span class="color-gray-dark me-2"> Del </span>
                                <span class="color-blue me-2"> 25/08/2021 </span>
                                <span class="color-gray-dark me-2"> Al </span>
                                <span class="color-blue me-2"> 25/09/2021 </span>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="d-flex">
                                <span class="color-gray-dark me-2"> Del </span>
                                <span class="color-blue me-2"> 25/08/2021 </span>
                                <span class="color-gray-dark me-2"> Al </span>
                                <span class="color-blue me-2"> 25/09/2021 </span>
                            </div>
                        </td>
                        <td class="color-blue">12%</td>
                        <td class="color-blue">EDFJJ&(*TGTE</td>
                        <td class="color-blue">Porcentaje</td>
                        <td class="color-blue">A todos mis barcos</td>
                        <td class="color-blue">
                            <div class="d-flex">
                                <button class="btn-icon-gray-dark"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-icon-red"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                            <div class="d-flex">
                                <span class="color-gray-dark me-2"> Del </span>
                                <span class="color-blue me-2"> 25/08/2021 </span>
                                <span class="color-gray-dark me-2"> Al </span>
                                <span class="color-blue me-2"> 25/09/2021 </span>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="d-flex">
                                <span class="color-gray-dark me-2"> Del </span>
                                <span class="color-blue me-2"> 25/08/2021 </span>
                                <span class="color-gray-dark me-2"> Al </span>
                                <span class="color-blue me-2"> 25/09/2021 </span>
                            </div>
                        </td>
                        <td class="color-blue">12%</td>
                        <td class="color-blue">EDFJJ&(*TGTE</td>
                        <td class="color-blue">Porcentaje</td>
                        <td class="color-blue">A todos mis barcos</td>
                        <td class="color-blue">
                            <div class="d-flex">
                                <button class="btn-icon-gray-dark"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-icon-red"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-gray mt-4 p-4">
        <div class="d-flex flex-column">
            <span class="mb-3">Promoción Personalizada</span>
            <span class="mb-3">Crea una promoción de acuerdo a tus alcances e indicaciones</span>
            <strong class="mb-2">Explicación como acceder a la promoción y que ganará</strong>
        </div>
        <div class="d-flex border-bottom pb-3">
            <input class="form-control" type="text">
            <button class="btn-regreso mx-3">Crear</button>
        </div>
        <div class="d-flex justify-content-between mt-3 p-3">
            <div>
                <span class="color-blue">Por la compra de 2 reservas lleva un paquete de tomas fotográficas
                    gratis con drone</span>
            </div>
            <div>
                <button class="btn-icon-gray-dark"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn-icon-red"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3 p-3 bg-white">
            <div>
                <span class="color-blue">50% si llevas a dos amigos</span>
            </div>
            <div>
                <button class="btn-icon-gray-dark"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn-icon-red"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3 p-3">
            <div>
                <span class="color-blue">Por la compra de 2 reservas lleva un paquete de tomas fotográficas
                    gratis con drone</span>
            </div>
            <div>
                <button class="btn-icon-gray-dark"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn-icon-red"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    function AdministradorBarcoCreatePromociones() {
        return {
            init() {},
            is_edit_reserva_anticipada: '',
            pos_reserva_anticipada: '',
            is_edit_ultimo_minuto: '',
            pos_ultimo_minuto: '',
            reservas_anticipadas: [],
            reserva_anticipada: {
                id: '',
                periodo: '',
                descuento: '',
                tipo_descuento: '',
                duracion_minima: '',
                todos_los_barcos: false,
                deleted_at: ''
            },
            reservas_ultimo_minuto: [],
            reserva_ultimo_minuto: {
                id: '',
                periodo: '',
                descuento: '',
                tipo_descuento: '',
                duracion_minima: '',
                todos_los_barcos: false,
                deleted_at: ''
            },
            // Inicio Reserva Anticipada
            create_reserva_anticipada() {

                this.reserva_anticipada.id = 1
                for (const key in this.reserva_anticipada) {
                    if (key != 'deleted_at' && key != 'id' && key != 'todos_los_barcos') {
                        if (!this.reserva_anticipada[key]) {
                            Swal.fire('', 'Completa todos los campos', 'error')
                            return false
                        }
                    }
                }

                let formulario = {}
                for (const key in this.reserva_anticipada) formulario[key] = this.reserva_anticipada[key]

                if (!this.is_edit_reserva_anticipada) this.reservas_anticipadas.push(formulario)
                else this.reservas_anticipadas[this.pos_reserva_anticipada] = formulario

                this.is_edit_reserva_anticipada = false

                for (const key in this.reserva_anticipada) this.reserva_anticipada[key] = ''
            },
            edit_reserva_anticipada(i, index) {
                this.is_edit_reserva_anticipada = true
                this.pos_reserva_anticipada = index
                for (const key in i) {
                    this.reserva_anticipada[key] = i[key]
                }
            },
            eliminar_reserva_anticipada(index) {
                if (!this.reserva_anticipada.id) {
                    this.reservas_anticipadas.splice(index, 1)
                } else {
                    this.reservas_anticipadas[index].deleted_at = true
                }
            },
            // Fin Reserva Anticipada
            // Inicio Reserva Último Minuto
            create_ultimo_minuto() {
                this.reserva_ultimo_minuto.id = 1
                for (const key in this.reserva_ultimo_minuto) {
                    if (key != 'deleted_at' && key != 'id' && key != 'todos_los_barcos') {
                        if (!this.reserva_ultimo_minuto[key]) {
                            Swal.fire('', 'Completa todos los campos', 'error')
                            return false
                        }
                    }
                }

                let formulario = {}
                for (const key in this.reserva_ultimo_minuto) formulario[key] = this.reserva_ultimo_minuto[key]

                if (!this.is_edit_reserva_ultimo_minuto) this.reservas_ultimo_minuto.push(formulario)
                else this.reservas_ultimo_minuto[this.pos_reserva_ultimo_minuto] = formulario

                this.is_edit_reserva_ultimo_minuto = false

                for (const key in this.reserva_ultimo_minuto) this.reserva_ultimo_minuto[key] = ''
            },
            edit_reserva_ultimo_minuto(i, index) {
                this.is_edit_reserva_ultimo_minuto = true
                this.pos_reserva_ultimo_minuto = index
                for (const key in i) {
                    this.reserva_ultimo_minuto[key] = i[key]
                }
            },

            eliminar_reserva_ultimo_minuto(index) {
                if (!this.reserva_ultimo_minuto.id) {
                    this.reservas_ultimo_minuto.splice(index, 1)
                } else {
                    this.reservas_ultimo_minuto[index].deleted_at = true
                }
            },
            // Fin Reserva Último Minuto
        }
    }
</script>