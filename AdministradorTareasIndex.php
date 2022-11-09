<div x-data="AdministradorTareasIndex()">
    <template x-if="pantalla == 'index'">
        <div>
            <div class="d-flex justify-content-center align-items-center">
                <div>
                    <h5 class="text-center mt-3 color-dark-blue"> <b> Tareas Simples y Rutinarias</b> </h5>
                </div>
            </div>
            <hr class="my-1">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h4> <strong> Listado de Tareas & Rutinas registradas </strong> </h4>
                    <button class="btn-blue-tareas my-2" @click="pantalla = 'create'; accion=1">
                        Crear nueva Tarea
                        <i class="fa-solid fa-check-to-slot"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="form-check me-3 f-9">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="ver_todas" checked @change="getTareas('todas')">
                            <label class="form-check-label" for="ver_todas">
                                Ver todas
                            </label>
                        </div>
                        <div class="form-check me-3 f-9">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="tareas_simples" @change="getTareas('simples')">
                            <label class="form-check-label" for="tareas_simples">
                                Solo tareas simples
                            </label>
                        </div>
                        <div class="form-check me-3 f-9">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="tareas_rutinarias" @change="getTareas('rutinarias')">
                            <label class="form-check-label" for="tareas_rutinarias">
                                Solo Tareas Rutinarias
                            </label>
                        </div>
                        <div class="form-check me-3 f-9">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="tareas_completadas" @change="getTareas('completadas')">
                            <label class="form-check-label" for="tareas_completadas">
                                Solo Tareas completadas
                            </label>
                        </div>
                    </div>
                    <div class="d-flex form-group">
                        <label for="">Ordenar por:</label>
                        <select class="form-select" @change="getTareas()" x-model="filtros.orden">
                            <option value="DESC">Fecha asignada más próxima</option>
                            <option value="ASC">Fecha asignada más alejada</option>
                        </select>
                    </div>
                </div>

                <template x-for="(i,index) in tareas">
                    <div class="container-fluid mt-4 row border-bottom pb-4" :class="[i.estado_tarea_id == 3 ? 'opacity03' : '']">
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex mb-3">
                                    <button class="btn btn-transparent color-dark-red me-2"><i class="fa-solid fa-check-to-slot"></i></button>
                                    <strong class="color-dark-blue me-3" x-text="i.tipo_tarea?.nombre"></strong>
                                    <strong class="color-dark-extras me-3" x-text="i.titulo"></strong>
                                    <span class="color-gray-dark me-1"> - </span>
                                    <span class="color-gray-dark me-1"> Prioridad: </span>
                                    <span class="me-3" :style="'color:' + i.importancia?.color" x-text="i.importancia?.nombre">Crítica: </span>
                                    <span class="color-gray-dark me-3"> - </span>
                                    <span class="color-gray-dark me-3"> Fecha asignada: </span>
                                    <span class="color-dark-blue" x-text="i.fecha_asignada"></span>
                                </div>
                                <div class="d-flex container">
                                    <span class="color-dark-blue me-1" x-text="i.gastos_count"></span>
                                    <span class="color-extras-gray">Gastos adheridos</span>
                                    <span class="mx-3">|</span>
                                    <span class="color-extras-gray me-3">Total de gastos</span>
                                    <strong class="color-dark-blue" x-text="'€' + (i.gastos_sum_precio == null ? 0 : i.gastos_sum_precio)">124</strong>
                                    <span class="mx-3">|</span>
                                    <span class="color-dark-blue me-1" x-text="i.observaciones_count"></span>
                                    <span class="color-extras-gray">Observaciones</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end pe-4 d-flex flex-column">
                            <div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <span class="color-dark-extras me-1">Afectado a:</span>
                                    <strong class="color-dark-blue" x-text="i.bote?.nombre"></strong>
                                    <div class="ms-2 color-whatsapp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="text-end">
                                <span class="color-extras-gray f-9" x-text="'Creado: ' + i.created_at + ' - Martín Pavón'"></span>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-around">
                            <button class="btn btn-transparent color-dark-red" @click="eliminar_tarea(i.id, index)" :disabled="i.estado_tarea_id == 3"><i class="fa-solid fa-trash-can"></i></button>
                            <button class="btn btn-transparent color-gray-dark" @click="editar_tarea(i, index)" :disabled="i.estado_tarea_id == 3"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-transparent color-gray-dark" @click="completar_tarea(i, index)" :disabled="i.estado_tarea_id == 3" :class="[i.estado_tarea_id == 3 ? 'green-claro-inicio' : '']">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </template>
    <template x-if="pantalla == 'create'">
        <div>
            <?php include_once "AdministradorTareasCreate.html" ?>
        </div>
    </template>
</div>
<script>
    function AdministradorTareasIndex() {
        return {
            pantalla: 'index',
            accion: '',
            tarea: {},
            posicion: '',
            // pantalla: 'create',
            tareas: [],
            filtros: {
                tipo: null,
                orden: 'DESC'
            },
            init() {
                $('#nav-tareas-tab').click()
                this.getTareas()
            },
            getTareas(tipo) {
                if (tipo) this.filtros.tipo = tipo

                this.loading = true
                let url = this.base_url + '/administrador/get_tareas'
                axios.post(url, this.filtros).then(res => {
                    this.tareas = res.data.tareas
                    this.loading = false
                })
            },
            eliminar_tarea(id, index) {
                Swal.fire({
                    title: "¿Estás seguro de eliminar esta tarea?",
                    showDenyButton: true,
                    confirmButtonText: "Si",
                    denyButtonText: "No",
                    allowOutsideClick: false,
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        // this.loading = true;
                        let url = this.base_url + '/administrador/eliminar_tareas'
                        axios.post(url, {
                            id: id
                        }).then(res => {
                            if (res.data.status == 200) {
                                this.tareas.splice(index, 1)
                                Swal.fire('Éxito', res.data.msg, 'success')
                                this.pantalla = 'index'
                            } else if (res.data.status == 500) {
                                Swal.fire('Error', res.data.msg, 'error')
                            }
                        })
                    }

                });
            },
            completar_tarea(i, index) {
                Swal.fire({
                    title: "¿Estás seguro la tarea " + i.titulo + '?',
                    showDenyButton: true,
                    confirmButtonText: "Si",
                    denyButtonText: "No",
                    allowOutsideClick: false,
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        // this.loading = true;
                        let url = this.base_url + '/administrador/completar_tareas'
                        axios.post(url, {
                            id: i.id
                        }).then(res => {
                            if (res.data.status == 200) {
                                Swal.fire('Éxito', res.data.msg, 'success')
                                this.tareas[index].estado_tarea_id = 3
                                this.pantalla = 'index'
                            }
                            // this.loading = false
                        })
                    }

                });
            },
            editar_tarea(i, index) {
                this.tarea = i
                this.accion = 2
                this.posicion = index
                this.pantalla = 'create'

            }
        }
    }
</script>