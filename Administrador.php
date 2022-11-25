<div x-data="Administrador">
    <div class="container-fluid">
        <div class="row mt-1">
            <nav class="admin-navs-tabs">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="width185px nav-link active" id="nav-inicio-tab" data-bs-toggle="tab" data-bs-target="#nav-inicio" type="button" role="tab" aria-controls="nav-inicio" aria-selected="true"> <span class="lang" lang="Home">Inicio</span></button>
                    <button class="width185px nav-link" id="nav-reservas-tab" data-bs-toggle="tab" data-bs-target="#nav-reservas" type="button" role="tab" aria-controls="nav-reservas" aria-selected="false"> <span class="lang" lang="Bookings"> Reservas </span></button>
                    <button class="width185px nav-link" id="nav-barcos-tab" data-bs-toggle="tab" data-bs-target="#nav-barcos" type="button" role="tab" aria-controls="nav-barcos" aria-selected="false"> <span class="lang" lang="Boats"> Barcos</button>
                    <button class="width185px nav-link" id="nav-extras-tab" data-bs-toggle="tab" data-bs-target="#nav-extras" type="button" role="tab" aria-controls="nav-extras" aria-selected="false"> <span class="lang" lang="Extras"> Extras </span> </button>
                    <button class="width185px nav-link" id="nav-clientes-tab" data-bs-toggle="tab" data-bs-target="#nav-clientes" type="button" role="tab" aria-controls="nav-clientes" aria-selected="false"><span class="lang" lang="Customers">Clientes</span></button>
                    <button class="width185px nav-link" id="nav-empresa-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa" type="button" role="tab" aria-controls="nav-empresa" aria-selected="false"> <span class="lang" lang="Company">Empresa</span> </button>
                    <button class="width185px nav-link" id="nav-tareas-tab" data-bs-toggle="tab" data-bs-target="#nav-tareas" type="button" role="tab" aria-controls="nav-tareas" aria-selected="false"> <span class="lang" lang="Tasks">Tareas</span></button>
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
                <div class="tab-pane fade" id="nav-barcos" role="tabpanel" aria-labelledby="nav-barcos-tab">Barcos</div>
                <div class="tab-pane fade" id="nav-extras" role="tabpanel" aria-labelledby="nav-extras-tab">Extras</div>
                <div class="tab-pane fade" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">
                    <?php include_once "AdministradorClientesIndex.php" ?>
                    <?php #include_once "AdministradorClientesCreate.html" ?>
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
        init() {
            $('#nav-clientes-tab').click()
            this.lang('menu')
        }
    }
}
</script>