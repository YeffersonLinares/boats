<div x-data="AdministradorExtrasIndex()">
    <template x-if="pantalla=='index'">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <b class="text-blue">Extras</b>
                    <hr>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn-blue-tareas">Agregar Nuevo Extra <i class="fa-solid fa-circle-arrow-right"></i></button>
            </div>
            <div class="row mb-5">
                <div class="col-12 d-flex align-items-center">
                    <i class="fa-solid fa-filter mb-1 me-2"></i>
                    <h6> Filtrar Listado | 8 Extras </h6>
                </div>
            </div>
            <div class="row px-4">
                <template x-for="(i,index) in extras">
                    <div class="col-md-6 col-lg-3 mb-3" role="button">
                        <div class="card card_cliente min-height37rem">
                            <img :src="i.imagen1" alt="...">
                            <div class="card-body color-dark-extras">
                                <h5 class="card_cliente-title" x-text="i.nombre"></h5>
                                <hr>
                                <hr>
                                <div class="row mt-2 min-height9rem">
                                    <div class="col-12" x-text="i.descripcion">
                                    </div>
                                </div>
                                <div class="d-flex flex-column my-3">
                                    <template x-for="(item,position) in i.detalles">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span x-text="'tamaño ' + item.descripcion">Tamaño S</span>
                                            <span x-text="'+' + item.valor">+30€</span>
                                        </div>
                                    </template>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="bg-red color-white padding-015rem">99</span>
                                    </div>
                                    <select class="form-select py-1" name="" id="" style="width: 50%;">
                                        <option value="">Seleccione</option>
                                    </select>
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
            <?php include_once 'AdministradorExtrasCreate.html'; ?>
        </div>
    </template>
</div>
<script>
    function AdministradorExtrasIndex() {
        return {
            pantalla: 'create',
            extras: [],
            init() {
                // $('#nav-clientes-tab').click()
                this.getExtras()
            },
            getExtras() {
                let url = this.base_url + '/administrador/get_extras'
                axios.post(url).then(res => {
                    this.extras = res.data.extras
                })
            },
        }
    }
</script>