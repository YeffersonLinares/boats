<div x-data="AdministradorBarcoCreateFotos()">
    <div>
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
                    <input type="file" id="input-image-fotos" class="d-none" accept="image/*">
                </div>
            </div>
            <template x-for="(i,index) in form.fotos">
                <div class="col-md-4 mt-1p49rem">
                    <img class="d-block w-100 height-11rem" src="../../../images/barco.jpg" alt="">
                    <span class="top-image">Portada</span>
                    <button class="button-image"><i class="fa-solid fa-trash-can"></i></button>
                </div>
            </template>
        </div>
    </div>
</div>
<script>
    function AdministradorBarcoCreateFotos() {
        return {
            init() {
            },
            image_portada() {
                $('#input-image-fotos').click()
            }
        }
    }
</script>
