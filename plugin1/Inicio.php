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
            <button class="button-inicio mb-3">Ingresar Pago o Gasto <i class="fa-regular fa-credit-card"></i></button>
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
                <ul class="list-group">
                    <li class="list-group-item blue-inicio" aria-current="true">Jueves 02 de Septiembre</li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Llaut 1</span>
                            <span class="blue-claro-inicio text-start">Navegando</span>
                            <span>100€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Quicksilver</span>
                            <span class="green-claro-inicio text-start">Llegó</span>
                            <span>220€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item blue-inicio" aria-current="true">Jueves 02 de Septiembre</li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Llaut 1</span>
                            <span class="blue-claro-inicio text-start">Navegando</span>
                            <span>100€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Quicksilver</span>
                            <span class="green-claro-inicio text-start">Llegó</span>
                            <span>220€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item blue-inicio" aria-current="true">Jueves 02 de Septiembre</li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Llaut 1</span>
                            <span class="blue-claro-inicio text-start">Navegando</span>
                            <span>100€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Quicksilver</span>
                            <span class="green-claro-inicio text-start">Llegó</span>
                            <span>220€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item blue-inicio" aria-current="true">Jueves 02 de Septiembre</li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Llaut 1</span>
                            <span class="blue-claro-inicio text-start">Navegando</span>
                            <span>100€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Quicksilver</span>
                            <span class="green-claro-inicio text-start">Llegó</span>
                            <span>220€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item blue-inicio" aria-current="true">Jueves 02 de Septiembre</li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Llaut 1</span>
                            <span class="blue-claro-inicio text-start">Navegando</span>
                            <span>100€/220€</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cuadradito "></div>
                                <b class="ms-2"> 10:30 - 14:30</b>
                            </div>
                            <span>Quicksilver</span>
                            <span class="green-claro-inicio text-start">Llegó</span>
                            <span>220€/220€</span>
                        </div>
                    </li>
                </ul>
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
        function inicio(){
            return {
                message: 'Hello alpine!',
                link(data){ 
                    console.log("data",data);
                    window.location.href =data
                },
                init(){
                    this.get_reservas()
                },
                get_reservas() {
                    let url = window.location.origin + "/boats/wp-content/themes/twentytwentytwo/ReservasInicioController.php"
                    axios.post(url).then(res => {
                        console.log('res.data ==> ', res.data);
                    })
                }
            }
        }
    </script>
</section>