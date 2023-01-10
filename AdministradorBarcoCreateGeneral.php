<div x-data="AdministradorBarcoCreateGeneral()">
    <div class="row">
        <div class="col-md-4 mb-4">
            <label>Nombre del barco *</label>
            <input class="form-control" type="text">
        </div>
    </div>
    <div>
        <label class="mb-4">Tipo de barco *</label>
        <div class="d-flex mb-4">
            <template x-for="(i, index) in tipos">
                <div class="d-flex flex-column me-4 align-items-center">
                    <button class="btn btn-transparent button-active-extras" @click="active_extra(index)">
                        <i class="fa-solid fa-2x p-2 border-button-extras" x-bind:class="[i.active ? 'active ' + i.icon : i.icon]"></i>
                    </button>
                    <span class="f-8" x-text="i.nombre"></span>
                </div>
            </template>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="">Ciudad *</label>
            <input class="form-control" type="text" x-model="form.ciudad">
        </div>
        <div class="col-md-6 mb-4">
            <label for="">Puerto *</label>
            <input class="form-control" type="text" x-model="form.puerto">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <label for="">Fabricante *</label>
            <input class="form-control" type="text" x-model="form.fabricante">
        </div>
        <div class="col-md-4 mb-4">
            <label for="">Modelo *</label>
            <input class="form-control" type="text" x-model="form.modelo">
        </div>
        <div class="col-md-4 mb-4">
            <label for="">N° de matrícula *</label>
            <input class="form-control" type="text" x-model="form.matricula">
        </div>
    </div>
    <div class="row border-top border-bottom mb-4 py-4">
        <div class="col-md-4">
            <label for="">Titulación requerida*</label>
            <select class="form-select" name="" id="" x-model="form.tipo_titulacion_requerida">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    <div class="row bg-gray p-4 mb-4">
        <div class="col-12 mb-3">
            <span class="fs-6"> Capitán de esta embarcación* </span>
        </div>
        <div class="col-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Es necesario para esta
                    embarcación</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">El usuario puede elegir con o sin
                    capitán</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                <label class="form-check-label" for="inlineRadio3">No se alquila con capitán</label>
            </div>
        </div>
        <hr class="my-4">
        <div class="col-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="reserva_sin_titulacion" value="option1" x-model="form.reserva_sin_titulacion">
                <label class="form-check-label" for="reserva_sin_titulacion">Permitir la reserva de este barco si
                    no se dispone la titulación requerida ni capitán</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <span> Horarios activos del barco </span>
        </div>
        <div class="col-12 w-80">
            <div class="row mb-3">
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="1hora" value="option1">
                    <label class="form-check-label" for="1hora">1 hora</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="8horas" value="option2">
                    <label class="form-check-label" for="8horas">8 horas</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="3dias" value="option3">
                    <label class="form-check-label" for="3dias">3 días</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="amanecer" value="option3">
                    <label class="form-check-label" for="amanecer">Amanecer</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="2horas" value="option1">
                    <label class="form-check-label" for="2horas">2 horas</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="1dia" value="option2">
                    <label class="form-check-label" for="1dia">1 día</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="5dias" value="option3">
                    <label class="form-check-label" for="5dias">5 días</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="atardecer" value="option3">
                    <label class="form-check-label" for="atardecer">Atardecer</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="4horas" value="option1">
                    <label class="form-check-label" for="4horas">4 horas</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="2dias" value="option2">
                    <label class="form-check-label" for="2dias">2 días</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="7dias" value="option3">
                    <label class="form-check-label" for="7dias">7 días</label>
                </div>
                <div class="col-3">
                    <input class="form-check-input me-2" type="checkbox" id="salidaNocturna" value="option3">
                    <label class="form-check-label" for="salidaNocturna">Salida Nocturna</label>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function AdministradorBarcoCreateGeneral() {
        return {
            init() {},
            tipos: [{
                    nombre: 'Neumático',
                    icon: 'fa-volleyball',
                    active: true,
                },
                {
                    nombre: 'Moto de Agua',
                    icon: 'fa-utensils',
                    active: false,
                },
                {
                    nombre: 'Yate',
                    icon: 'fa-star',
                    active: false,
                },
                {
                    nombre: 'Catamarán',
                    icon: 'fa-star',
                    active: false,
                },
                {
                    nombre: 'Velero',
                    icon: 'fa-star',
                    active: false,
                },
                {
                    nombre: 'Semi-Rigida',
                    icon: 'fa-star',
                    active: false,
                },
                {
                    nombre: 'Lancha',
                    icon: 'fa-star',
                    active: false,
                },
            ],
            active_extra(index) {
                this.tipos.forEach((item, position) => {
                    if (position == index) {
                        this.tipos[position].active = true
                        this.form.tipo_barco = index + 1
                    } else {
                        this.tipos[position].active = false
                    }
                })
            },
        }
    }
</script>