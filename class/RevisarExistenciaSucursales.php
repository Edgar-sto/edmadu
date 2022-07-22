<?php
  class RevisarExistenciaSucursales {
  
  public function __construct($conexion,$d_start,$d_end) {
    $this->conexion  =  $conexion;
    $this->date_start=  $d_start;
    $this->date_end  =  $d_end;
  }

  public function revisarSucursales () {
    //$array_sucursales = array();
    $query = "SELECT DISTINCT reporte,campania,grupo FROM reporte_telefonia
      WHERE fecha_inicio>='{$this->date_start} 00:00:00' and fecha_termino<='{$this->date_end} 23:59:59'
      AND grupo != 'N/A'";
    $answer = $this->conexion->query($query);
    while ($row = $answer->fetch_object()) {
    ?>
      <tr>
        <td><?php echo $row->reporte; ?></td>
        <td><?php echo $row->campania; ?></td>
        <td><?php echo $row->grupo; ?></td>
        <td>
          <?php
            $query_obt_sucursal="SELECT sucursal,campania FROM sucu_campa_grup
              WHERE nombre_grupo='{$row->grupo}' GROUP BY sucursal,campania;";
            $resul_query =$this->conexion->query($query_obt_sucursal);

            while ($row_sucursal=$resul_query->fetch_object()) {
              echo $row_sucursal->sucursal." ".$row_sucursal->campania;
            }
          ?>
        </td>
      </tr>
    <?php
      //array_push($array_sucursales,$row->reporte,$row->campania,$row->grupo);
     // var_dump($array_sucursales);
    }
    //return $array_sucursales;
  }

}//Llave de cierre de clase
?>
