<div x-data="Administrador">
    <div class="container-fluid">
        <div class="row mt-1">
            <nav class="admin-navs-tabs">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="width185px nav-link style-top-boa active" id="nav-inicio-tab" data-bs-toggle="tab" data-bs-target="#nav-inicio" type="button" role="tab" aria-controls="nav-inicio" aria-selected="true">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-house-user btn-icon-menu"></i>
                            <span class="lang" lang="Home">Inicio</span>
                        </div>
                    </button>
                    <button class="width185px nav-link style-top-boa" id="nav-reservas-tab" data-bs-toggle="tab" data-bs-target="#nav-reservas" type="button" role="tab" aria-controls="nav-reservas" aria-selected="false">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-sailboat btn-icon-menu"></i>
                            <span class="lang" lang="Bookings"> Reservas </span>
                        </div>
                    </button>
                    <button class="width185px nav-link style-top-boa" id="nav-barcos-tab" data-bs-toggle="tab" data-bs-target="#nav-barcos" type="button" role="tab" aria-controls="nav-barcos" aria-selected="false">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-ship btn-icon-menu"></i>
                            <span class="lang" lang="Boats"> Barcos </span>
                        </div>
                    </button>
                    <button class="width185px nav-link style-top-boa" id="nav-extras-tab" data-bs-toggle="tab" data-bs-target="#nav-extras" type="button" role="tab" aria-controls="nav-extras" aria-selected="false">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-volleyball btn-icon-menu"></i>
                            <span class="lang" lang="Extras"> Extras </span>
                        </div>
                    </button>
                    <button class="width185px nav-link style-top-boa" id="nav-clientes-tab" data-bs-toggle="tab" data-bs-target="#nav-clientes" type="button" role="tab" aria-controls="nav-clientes" aria-selected="false">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user-plus btn-icon-menu"></i>
                            <span class="lang" lang="Customers">Clientes</span>
                        </div>
                    </button>
                    <button class="width185px nav-link style-top-boa" id="nav-empresa-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa" type="button" role="tab" aria-controls="nav-empresa" aria-selected="false">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-building btn-icon-menu"></i>
                            <span class="lang" lang="Company">
                                Empresa
                            </span>
                        </div>
                    </button>
                    <button class="width185px nav-link style-top-boa" id="nav-tareas-tab" data-bs-toggle="tab" data-bs-target="#nav-tareas" type="button" role="tab" aria-controls="nav-tareas" aria-selected="false">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-clipboard-check btn-icon-menu"></i>
                            <span class="lang" lang="Tasks">
                                Tareas
                            </span>
                        </div>
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-empresa-tab">
                    <?php #include_once "Empresa.php"; 
                    ?>
                </div>
                <div class="tab-pane fade show active" id="nav-inicio" role="tabpanel" aria-labelledby="nav-inicio-tab">
                    <?php include_once "AdminitradorInicio.html";
                    ?>
                </div>
                <div class="tab-pane fade" id="nav-reservas" role="tabpanel" aria-labelledby="nav-reservas-tab">
                    <?php include_once "Reserva_mes.html"; ?>
                </div>
                <div class="tab-pane fade" id="nav-barcos" role="tabpanel" aria-labelledby="nav-barcos-tab">
                    <!-- Barcos -->
                    <?php include_once 'AdministradorBarcoIndex.php'; ?>
                </div>
                <div class="tab-pane fade" id="nav-extras" role="tabpanel" aria-labelledby="nav-extras-tab">
                    <?php include_once 'AdministradorExtrasIndex.php' ?>
                </div>
                <div class="tab-pane fade" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">
                    <?php include_once "AdministradorClientesIndex.php" ?>
                </div>
                <div class="tab-pane fade" id="nav-tareas" role="tabpanel" aria-labelledby="nav-tareas-tab">
                    <?php include_once "AdministradorTareasIndex.php" ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function Administrador() {
        return {
            menu: [{
                id: 'nav-inicio-tab',
                data_target: '#nav-inicio',
                aria_controls: 'nav-inicio'
            }],
            init() {
                $('#nav-barcos-tab').click()
                // $('#nav-extras-tab').click()
                // $('#nav-clientes-tab').click()
                this.lang('menu')
            },
        }
    }
</script>

<style>
    .style-top-boa {
        background-color: #F5F5F5 !important;
        color: #464646 !important;
        border: 1px solid #B5B5B5 !important;
        border-radius: 8px 8px 0 0 !important;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        border-bottom: none !important;
    }

    .width185px {
        width: 209px;
    }
</style>