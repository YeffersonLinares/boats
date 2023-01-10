<div class="container-fluid pe-5" x-data="AdministradorBarcoCreateAspectosTecnicos()">
    <!-- <div class="d-flex">
        <button class="btn-blue-tareas">Siguiente <i class="fa-solid fa-circle-arrow-right"></i></button>
    </div> -->
    <div class="row">
        <div class="col-md-4 color-dark-extras mb-5">
            <label for="">Capacidad a bordo autorizada *</label>
            <input class="form-control" type="text" x-model="form.cant_pasajeros">
        </div>
        <div class="col-md-4 color-dark-extras mb-5">
            <label for="">Capacidad a bordo recomendada *</label>
            <input class="form-control" type="text" x-model="form.cant_pasajeros_recomendada">
        </div>
        <div class="col-md-4 color-dark-extras mb-5">
            <label for="">Número de cabinas *</label>
            <input class="form-control" type="text" x-model="form.num_cabinas">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 color-dark-extras mb-5">
            <label for="">Número de camas *</label>
            <input class="form-control" type="text" x-model="form.num_camas">
        </div>
        <div class="col-md-4 color-dark-extras mb-5">
            <label for="">Número de baños *</label>
            <input class="form-control" type="text" x-model="form.num_banios">
        </div>
        <div class="col-md-4 color-dark-extras mb-5">
            <label for="">Eslora (largo de la embarcación) *</label>
            <div class="d-flex align-items-center">
                <input class="form-control me-2 w-50" type="text" x-model="form.eslora">
                <span class="fs-5">m</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 color-dark-extras">
            <label for="">Combustible *</label>
            <div class="d-flex">
                <input class="form-control me-3" type="text" x-model="form.combustible">
                <select class="form-select w-50">
                    <option value="L/h">L/h</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 color-dark-extras">
            <label for="">Velocidad de crucero</label>
            <div class="d-flex">
                <input class="form-control me-3" type="text" x-model="form.velocidad_crucero">
                <select class="form-select w-50">
                    <option value="Kn">Kn</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 color-dark-extras">
            <label for="">Año de la embarcación *</label>
            <input class="form-control" type="text" x-model="form.anio_embarcacion">
        </div>
        <div class="col-md-3 color-dark-extras">
            <label for="">Renovación</label>
            <input class="form-control me-2" type="text" x-model="form.renovacion">
        </div>
    </div>
</div>

<script>
    function AdministradorBarcoCreateAspectosTecnicos() {
        return {
            init() {},
            store() {
                let url = this.base_url + '/'
                axios.post()
            }
        }
    }
</script>