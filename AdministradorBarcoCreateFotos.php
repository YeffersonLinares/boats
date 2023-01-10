<div x-data="AdministradorBarcoCreateFotos()">
    <div>
        <div>
            <button class="btn-blue-tareas" @click="store()">Siguiente <i class="fa-solid fa-circle-arrow-right"></i></button>
        </div>
        <div class="container-fluid">
            <p>Para la portada elige una fotografía que muestre el barco en su totalidad. Luego agregue más
                fotos de los detalles y del interior</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="my-4">
                    <div class="d-flex flex-column align-items-center border-dotted py-4" @click="image_portada()">
                        <button class="btn btn-transparent icon-gray"><i class="fas fa-address-card font-32"></i></button>
                        <span class="color-gray f-9">Agrega otra imagen aquí o</span>
                        <span class="color-blue f-9"><b>Descarga desde tu dispositivo</b></span>
                        <span class="icon-gray f-8">Máximo 1234 x 1234 px</span>
                    </div>
                    <input type="file" id="input-image-barco-create-fotos" x-ref="myFile" class="d-none" accept="image/*" @change="guardar_foto()">
                </div>
            </div>
            <template x-for="(i,index) in form.fotos">
                <div class="col-md-4 mt-1p49rem">
                    <img class="d-block w-100 height-12rem" :src="i.src" alt="">
                    <template x-if="!i.active">
                        <div class="d-flex justify-content-around align-items-center top-image w-25 bg-gray-light" @click="is_portada(index)">
                            <span role="button">Portada</span>
                            <input class="form-check-input border-dark-gray m-0" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" disabled style="opacity: 1">
                        </div>
                    </template>
                    <template x-if="i.active">
                        <span role="button" class="top-image">Portada</span>
                    </template>
                    <button class="button-image p-1" x-bind:class="[!i.active ? 'bottom-4p4rem' : '']" @click="delete_image(index)"><i class="fa-solid fa-trash-can"></i></button>
                    <!-- <span class="top-image">Portada</span>
                    <button class="button-image"><i class="fa-solid fa-trash-can"></i></button> -->
                </div>
            </template>
        </div>
    </div>
</div>
<script>
    function AdministradorBarcoCreateFotos() {
        return {
            init() {},
            image: '',
            image_portada() {
                $('#input-image-barco-create-fotos').click()
            },
            guardar_foto(type = 1) {
                let file = this.$refs.myFile.files[0];
                if (!file || file.type.indexOf('image/') === -1) return;

                let reader = new FileReader();

                reader.onload = e => {
                    let image = {
                        id: '',
                        src: e.target.result,
                        active: false,
                        deleted_at: false
                    }
                    this.form.fotos.push(image)
                    // this.imgsrc = e.target.result;
                }
                reader.readAsDataURL(file);
            },
            is_portada(index) {
                this.form.fotos.forEach((item, position) => {
                    if (position == index) {
                        this.form.fotos[position].active = true
                    } else {
                        this.form.fotos[position].active = false
                    }
                })
            },
            delete_image(index) {
                if (this.form.fotos[index].id) {
                    this.form.fotos[index].deleted_at = true
                } else {
                    this.form.fotos.splice(index, 1)
                }
                // console.log('this.form.images ==> ', this.form.images[index]);
            },
            store() {
                let url = this.base_url + '/administrador/store_fotos'
                axios.post(url, this.form.fotos).then(res => {
                    
                })
            }
        }
    }
</script>