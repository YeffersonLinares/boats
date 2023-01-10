<div x-data="AdministradorBarcoIndex()">
    <div>
        <template x-if="pantalla=='index'">
            <div class="container-fluid">
                <div class="d-flex flex-column px-3 my-4">
                    <div>
                        <span class="color-dark-extras f-8">Barcos</span>
                    </div>
                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-chevron-left me-3 color-gray-dark"></i>
                            <strong class="color-dark-extras">Listado de Barcos</strong>
                        </div>
                        <div class="d-flex">
                            <button class="btn-guardar-mod me-3" @click="tarea_create()">Crear nueva Tarea <i class="fa-solid fa-check-to-slot ms-2"></i></button>
                            <button class="btn-blue-tareas" @click="barco_create()">Agregar Barco <i class="fa-solid fa-circle-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
        
                <div class="row px-4">
                    <div class="col-lg-9">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa-solid fa-filter mb-1 me-2"></i>
                            <h6> Filtrar Listado | 6 Barcos </h6>
                        </div>
                        <div class="row">
                            <template x-for="(i,index) in botes">
                                <div class="col-sm-6 col-md-4 mb-4" role="button">
                                    <div class="card card_cliente">
                                        <img class="size-img-card" src="images/Screenshot_1.png" alt="...">
                                        <div class="card-body color-dark-extras">
                                            <div class="d-flex justify-content-between w-100 border-bottom pb-1">
                                                <div>
                                                    <span> <strong class="color-dark-extras" x-text="i.nombre">Namaré</strong> </span>
                                                    <i class="fa-sharp fa-solid fa-triangle-exclamation fa-lg color-warning-boa"></i>
                                                </div>
                                                <div class="color-green-check">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <span>100%</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between border-bottom p-1">
                                                <div>
                                                    <i class="fa-solid fa-graduation-cap color-extras-gray"></i>
                                                    <span class="color-gray" 
                                                    x-text="i.reserva_sin_titulacion ? 'Sin titulación' : 'No requiere titulación'"
                                                    >Sin titulación</span>
                                                </div>
                                                <div class="color-extras-gray">
                                                    <i class="fa-solid fa-users"></i>
                                                    <span x-text="i.cant_pasajeros"></span>
                                                    <i class="fa-sharp fa-solid fa-left-right"></i>
                                                    <span x-text="i.eslora + 'mts'">4,9mts</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column mt-3">
                                                <strong class="color-grays">4hs175€</strong>
                                                <strong class="color-grays f-9">8hs 260€</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div>
                            <strong class="color-gray-dark"> ¿Dónde están tus barcos? </strong>
                            <img class="d-block w-100 mt-3" src="images/mapa.jpg" alt="...">
                            <span class="color-extras-gray f-8">Actualización cada 02 segundos</span>
                        </div>
                        <div class="my-3">
                            <strong>Tareas de embarcaciones</strong>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column border-bottom pb-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-1 color-dark-red"><i class="fa-solid fa-check-to-slot"></i></div>
                                        <div><span class="color-dark-blue">Tarea</span></div>
                                    </div>
                                    <div class="d-flex">
                                        <div><strong class="me-1 color-dark-blue">[nombre del barco]</strong></div>
                                        <div class="d-flex align-items-center mb-2"><i class="fa-brands fa-whatsapp fa-lg green-claro-inicio"></i></div>
                                    </div>
                                </div>
                                <div>
                                    <strong class="color-dark-extras ms-1p4rem">Revisión de Motor</strong>
                                </div>
                                <div class="d-flex">
                                    <span class="color-gray-dark me-1 ms-1p4rem">Proridad:</span> <span class="color-red">Crítica</span>
                                </div>
                                <div class="d-flex mt-1">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Frecuencia:</span> <span class="color-dark-blue">Cada 4 días</span>
                                </div>
                                <div class="d-flex">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Fecha limite:</span> <strong class="color-dark-blue">Hoy</strong>
                                </div>
                            </div>
                            <div class="d-flex flex-column border-bottom pb-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-1 color-dark-extras"><i class="fa-solid fa-check-to-slot"></i></div>
                                        <div><span class="color-dark-blue">Tarea</span></div>
                                    </div>
                                    <div class="d-flex">
                                        <div><strong class="me-1 color-dark-blue">[nombre del barco]</strong></div>
                                        <div class="d-flex align-items-center mb-2"><i class="fa-brands fa-whatsapp fa-lg green-claro-inicio"></i></div>
                                    </div>
                                </div>
                                <div>
                                    <strong class="color-dark-extras ms-1p4rem">Revisión de Motor</strong>
                                </div>
                                <div class="d-flex">
                                    <span class="color-gray-dark me-1 ms-1p4rem">Proridad:</span> <span class="color-red">Crítica</span>
                                </div>
                                <div class="d-flex mt-1">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Frecuencia:</span> <span class="color-dark-blue">Cada 4 días</span>
                                </div>
                                <div class="d-flex">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Fecha limite:</span> <strong class="color-dark-blue">Hoy</strong>
                                </div>
                            </div>
                            <div class="d-flex flex-column border-bottom pb-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-1 color-golden"><i class="fa-solid fa-check-to-slot"></i></div>
                                        <div><span class="color-dark-blue">Tarea</span></div>
                                    </div>
                                    <div class="d-flex">
                                        <div><strong class="me-1 color-dark-blue">[nombre del barco]</strong></div>
                                        <div class="d-flex align-items-center mb-2"><i class="fa-brands fa-whatsapp fa-lg green-claro-inicio"></i></div>
                                    </div>
                                </div>
                                <div>
                                    <strong class="color-dark-extras ms-1p4rem">Revisión de Motor</strong>
                                </div>
                                <div class="d-flex">
                                    <span class="color-gray-dark me-1 ms-1p4rem">Proridad:</span> <span class="color-red">Crítica</span>
                                </div>
                                <div class="d-flex mt-1">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Frecuencia:</span> <span class="color-dark-blue">Cada 4 días</span>
                                </div>
                                <div class="d-flex">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Fecha limite:</span> <strong class="color-dark-blue">Hoy</strong>
                                </div>
                            </div>
                            <div class="d-flex flex-column border-bottom pb-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-1 color-golden"><i class="fa-solid fa-check-to-slot"></i></div>
                                        <div><span class="color-dark-blue">Tarea</span></div>
                                    </div>
                                    <div class="d-flex">
                                        <div><strong class="me-1 color-dark-blue">[nombre del barco]</strong></div>
                                        <div class="d-flex align-items-center mb-2"><i class="fa-brands fa-whatsapp fa-lg green-claro-inicio"></i></div>
                                    </div>
                                </div>
                                <div>
                                    <strong class="color-dark-extras ms-1p4rem">Revisión de Motor</strong>
                                </div>
                                <div class="d-flex">
                                    <span class="color-gray-dark me-1 ms-1p4rem">Proridad:</span> <span class="color-red">Crítica</span>
                                </div>
                                <div class="d-flex mt-1">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Frecuencia:</span> <span class="color-dark-blue">Cada 4 días</span>
                                </div>
                                <div class="d-flex">
                                    <span class="color-dark-extras me-1 ms-1p4rem">Fecha limite:</span> <strong class="color-dark-blue">Hoy</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template x-if="pantalla=='create'">
            <div>
                <?php include_once 'AdministradorBarcoCreate.php'; ?>
            </div>
        </template>
    </div>
</div>
<script>
    function AdministradorBarcoIndex() {
        return {
            pantalla: 'create',
            // pantalla: 'index',
            botes: [],
            init() {
                this.lang("client")
                this.get_barcos()
            },
            get_barcos() {
                let url = this.base_url + '/administrador/get-botes'
                axios.get(url).then(res => {
                    this.botes = res.data
                    console.log('res.data ==> ', res.data);
                });
                // this.pantalla = 'create'
            },
            barco_create() {
                this.pantalla = 'create'
            },
        }
    }
</script>