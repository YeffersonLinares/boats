<link rel="stylesheet" href="style.css">
<div id="app" x-data="app">
    <template x-if="pantalla == 1">
        <div class="container-fluid px-md-5">
            <div class="text-center mt-3">
                <h6 class="color-dark-blue"> <b> Empresa </b> </h6>
            </div>
        
            <hr class="my-3">
        
            <div class="d-flex justify-content-between w-100 mb-5">
                <h5> <strong> Bienvenido Admin #12244 a la sección de Empresa </strong> </h5>
                <button class="btn-info-empresa" data-bs-toggle="modal" data-bs-target="#modal_detalles_empresa">
                    <strong> Info Empresa & Adherir Personal </strong> 
                </button>
                <button>
                    <strong> Revendedores </strong> 
                </button>
            </div>
        
            <div class="d-flex align-items-center">
                <span class="me-3"> Ver mes en curso | Ver Temporada | Ver desde </span>
                <input class="form-control me-3 color-blue" style="width: auto;" type="date">
                <span class="me-3"> al </span>
                <input class="form-control me-3 color-blue" style="width: auto;" type="date">
                <button class="btn-info-empresa"> <strong> Ver Resumen </strong> </button>
            </div>
        
            <div class="d-flex mt-3">
                <h4 class="me-3"> <strong class="color-gray-dark"> Resumen de: </strong> </h4>
                <h4 class="me-3"> <strong class="color-dark-blue"> 10/04/2022 </strong> </h4>
                <h4 class="me-3"> <strong class="color-gray-dark"> al: </strong> </h4>
                <h4 class="me-3"> <strong class="color-dark-blue"> 10/07/2022 </strong> </h4>
            </div>
            <hr>
        
            <div class="mt-4">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="container-fluid table-responsive">
                            <h4> <strong class="color-dark-blue"> Ingresos </strong> </h4>
                            <table class="table table-striped color-gray">
                                <thead>
                                    <th> Revendedores </th>
                                    <th> Alquileres </th>
                                    <th> Pagado </th>
                                    <th> Ingreso </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
        
                        <div class="container-fluid table-responsive">
                            <h4> <strong class="color-dark-blue"> Gastos </strong> </h4>
                            <table class="table table-striped color-gray mt-3">
                                <thead>
                                    <th> Revendedores </th>
                                    <th> Alquileres </th>
                                    <th> Pagado </th>
                                    <th> Gastos </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                    <tr>
                                        <td> Click & Boat </td>
                                        <td> 8 </td>
                                        <td> Click & Boat </td>
                                        <td> 352€ </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-5 bg-gray pt-4">
                        <div class="container-fluid table-responsive">
                            <h4> <strong class="color-dark-blue"> Proveedores de Embarcaciones </strong> </h4>
                            <table class="table table-striped color-gray">
                                <thead>
                                    <th> Alquileres </th>
                                    <th> Barcos </th>
                                    <th> Ingreso </th>
                                    <th> Beneficio </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Propios </td>
                                        <td> 30 </td>
                                        <td> 6.660€ </td>
                                        <td> 6.660€ </td>
                                    </tr>
                                    <tr>
                                        <td> Propios </td>
                                        <td> 30 </td>
                                        <td> 6.660€ </td>
                                        <td> 6.660€ </td>
                                    </tr>
                                    <tr>
                                        <td> Propios </td>
                                        <td> 30 </td>
                                        <td> 6.660€ </td>
                                        <td> 6.660€ </td>
                                    </tr>
                                    <tr>
                                        <td> <strong> Total </strong> </td>
                                        <td> <strong> 90 </strong> </td>
                                        <td> <strong> €19.240 </strong> </td>
                                        <td> <strong> 7.700€ </strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="button-dark-blue p-2 f-9 d-flex align-items-center ms-4 my-3" @click="change_pantalla(2)">
                            <span class="me-2"> Ver Detalle de Proveedores </span>
                            <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                        </button>
        
                        <div class="container-fluid table-responsive">
                            <h4> <strong class="color-dark-blue"> Pautas Publicitarias </strong> </h4>
                            <table class="table table-striped color-gray">
                                <thead>
                                    <th> Inversión </th>
                                    <th> Impresos </th>
                                    <th> Pautas en medios </th>
                                    <th> Otros </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Propios</td>
                                        <td>30</td>
                                        <td>6.600€</td>
                                        <td>6.600€</td>
                                    </tr>
                                    <tr>
                                        <td>Propios</td>
                                        <td>30</td>
                                        <td>6.600€</td>
                                        <td>6.600€</td>
                                    </tr>
                                    <tr>
                                        <td>Propios</td>
                                        <td>30</td>
                                        <td>6.600€</td>
                                        <td>6.600€</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="container-fluid table-responsive">
                            <div class="w-100">
                                <h4> <strong class="color-dark-blue"> Estadísticas de ganancias de </strong> </h4>
                                <h6> 10/04/2022 al 10/07/2022 </h6>
                                <div class="border" style="width: 100%; height: 10rem;">
        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="container-fluid table-responsive">
                <h4> <strong class="color-dark-blue"> Resumen de Saldos </strong> </h4>
                <table class="table table-bordered table-striped color-gray">
                    <thead>
                        <th></th>
                        <th> Efectivo </th>
                        <th> Transferencia </th>
                        <th> Bizum </th>
                        <th> Tarjeta </th>
                        <th> Paypal </th>
                        <th> Proveedores </th>
                        <th> Publicidades </th>
                        <th> Otros </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ingresos</td>
                            <td>500</td>
                            <td>280</td>
                            <td>100</td>
                            <td>-171</td>
                            <td>-279</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Gastos</td>
                            <td>500</td>
                            <td>280</td>
                            <td>100</td>
                            <td>-171</td>
                            <td>-279</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td> <strong> Total </strong> </td>
                            <td>500</td>
                            <td>280</td>
                            <td>100</td>
                            <td>-171</td>
                            <td>-279</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex align-items-end">
                    <div class="me-4">
                        <strong class="color-gray"> Ingreso promedio: </strong>
                        <strong class="color-blue"> 95€ </strong>
                    </div>
                    <div>
                        <strong class="color-gray"> Días Seleccionados: </strong>
                        <strong class="color-blue"> 35 </strong>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn-declaracion">
                    <span class="me-2"> Generar Declaración de Resumen </span>
                    <i class="fa-solid fa-file-pdf"></i>
                </button>
            </div>
        </div>
    </template>

    <template x-if="pantalla == 2">
        <div class="container-fluid px-md-5 table-border-none">
                <div class="text-center mt-3">
                    <h6 class="color-dark-blue"> <b> Empresa </b> </h6>
                </div>
    
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn-atras" @click="change_pantalla(1)">Atrás</button>
                    <h4><strong> Proveedores de Embarcaciones </strong></h4>
                    <div></div>
                </div>
    
                <div class="d-flex mt-5">
                    <h4 class="me-3"> <strong class="color-gray-dark"> Resumen de: </strong> </h4>
                    <h4 class="me-3"> <strong class="color-dark-blue"> 10/04/2022 </strong> </h4>
                    <h4 class="me-3"> <strong class="color-gray-dark"> al: </strong> </h4>
                    <h4 class="me-3"> <strong class="color-dark-blue"> 10/07/2022 </strong> </h4>
                </div>
    
                <hr class="my-3">
    
                <div class="container-fluid table-responsive">
                    <table class="table table-striped color-dark-extras">
                        <thead>
                            <th> Barco </th>
                            <th> Fecha </th>
                            <th> Vendedor </th>
                            <th> Ingreso </th>
                            <th> Pago al Revendedor </th>
                            <th> Pagos Extra </th>
                            <th> Ingresos Extra </th>
                            <th> Ingreso por Gestión </th>
                            <th> Pagar al Dueño del barco </th>
                            <th> Beneficio </th>
                            <th> Método </th>
                            <th style="border-right: 0 !important;"> Estado </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td> Calla 450 </td>
                                <td> 12/05 </td>
                                <td> 175€ </td>
                                <td> 175€ </td>
                                <td> 35€ </td>
                                <td> 15€ </td>
                                <td> 15€ </td>
                                <td> 35€ </td>
                                <td> <span class="color-dark-blue"> 90€ </span> </td>
                                <td> <span class="color-blue"> 100€ </span> </td>
                                <td> Transferencia </td>
                                <td style="border-right: 0 !important;"> <span class="color-red"> Pendiente </span> </td>
                            </tr>
                            <tr>
                                <td> <strong> Total </strong> </td>
                                <td></td>
                                <td></td>
                                <td> <strong> 175€ </strong> </td>
                                <td> <strong> 35€ </strong> </td>
                                <td> <strong> 15€ </strong> </td>
                                <td> <strong> 15€ </strong> </td>
                                <td> <strong> 35€ </strong> </td>
                                <td> <strong class="color-dark-blue"> 90€ </strong> </td>
                                <td> <strong> <span class="color-blue"> 100€ </span>  </strong> </td>
                                <td></td>
                                <td style="border-right: 0 !important;"> <span class="color-green"> Pagado </span> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                <hr class="my-3">
    
                <h4 class="ms-3"> <strong class="color-dark-blue"> Pagos Pendientes </strong> </h4>
                <div class="container-fluid table-responsive">
                    <table class="table table-striped color-dark-extras w-70">
                        <thead>
                            <th> Estado </th>
                            <th> Efectivo </th>
                            <th> Tarjetas </th>
                            <th> Transferencia </th>
                            <th> Paypal </th>
                            <th style="border-right: 0 !important;"> Total </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <span class="color-dark-red"> Pendiente de pago </span> </td>
                                <td> 300€ </td>
                                <td> 200€ </td>
                                <td> 550€ </td>
                                <td> 550€ </td>
                                <td style="border-right: 0 !important;"> <strong class="color-dark-red"> 550€ </strong> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                <hr class="my-3">
    
                <h4 class="ms-3"> <strong class="color-dark-blue"> Beneficios </strong> </h4>
                <div class="container-fluid table-responsive">
                    <table class="table table-striped color-dark-extras w-70">
                        <thead>
                            <th> Estado </th>
                            <th> Efectivo </th>
                            <th> Tarjetas </th>
                            <th> Transferencia </th>
                            <th> Paypal </th>
                            <th style="border-right: 0 !important;"> Total </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <strong class="color-blue"> Beneficio </strong> </td>
                                <td> 300€ </td>
                                <td> 200€ </td>
                                <td> 550€ </td>
                                <td> 550€ </td>
                                <td style="border-right: 0 !important;"> <strong class="color-blue"> 550€ </strong> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                <hr class="my-3">
    
            </div>
    </template>

    <div class="modal fade" id="modal_detalles_empresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container-fluid border">
                        <h4 class="color-dark-blue"> <b> Información de empresa </b> </h4>
                        <div class="row p-4">
                            <div class="col-12 col-lg-5">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <span>Nombre de la empresa/Razón social</span>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <span>Responsable de la empresa</span>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <span>Teléfono</span>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <span>Email</span>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <span>Logo de la empresa</span>
                                        <input class="form-control" type="file">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <span>Zona horaria</span>
                                        <select class="form-select">
                                            <option value="">GTM+1 España - Egipto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <strong>Staff:</strong>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex justify-content-between border-bottom pb-3 mt-3">
                                        <div class="d-flex">
                                            <span class="me-4"> Carlos Martiv Pavon Cian </span>
                                            <div>
                                                <strong class="me-3"> Formato de Cobro </strong>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn-icon-red"> <i class="fa-solid fa-trash-can"></i> </button>
                                            <button class="btn-icon-gray"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-3 mt-3">
                                        <div class="d-flex">
                                            <span class="me-4"> Carlos Martiv Pavon Cian </span>
                                            <div>
                                                <strong class="me-3"> Formato de Cobro </strong>
                                                <button class="btn-icon-gray"><i class="fa-solid fa-phone"></i></button>
                                                <button class="btn-icon-gray"><i class="fa-solid fa-envelope"></i></button>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn-icon-red"> <i class="fa-solid fa-trash-can"></i> </button>
                                            <button class="btn-icon-gray"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-3 mt-3">
                                        <div class="d-flex">
                                            <span class="me-4"> Carlos Martiv Pavon Cian </span>
                                            <div>
                                                <strong class="me-3"> Formato de Cobro </strong>
                                                <button class="btn-icon-gray"><i class="fa-solid fa-phone"></i></button>
                                                <button class="btn-icon-gray"><i class="fa-solid fa-envelope"></i></button>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn-icon-red"> <i class="fa-solid fa-trash-can"></i> </button>
                                            <button class="btn-icon-gray"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-3 mt-3">
                                        <div class="d-flex">
                                            <span class="me-4"> Carlos Martiv Pavon Cian </span>
                                            <div>
                                                <strong class="me-3"> Formato de Cobro </strong>
                                                <button class="btn-icon-gray"><i class="fa-solid fa-phone"></i></button>
                                                <button class="btn-icon-gray"><i class="fa-solid fa-envelope"></i></button>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn-icon-red"> <i class="fa-solid fa-trash-can"></i> </button>
                                            <button class="btn-icon-gray"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                        </div>
                                    </div>
                                </div>
            
                                <h5> <strong> Adherir Staff </strong> </h5>
                                <div class="bg-gray p-2 p-md-3">
                                    <div class="row px-3">
                                        <div class="col-12 mb-3">
                                            <label for="">Nombre de persona</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-12 px-2 mb-3">
                                            <label for="">Cargo</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 px-2 mb-3">
                                            <label for="">Email</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 px-2 mb-3">
                                            <label for="">Teléfono</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 px-2 mb-3">
                                            <label for="">Usuario</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 px-2 mb-3">
                                            <label for="">Contraseña</label>
                                            <input class="form-control" type="password">
                                        </div>
                                        <div class="col-12 mb-4">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                  Enviar un email a las persona notificando su usuario y contraseña?
                                                </label>
                                              </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button class="btn-general-gray"> Adherir Personal </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn-blue-general"><span class="me-2"> Guardar </span> <i class="fa-solid fa-floppy-disk"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
