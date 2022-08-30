 <?php
    include_once '../../class/SemaforoScript.php';
    include_once '../../class/conexion.php';

    $date_start = $_POST['fecha_inicio'];
    $date_end   = $_POST['fecha_termino'];
    $conexion = conexion_local('telefonia', '10.9.2.147');

    if ($date_start != $date_end) {
        ?>
        <label for="">Semaforo</label>
        <div class="row">
            <div class="col-lg-4">Principal</div>
            <div class="col-lg-4">Eventos</div>
            <div class="col-lg-4">Segundos</div>
        </div>
        <div class="row">
         <?php
            $semaforo = new SemaforoScript($conexion, $date_start, $date_start);
            $semaforo->semaforo();
            foreach ($semaforo->semaforo() as $fechas) {
                if ($fechas = $date_start) {
                    $fondo = "bg-success";
                } else {
                    $fondo = "bg-danger";
                }
            ?>
            <div class="col-lg-4 <?php echo $fondo ?>">
                <?php echo $fechas ?>
            </div>
         <?php
            }
            ?>
        </div>
        <?php
    } else {
    ?>
     <label for="">Semaforo</label>
     <div class="row">
         <div class="col-lg-4">Principal</div>
         <div class="col-lg-4">Eventos</div>
         <div class="col-lg-4">Segundos</div>
     </div>
     <div class="row">
         <?php
            $semaforo = new SemaforoScript($conexion, $date_start, $date_end);
            $semaforo->semaforo();
            foreach ($semaforo->semaforo() as $fechas) {
                if ($fechas = $date_start) {
                    $fondo = "bg-success";
                } else {
                    $fondo = "bg-danger";
                }
            ?>
             <div class="col-lg-4 <?php echo $fondo ?>">
                 <?php echo $fechas ?>
             </div>
         <?php
            }
            ?>
     </div>
 <?php
    }
