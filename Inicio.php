<style>
    .button-inicio {
        color: white;
        background: #31a6fb;
        padding: .5rem;
        border: 0px;
        border-radius: 10px;
        font-size: 1rem;
    }

    .blue-inicio {
        background: #1d6caf;
        color: white;
    }

    .blue-claro-inicio {
        color: #31a6fb;
    }

    .green-claro-inicio {
        color: #00b20a;
    }

    .title-inicio {
        font-size: 1.3rem;
    }

    .cuadradito {
        background-color: #31a6fb;
        width: 10px;
        height: 10px;
    }
</style>
<section x-data="inicio">
    <div class="row">
        <div class="col-12 text-center mb-2">
            <b>Bienvenido<span class="text-blue"> Admin#1224</span></b>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 d-flex flex-column">
            <button class="button-inicio mb-3" @click="link('https://rutaapp.com/boats/reserva/')">Nueva Reserva <i class="fa-solid fa-ship"></i></button>
            <button class="button-inicio mb-3" @click="redirect('/boats/reservas_admin/')">Ingresar Pago o Gasto <i class="fa-regular fa-credit-card"></i></button>
            <button class="button-inicio mb-3"  data-bs-toggle="modal" data-bs-target="#modal_nueva_tarea">
                Nueva Tarea <i class="fa-solid fa-triangle-exclamation"></i>
            </button>
            <hr class="mt-4 mb-3">
            <button class="button-inicio blue-inicio mb-3">Ver clima actual <i class="fa-solid fa-cloud-sun"></i></button>
        </div>


        <div class="col-lg-5">
            <div class="d-flex justify-content-between">
                <span class="title-inicio text-blue">Calendario de Reservas</span>
                <button class="button-inicio blue-inicio">Ver mes completo <i class="fa-solid fa-calendar-days"></i></button>
            </div>

            <div class="mt-3">
                <template x-for="(i,index) in reservas" :key="index">
                    <ul class="list-group">
                            <!-- <li class="list-group-item blue-inicio" aria-current="true">Jueves 02 de Septiembre</li> -->
                            <li class="list-group-item blue-inicio" aria-current="true" x-text="i.key"></li>
                            <template x-for="(item, llave) in i.value" :key="llave">
                                <li class="list-group-item" @click="detalles_reserva(item.reserva_id)">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="cuadradito "></div>
                                            <b class="ms-2"x-text="item.hora_fin + ' - ' + item.hora_fin"> </b>
                                        </div>
                                        <span x-text="item.nombre"></span>
                                        <span class="blue-claro-inicio text-start">Navegando</span>
                                        <span>100€/220€</span>
                                    </div>
                                </li>
                            </template>
                    </ul>
                </template>
            </div>
        </div>


        <div class="col-lg-4 d-flex flex-column">
            <span class="title-inicio text-blue">Donde están tus barcos?</span>
            <div style="width: 100%; height: 300px; background-color: #31a6fb;">
            </div>

            <span class="title-inicio text-blue">Tareas Pendientes</span>
            <ul class="list-group">
                <li class="list-group-item blue-inicio" aria-current="true">Jueves 02 de Septiembre</li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <b class="ms-2"> Revisión de Motor y desperfecto y…</b>
                        </div>
                        <span>Urgente</span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <b class="ms-2"> Revisión de Motor y desperfecto y…</b>
                        </div>
                        <span>Urgente</span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <b class="ms-2"> Revisión de Motor y desperfecto y…</b>
                        </div>
                        <span>Urgente</span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <b class="ms-2"> Revisión de Motor y desperfecto y…</b>
                        </div>
                        <span>Urgente</span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <b class="ms-2"> Revisión de Motor y desperfecto y…</b>
                        </div>
                        <span>Urgente</span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <b class="ms-2"> Revisión de Motor y desperfecto y…</b>
                        </div>
                        <span>Urgente</span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation "></i>
                            <b class="ms-2"> Revisión de Motor y desperfecto y…</b>
                        </div>
                        <span>Urgente</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="modal fade" id="modal_nueva_tarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container-fluid mt-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="color-gray">Tareas Registradas</h5>
                            <div class="d-flex color-gray">
                                <span>Ordenar Por: </span>
                                <select class="form-select">
                                    <option value="">Tareas para embarcación</option>
                                </select>
                            </div>
                        </div>
                        <div class="container-fluid mt-4 table-responsive">
                            <table class="table" style="vertical-align: middle">
                                <tr>
                                    <td>
                                        <button class="btn-icon-red"> <i class="fa-solid fa-triangle-exclamation fa-lg"></i> </button>
                                    </td>
                                    <td class="color-gray f-9" style="width: 56%;">
                                        <strong> Namaré 300 </strong>
                                        <span> Namaré 300.- Revisión de Motor y desperfecto y reparación de vela de proa, ademas llamar a Roberto para adecuación de las demás herramientas </span>
                                    </td>
                                    <td>
                                        <span class="color-gray f-9"> Atención:  </span>
                                        <strong class="color-dark-blue"> Urgente </strong>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn-icon-red"> <i class="fa-solid fa-trash-can"></i> </button>
                                            <button class="btn-icon-gray"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                            <button class="btn-icon-gray"> <i class="fa-solid fa-check"></i> </button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <h5 class="color-dark-blue"> <strong> Creación de Tareas </strong> </h5>
                            <div class="container-fluid bg-gray p-3">
                                <h5 class="color-gray">Detalle de la tarea</h5>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Comments</label>
                                </div>
                                <div class="row mb-3 color-gray">
                                    <div class="col-lg-3">
                                        <label for=""> Tarea asignada para </label>
                                        <select class="form-select">
                                            <option value="">Una embarcación</option>
                                            <option value="">Un miembro del staff</option>
                                            <option value="">Tarea en general</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for=""> &NonBreakingSpace; </label>
                                        <select class="form-select">
                                            <option value="">Namaré 300</option>
                                            <option value="">Singapur 200</option>
                                            <option value="">Cala XD</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for=""> Atención: </label>
                                        <select class="form-select">
                                            <option value="">Urgente</option>
                                            <option value="">Proximamente</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 color-gray">
                                        <label for=""> Fecha para tarea: </label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="row align-items-center color-gray">
                                    <div class="col-4">
                                        <label class="form-label" for=""> Agregar Gastos a la Tarea </label>
                                        <input class="form-control" type="text" placeholder="Descripción de nuevo gasto*">
                                    </div>
                                    <div class="col-2">
                                        <label for="">&NonBreakingSpace;</label>
                                        <select class="form-select">
                                            <option value="">Medio de pago</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label" for="">&NonBreakingSpace;</label>
                                        <input class="form-control" type="text" placeholder="Importe Neto €*">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label" for="">&NonBreakingSpace;</label>
                                        <button class="btn-general-gray f-9">Adjuntar factura <i class="fa-solid fa-camera"></i> </button> 
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label" for="">&NonBreakingSpace;</label>
                                        <button class="btn-general-gray f-9">Agregar Nuevo Gasto</button>
                                    </div>
                                    <hr class="my-3">
                                    <div class="col-12 d-flex justify-content-between">
                                        <div> <span> Gastos por peaje extra </span> </div>
                                        <div class="d-flex">
                                            <span class="me-2 color-blue"> 10€ </span>
                                            <button class="btn-icon-red"> <i class="fa-solid fa-trash-can"></i> </button> 
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn-blue-dark-general"> Guardar Tarea </button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>


    <script>
        function inicio() {
            return {
                message: 'Hello alpine!',
                reservas: [],
                link(data) {
                    console.log("data", data);
                    window.location.href = data
                },
                init() {
                    this.get_reservas()
                },
                get_reservas() {
                    let url = window.location.origin + "/boats/wp-content/themes/twentytwentytwo/ReservasInicioController.php"
                    axios.post(url).then(res => {
                        let data = res.data
                        let array = []
                        for (const key in data) {
                            array.push({key: key, value: data[key]})
                        }
                        this.reservas = array
                        console.log('this.reservas ==> ', this.reservas);
                    })
                },
                redirect(uri){
                    let url = window.location.origin + uri
                    window.location.href = url
                },
                detalles_reserva(reserva_id) {
                    let url = window.location.origin + '/boats/wp-content/themes/twentytwentytwo/ResumeReservaAdmin.html?reserva_id='+reserva_id
                    window.location.href = url
                }
            }
        }
    </script>
</section>

<style>
    .list-group-item {
        cursor: pointer;
    }
</style>