</div>

<script>
    function app() {
        return {
            hello: 'Hello bussines',
            pantalla: 1,
            change_pantalla(pantalla) {
                this.pantalla = pantalla
                console.log('this.pantalla ==> ', this.pantalla);
            }
        }
    }
</script>

<style>
    .btn-info-empresa {
        background-color: #F5F5F5;
        color: #464646;
        border: 1px solid #B5B5B5;
        padding: .3rem 1.5rem .3rem 1.5rem;
        border-radius: 10px;
    }

    .button-dark-blue {
        border: 1px solid #1D6CAF;
        background-color: #1D6CAF;
        border-radius: 8px;
        color: white;
    }

    .btn-declaracion {
        background-color: #31A6FB;
        color: white;
        border: 1px solid #31A6FB;
        border-radius: 10px;
        padding: .3rem 1rem .3rem 1rem;
        display: flex;
        align-items: center;
    }

    .table-border-none td, .table-border-none th{
        border-right: 1px solid #D8D8D8;
        text-align: center;
    }

    tbody, td, tfoot, th, thead, tr {
        border-style: none;
    }

    .table-border-none hr {
        opacity: .2;
    }

    .w-70 {
       width: 70%;
    }
    .color-green {
    color: #00C13B;
}

.bg-green {
    background-color: #00C13B;
}

</style>