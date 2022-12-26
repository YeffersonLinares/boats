<div x-data="AdministradorBarcoCreateInactividad()">
    <div class="w-100 mb-3">
        <strong class="color-dark-extras">Inactividad del Barco</strong>
    </div>
    <div class="w-100 mb-4">
        <span class="color-dark-extras">Indica las fechas en las que tu barco NO estará disponible *</span>
    </div>
    <div class="row mb-5">
        <div class="col-6 col-lg-6 col-xl-3 mb-3">
            <label class="color-dark-extras" for="">Del</label>
            <input class="form-control" type="date" x-model="inactividad.del">
        </div>
        <div class="col-6 col-lg-6 col-xl-3 mb-3">
            <label class="color-dark-extras" for="">Al</label>
            <input class="form-control" type="date" x-model="inactividad.al">
        </div>
        <div class="col-lg-8 col-xl-3 mb-3">
            <label class="color-dark-extras" for="">Motivo</label>
            <input class="form-control" type="text" placeholder="Describir" x-model="inactividad.motivo">
        </div>
        <div class="col-lg-4 col-xl-3 d-flex align-items-center">
            <button class="btn-add-provision mt-1" @click="guardar_inactividad()">Guardar Fecha</button>
        </div>
    </div>
    <div class="d-flex flex-column-reverse">
        <div>
            <template x-for="(i,index) in form.inactividades">
                <template x-if="!i.deleted_at">
                    <div class="d-flex justify-content-between py-4 px-3" x-bind:class="index%2==0 ? 'bg-gray' : ''">
                        <div class="d-flex flex-column">
                            <div class="mb-3 mb-lg-1">
                                <span class="color-dark-extras me-2">Del</span>
                                <span class="color-dark-blue me-2" x-text="i.del">25/08/2023</span>
                                <span class="color-dark-extras me-2">Al</span>
                                <span class="color-dark-blue me-2" x-text="i.al">5/09/2023</span>
                                <span class="color-dark-extras me-2">La embarcación</span>
                                <span class="color-dark-blue me-2" x-text="form.nombre">[nombre_de_embarcación]</span>
                            </div>
                            <div>
                                <span class="color-dark-extras me-2">NO estará disponible</span>
                                <span class="color-dark-extras me-2">por motivos</span>
                                <span class="color-dark-blue me-2" x-text="i.motivo">Professionally promote low-risk high-yield human
                                    capital without leading-edge
                                    supply.</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-transparent color-gray-dark me-3"><i class="fa-solid fa-pen-to-square fa-lg fs-11" @click="llenarCampos(i, index)"></i></button>
                            <button class="btn btn-transparent color-dark-red" @click="eliminar_inactividad(index)"><i class="fa-solid fa-trash-can fa-lg fs-11"></i></button>
                        </div>
                    </div>
                </template>
            </template>
        </div>
    </div>
</div>
<script>
    function AdministradorBarcoCreateInactividad() {
        return {
            is_edit: false,
            pos: null,
            inactividad: {
                id: '',
                del: '',
                al: '',
                motivo: '',
                bote_id: 1,
                deleted_at: ''
            },
            init() {},
            guardar_inactividad() {
                if(this.inactividad.del >= this.inactividad.al) {
                    Swal.fire('', 'La fecha inicial debe ser menor a la fecha final', 'error')
                    return
                }

                if (!this.validarCampos()) return
                let formulario = {}
                for (const key in this.inactividad) formulario[key] = this.inactividad[key]

                if (!this.is_edit) this.form.inactividades.push(formulario)
                else this.form.inactividades[this.pos] = formulario

                this.is_edit = false
                this.limpiarCampos()
            },
            limpiarCampos() {
                for (const key in this.inactividad) {
                    this.inactividad[key] = ''
                }
            },
            llenarCampos(i, index) {
                this.is_edit = true
                this.pos = index
                for (const key in i) {
                    this.inactividad[key] = i[key]
                }
            },
            validarCampos() {
                this.inactividad.bote_id = 1
                for (const key in this.inactividad) {
                    if (key != 'deleted_at' && key != 'id') {
                        if (!this.inactividad[key]) {
                            Swal.fire('', 'Completa todos los campos', 'error')
                            return false
                        }
                    }
                }
                return true
            },
            eliminar_inactividad(index) {
                if (!this.inactividad.id) {
                    this.form.inactividades.splice(index, 1)
                } else {
                    this.form.inactividades[index].deleted_at = true
                }
            }
        }
    }
</script>