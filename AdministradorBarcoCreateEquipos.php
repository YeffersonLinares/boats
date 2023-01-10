<div x-data="AdministradorBarcoCreateEquipos()">
    <div class="row">
        <div class="col-md-8">
            <strong class="color-dark-extras">Elementos del barco que requieren verificación estando
                presente</strong>
            <div class="row">
                <div class="col-md-4">
                    <label class="color-dark-extras" for="">Titulo de Revisión</label>
                    <input class="form-control" type="text" x-model="equipo.titulo">
                </div>
                <div class="col-md-5">
                    <label class="color-dark-extras" for="">Se Necesita</label>
                    <select class="form-select" name="" id="" x-model="equipo.se_necesita">
                        <option value=""> Seleccione </option>
                        <option value="2"> Enseñar su funcionamiento </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="color-dark-extras" for="">Precio estimado</label>
                    <input class="form-control" type="text" x-model="equipo.precio_estimado">
                </div>
                <div class="col-md-9">
                    <label class="color-dark-extras" for="">Observación</label>
                    <input class="form-control" type="text" x-model="equipo.observacion">
                </div>
                <div class="col-12">
                    <label class="color-dark-extras" for="">Verificar en</label>
                    <div class="d-flex">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" x-model="equipo.check_in">
                            <label class="form-check-label color-dark-extras" for="inlineCheckbox1">
                                <i class="fa-solid fa-ship"></i>
                                <span>Check in</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input color-dark-extras" type="checkbox" id="inlineCheckbox2" value="option2" x-model="equipo.check_out">
                            <label class="form-check-label color-dark-extras" for="inlineCheckbox2">
                                <i class="fa-solid fa-flag-checkered"></i>
                                Check out
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="my-4">
                <div class="d-flex flex-column align-items-center border-dotted py-4" @click="open_image()">
                    <button class="btn btn-transparent icon-gray"><i class="fas fa-address-card font-32"></i></button>
                    <span class="color-gray f-9">Agrega otra imagen aquí o</span>
                    <span class="color-blue f-9"><b>Descarga desde tu dispositivo</b></span>
                    <span class="icon-gray f-8">Máximo 1234 x 1234 px</span>
                </div>
                <input class="d-none" type="file" id="input-image-barco-create-equipos" accept="image/*" @change="guardar_foto()" x-ref="myFileEquipo">
            </div>
            <template x-if="equipo.imagen">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="color-dark-extras f-9">Última foto subida - 12/21/22 14:43</span>
                    <div>
                        <template x-if="equipo.imagen">
                            <img role="button" class="image_gasto_equipo me-3" :src="equipo.imagen" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="preview_imagen_modal(equipo.imagen)" />
                        </template>
                        <button class="btn-icon-red" @click="equipo.imagen = ''"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>
            </template>
            <div class="d-flex justify-content-end mt-4">
                <button class="btn-tareas" @click="agregar_revision()">Agregar Revisión</button>
            </div>
        </div>
    </div>
    <div class="container-fluid table-responsive">
        <table class="table table-striped text-center d-print-table align-middle">
            <thead>
                <tr>
                    <th class="color-dark-extras" scope="col">Foto</th>
                    <th class="color-dark-extras" scope="col">Titulo de Revisión</th>
                    <th class="color-dark-extras" scope="col">Se necesita</th>
                    <th class="color-dark-extras" scope="col">Verificar en</th>
                    <th class="color-dark-extras" scope="col">Precio</th>
                    <th class="color-dark-extras w-50" scope="col">Observación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(i, index) in form.equipos">
                    <template x-if="!i.deleted_at">
                        <tr>
                            <td scope="row">
                                <div>
                                    <img role="button" class="table-size-image" :src="i.imagen ? i.imagen : 'images/image-holder.jpeg'" alt="" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="preview_imagen_modal(i.imagen)">
                                </div>
                            </td>
                            <td> <strong class="color-dark-extras" x-text="i.titulo">Élice de popa</strong></td>
                            <td class="color-blue" x-text="i.se_necesita">Mostrar su estado</td>
                            <td>
                                <div class="d-flex color-dark-extras">
                                    <div x-show="i.check_out" class="me-3"> <i class="fa-solid fa-flag-checkered"></i> </div>
                                    <div x-show="i.check_in"> <i class="fa-solid fa-ship"></i> </div>
                                </div>
                            </td>
                            <td class="color-blue" x-text="i.precio_estimado + '€'">29 €</td>
                            <td class="color-dark-extras" x-text="i.observacion"></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn-icon-gray-dark" @click="editar_revision(index)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-icon-red" @click="eliminar_revision(index)"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </template>
            </tbody>
        </table>
    </div>
    <div class="d-flex flex-column">
        <strong class="my-4">Equipos</strong>
        <span class="mb-4" x-text="'Indica el equipamiento que posee tu embarcación ' +form.nombre + '*'">*</span>
        <div class="row">
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>Ningún equipamiento</strong>
                <div class="d-flex">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Ninguno en especial</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>Exterior</strong>
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Toldo
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Ducha exterior
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Mesa comedor
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Sistema estéreo
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Cubierta de teca
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Salarium en proa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Salarium en popa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Plataforma de baño
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Escalera de baño
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>Comfort</strong>
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Agua caliente
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Desalinizadora
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Aire acondicionado
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Ventiladores
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Calefacción
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            WC eléctrico
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Ropa de cama
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Toallas de baño
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Toallas de playa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Puerto USB Televisión
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>De Navegación</strong>
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Anexo
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Motor de anexo
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Propulsor de proa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Molinete eléctrico
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Piloto automático
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            GPS
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Sonda
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            VHF
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Teléfono satelital
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Guías y cartas
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>Ocio</strong>
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Tabla de Paddle
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Kayak
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Gafas y tubos
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Equipos de pesca
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Equipos de buceo
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Seabob
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Bicicleta
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Patinente eléctrico
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Dron
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Cámara
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>Deportes Acuáticos</strong>
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Esquí acuático
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Mono Esquí
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Wakeboard
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Donut
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Plátano hinchable
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Kneeboard
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>Cocina</strong>
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Frigorífico
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Congelador
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Horno/cocina
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Parrilla/barbacoa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Microondas
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Máquina de café
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Máquina de hielo
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Congelador
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex flex-column">
                <strong>Energía eléctrica</strong>
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Generador
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Inversor
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Toma corriente (220 V)
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-center">
                    <template x-if="route_preview_imagen">
                        <img :src="route_preview_imagen" style="width: 100%; height: 100%;" />
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function AdministradorBarcoCreateEquipos() {
        return {
            is_edit: false,
            pos: null,
            route_preview_imagen: '',
            equipo: {
                id: '',
                titulo: '',
                se_necesita: '',
                precio_estimado: '',
                observacion: '',
                check_in: false,
                check_out: false,
                imagen: '',
                fecha_imagen: '',
                bote_id: 1,
                deleted_at: ''
            },
            init() {},
            open_image() {
                $('#input-image-barco-create-equipos').click()
            },
            agregar_revision() {
                if (!this.validarCampos()) return
                let formulario = {}
                for (const key in this.equipo) {
                    formulario[key] = this.equipo[key]
                }

                if (!this.is_edit) this.form.equipos.push(formulario)
                else this.form.equipos[this.pos] = formulario

                this.is_edit = false
                this.limpiarCampos()
            },
            guardar_foto() {
                let file = this.$refs.myFileEquipo.files[0];
                if (!file || file.type.indexOf('image/') === -1) return;

                let reader = new FileReader();

                reader.onload = e => {
                    this.equipo.imagen = e.target.result
                }
                reader.readAsDataURL(file);
            },
            limpiarCampos() {
                for (const key in this.equipo) this.equipo[key] = ''

                this.equipo.check_in = false
                this.equipo.check_out = false
                this.equipo.bote_id = 1
            },
            validarCampos() {
                this.equipo.bote_id = 1
                for (const key in this.equipo) {
                    if (key != 'deleted_at' && key != 'id' && key != 'check_in' && key != 'check_out' && key != 'imagen' && key != 'fecha_imagen') {
                        if (!this.equipo[key]) {
                            Swal.fire('', 'Completa todos los campos obligatorios', 'error')
                            return false
                        }
                    }
                }
                return true
            },
            eliminar_revision(index) {
                if (!this.equipo.id) {
                    this.form.equipos.splice(index, 1)
                } else {
                    this.form.equipos[index].deleted_at = true
                }
            },
            editar_revision(index) {
                this.is_edit = true
                this.pos = index
                let equipo_edit = this.form.equipos[index]
                for (const key in equipo_edit) {
                    this.equipo[key] = equipo_edit[key]
                }
            },
            preview_imagen_modal(route) {
                this.route_preview_imagen = route
            }
        }
    }
</script>