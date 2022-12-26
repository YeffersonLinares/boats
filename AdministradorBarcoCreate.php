<div class="container-fluid" x-data="AdministradorBarcoCreate()">
    <div class="d-flex flex-column px-3 my-4">
        <div>
            <span class="color-dark-extras f-8 color-dark-blue">catalan</span>
            <span class="color-dark-extras f-8">/</span>
            <span class="color-dark-extras f-8 color-dark-blue">Creación de Barco</span>
            <span class="color-dark-extras f-8">/</span>
            <span class="color-dark-extras f-8 color-gray-dark">Descripción</span>
            <!-- <span class="color-dark-extras f-8">catalan</span> -->
        </div>
        <div class="d-flex flex-sm-row flex-column justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-chevron-left me-3 color-gray-dark"></i>
                <strong class="color-dark-extras">Descripción de la embarcación</strong>
            </div>
            <div class="d-flex">
                <button class="btn-blue-tareas">Siguiente <i class="fa-solid fa-circle-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="d-flex flex-column active-menu-barco" role="button">
                <template x-for="(i,index) in menu" :key="index">
                    <div class="d-flex align-items-center bg-gray border-menu-barco px-4 py-3" x-bind:class="[pantalla_create_barco == i.active ? 'active': '']"
                    @click="pantalla_create_barco = i.active">
                        <i class="fa-solid color-gray-dark me-3" :class="i.icon"></i>
                        <span class="color-dark-extras" x-text="i.text">General</span>
                    </div>
                </template>
            </div>
        </div>
        <div class="col-md-10">
            <div x-show="pantalla_create_barco == 'general'">
                <?php include_once 'AdministradorBarcoCreateGeneral.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'descripcion'">
                <?php include_once 'AdministradorBarcoCreateDescripcion.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'aspectosTecnicos'">
                <?php include_once 'AdministradorBarcoCreateAspectosTecnicos.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'fotos'">
                <?php include_once 'AdministradorBarcoCreateFotos.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'precios'">
                <?php include_once 'AdministradorBarcoCreatePrecios.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'documentacion'">
                <?php include_once 'AdministradorBarcoCreateDocumentacion.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'inactividad'">
                <?php include_once 'AdministradorBarcoCreateInactividad.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'equipos'">
                <?php include_once 'AdministradorBarcoCreateEquipos.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'promociones'">
                <?php include_once 'AdministradorBarcoCreatePromociones.php'; ?>
            </div>
            <div x-show="pantalla_create_barco == 'extras'">
                <?php include_once 'AdministradorBarcoCreateExtra.php'; ?>
            </div>
        </div>
    </div>
</div>
<script>
    function AdministradorBarcoCreate() {
        return {
            pantalla_create_barco: 'aspectosTecnicos',
            form: {
                fotos: [],
                nombre: 'Namaré',
                tipo_barco: '',
                ciudad: '',
                fabricante: '',
                puerto: '',
                modelo: '',
                matricula: '',
                titulacion_requerida: '',
                tipo_titulacion_requerida: '',
                horarios: [],
                inactividades: []
            },
            menu: [
                {
                    icon: 'fa-circle-check',
                    text: 'General',
                    active: 'general'
                },
                {
                    icon: 'fa-clipboard',
                    text: 'Descripción',
                    active: 'descripcion'
                },
                {
                    icon: 'fa-gears',
                    text: 'Aspectos Técnicos',
                    active: 'aspectosTecnicos'
                },
                {
                    icon: 'fa-image',
                    text: 'Fotos',
                    active: 'fotos'
                },
                {
                    icon: 'fa-money-bill',
                    text: 'Precios',
                    active: 'precios'
                },
                {
                    icon: 'fa-file',
                    text: 'Documentación',
                    active: 'documentacion'
                },
                {
                    icon: 'fa-wrench',
                    text: 'Inactividad',
                    active: 'inactividad'
                },
                {
                    icon: 'fa-group-arrows-rotate',
                    text: 'Equipos',
                    active: 'equipos'
                },
                {
                    icon: 'fa-tag',
                    text: 'Promociones',
                    active: 'promociones'
                },
                {
                    icon: 'fa-volleyball',
                    text: 'Extras',
                    active: 'extras'
                },
            ],
            init() {}
        }
    }
</script>