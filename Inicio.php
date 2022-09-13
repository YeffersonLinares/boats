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
            <button class="button-inicio mb-3">Nueva Tarea <i class="fa-solid fa-triangle-exclamation"></i></button>
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