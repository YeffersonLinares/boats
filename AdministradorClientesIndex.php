<div x-data="AdministradorClientesIndex()">
    <template x-if="pantalla=='index'">
        <div>
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <b class="text-blue">Clientes</b>
                    <hr>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button @click="cambiar_pantalla('create')">Agregar Nuevo Cliente <i class="fa-solid fa-user-plus"></i></button>
            </div>
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <i class="fa-solid fa-filter mb-1 me-2"></i>
                    <h5 x-text="clientes.length + ' Clientes Ingresados'"> </h5>
                </div>
            </div>
            <div class="row">
                <template x-for="(i,index) in clientes" :key="index">
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card card_cliente">
                            <!-- <img :src="i.image" class="card-img-top" alt="..."> -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0a/Documento_de_Identidad_2000%E2%80%942020_%28Mayores_de_Edad%29_Anverso.jpg"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card_cliente-title" x-text="i.nombre + ' ' + i.apellido"></h5>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span> <i class="fa-solid fa-graduation-cap"></i>
                                        <template x-if="i.titulado">
                                            <span>Titulado</span>
                                        </template>
                                        <template x-if="!i.titulado">
                                            <span>No titulado</span>
                                        </template>
                                    </span>
                                    <span>
                                        <span x-text="i.telefono"></span>
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><i class="fa-solid fa-id-card"></i>
                                        <span x-text="i.num_dni"></span>
                                    </span>
                                    <span>
                                        <span x-text="maskEmail(i.email)"></span>
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-9 d-flex flex-column">
                                        <span class="mb-1">Reservas Abiertas: <b class="text-blue"
                                                x-text="i.reserva_count"></b></span>
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
                </template>
            </div>
        </div>
    </template>
    <template x-if="pantalla=='create'">
        <div>
            <?php include_once 'AdministradorClientesCreate.html'; ?>
        </div>
    </template>
</div>
<script>
    function AdministradorClientesIndex() {
        return {
            clientes: [],
            pantalla: 'create',
            // pantalla: 'index',
            init() {
                // $('#nav-clientes-tab').click()
                this.getClients()
            },
            getClients() {
                let url = this.base_url + '/administrador/get_clientes'
                axios.post(url).then(res => {
                    this.clientes = res.data.clientes
                })
            },
            maskEmail(email) {
                if (email) {
                    let mask = email.split('@');
                    return mask[0] + '@...'
                } else {
                    return ''
                }
            },
            cambiar_pantalla(pantalla) {
                this.pantalla = pantalla
            }
        }
    }
</script>