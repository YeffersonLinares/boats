<template x-if="pantalla=='reserva_usuario'">
    <div x-data="reserva_usuario()">

    <button @click="pantalla='BarcosReservaUsuario'"></button>
        <div class="container">
            <div class="container-fluid">

                <div class="w-100 text-center my-5">
                    <h3>¿Qué tipo de reserva deseas?</h3>
                </div>
                <div class="container d-flex justify-content-between flex-column flex-md-row">
                    <!-- <button class="w-50"> -->
                    <!-- <button class="btn btn-transparent"> -->
                    <div class="card w-card" id="por_barco">
                        <div class="card-body">
                            <img src="<?php echo imagen(1) ?>" alt="">
                            <h4 class="card-title">Reserva Por Barco</h4>
                            <p class="card-text">Determina el barco que más te gusta y te diremos las fechas y horarios
                                que
                                está
                                disponible.</p>
                            <a href="#" class="card-link"><b>Comenzar la reserva</b> <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- </button> -->
                    <!-- </button>
                    <button class="btn btn-transparent w-50"> -->
                    <div class="card w-card" id="por_fechas">
                        <div class="card-body">
                            <img src="<?php echo imagen(2) ?>" alt="">
                            <h4 class="card-title">Reserva Por Fecha</h4>
                            <p class="card-text">Dinos qué fecha o rango de fechas deseas navegar y te diremos que
                                embarcaciones tenemos disponibles.</p>
                            <a href="#" class="card-link"><b>Comenzar la reserva</b> <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- </button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    function reserva_usuario() {
        return {

        }
    }
</script>