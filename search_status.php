<?php
require_once 'views/parte_superior.php';
?>
<!-- Start content-wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!--End Row-->
                        <h4 class="card-title">Busqueda de estatus 503</h4>
                        <!-- Formulario 503 -->
                        <nav class="row p-4 col col-lg-12" id="search503">
                            <form id="formulario503" action="" method="POST">
                                <div class="row ">
                                    <div class="col col-4">
                                        <div class="row">
                                            <div class="col col-6">
                                                <label for="">Fecha de inicial</label>
                                                <input type="date" name="f_inicio" id="f_inicio" class="text-dark">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <label for="">Fecha de termino</label>
                                                <input type="date" name="f_termino" id="f_termino" class="text-dark">
                                            </div>
                                        </div>
                                    </div>
                                            
                                    <div class="col col-4">
                                        <div class="row contenedor-otros">
                                                <!-- <label>
                                                    <input type="checkbox" value="5" name="vici[]">5
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="6" name="vici[]">6
                                                </label> -->
                                                <label class="uno">
                                                    <input type="checkbox" value="8" name="vici[]">LEC
                                                </label>
                                                <!-- <label>
                                                    <input type="checkbox" value="9" name="vici[]">9
                                                </label> -->
                                                <label>
                                                    <input type="checkbox" value="11" name="vici[]">Consumo
                                                </label>
                                                <!-- <label>
                                                    <input type="checkbox" value="14" name="vici[]">14
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="15" name="vici[]">15
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="22" name="vici[]">22
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="24" name="vici[]">24
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="27" name="vici[]">27
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="28" name="vici[]">28
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="29" name="vici[]">29
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="30" name="vici[]">30
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="34" name="vici[]">34
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="35" name="vici[]">35
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="36" name="vici[]">36
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="37" name="vici[]">37
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="38" name="vici[]">38
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="39" name="vici[]">39
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="40" name="vici[]">40
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="41" name="vici[]">41
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="42" name="vici[]">42
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="43" name="vici[]">43
                                                </label> -->
                                                <label>
                                                    <input type="checkbox" value="44" name="vici[]">GA
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="45" name="vici[]">BT
                                                </label>
                                                <!-- <label>
                                                    <input type="checkbox" value="46" name="vici[]">46
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="47" name="vici[]">47
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="48" name="vici[]">48
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="57" name="vici[]">57
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="60" name="vici[]">60
                                                </label> -->
                                                <label>
                                                    <input type="checkbox" value="201" name="vici[]">PPM
                                                </label>
                                        </div>
                                    </div>

                                    <div class="col col-4">
                                        <input class="btn btn-light px-5" type="button" value="Buscar 503" id="buscar503">
                                    </div>
                                </div>
                            </form>
                        </nav>
                        <hr>
                        <h4>Results</h4>
                        <div class="row">
                            <div id="resultado503" class="body no-margin hide_scrollbar table-responsive" style="height: 500px; overflow-y: scroll;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center table-dark">
                                            <th></th>
                                            <th colspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th>Estatus</th>
                                            <th>Hora</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <% results1.forEach((resultado503)=> {  %>
                                            <tr>
                                                <td><%= resultado503.sip_hangup_cause %></td>
                                                <td><%= resultado503.HORA %></td>
                                                <td><%= resultado503.Registros %></td>
                                            </tr>
                                        <% })%>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

    </div>
    <!-- End container-fluid-->

</div>
<!--End content-wrapper-->

<?php
require_once  'views/parte_inferior.php';
?>