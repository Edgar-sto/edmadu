
<!-- MARCATEL -->
<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <!-- <div class="card-body text-center"> -->
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Marcatel</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $consumo_marcatel = new ConsumoPorCarrier($conexion, $date, $date, prefijos_marcatel);
            $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
    <!-- </div> -->
</div>