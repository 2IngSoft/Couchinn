<?php
  require("establece_conexion.php");
  establecer_conexion($conexion);
  session_start();
  $publicacion=$_SESSION["publicacion"];
  $mes=$_POST["mes"];   //sumar 1 a los meses enviados por JAVASCRIPT
  $anio=$_POST["anio"];
  /*$sql="SELECT EXTRACT(DAY FROM INICIO_RESERVA), EXTRACT(MONTH FROM INICIO_RESERVA), EXTRACT(YEAR FROM INICIO_RESERVA), EXTRACT(DAY FROM LIMITE_RESERVA), EXTRACT(MONTH FROM LIMITE_RESERVA), EXTRACT(YEAR FROM LIMITE_RESERVA)
  FROM solicitudes
  WHERE FECHA_ACEPTACION IS NOT NULL
  AND idPUBLICACIONES=$publicacion
  AND (EXTRACT(MONTH FROM INICIO_RESERVA) BETWEEN ".$mes-1." AND ".$mes.")
  AND (EXTRACT(MONTH FROM LIMITE_RESERVA) BETWEEN ".$mes." AND ".$mes+1.")";*/
  $sql="SELECT EXTRACT(DAY FROM INICIO_RESERVA), EXTRACT(MONTH FROM INICIO_RESERVA), EXTRACT(YEAR FROM INICIO_RESERVA), EXTRACT(DAY FROM LIMITE_RESERVA), EXTRACT(MONTH FROM LIMITE_RESERVA), EXTRACT(YEAR FROM LIMITE_RESERVA)
        FROM solicitudes
        WHERE idPUBLICACIONES=$publicacion
          AND FECHA_ACEPTACION IS NOT NULL
          AND ($anio BETWEEN EXTRACT(YEAR FROM INICIO_RESERVA) AND EXTRACT(YEAR FROM LIMITE_RESERVA))";
  /**LA CONSULTA TRAE SOLO LAS RESERVAS QUE PUEDAN AFECTAR AL CALENDARIO (OSEA, NI LAS QUE TERMINAROR O EMPIEZAN EN UN AÑO DISTINTO AL ACTUAL)**/
  $resultado=mysqli_query($conexion,$sql);
  while ($fila=mysqli_fetch_row($resultado)) {
    $hacer=false;
    $inicio=0;
    $fin=0;
    if($fila[2]==$anio){    //si la reserva empieza este año
      if($fila[1]==$mes){     //si la reserva empieza este mes
        $inicio=$fila[0];   //marcar desde el dia indicado
        /**HASTA ACA, LA RESERVA EMPIEZA ESTE AÑO Y ESTE MES**/
        if($fila[5]==$anio){    //si la reserva termina este año
          if($fila[4]==$mes){   //si la reserva termina este año y mes
            $fin=$fila[3];    //marcar hasta el dia indicado
            $hacer=true;
          } else {
            if($fila[4]>$mes){   //si la reserva termina este año pero en un mes proximo
              $fin=31;      //marca 31 simbolizando todo lo que queda del mes. Si el mes tiene menos dias, se debe encargar JS
              $hacer=true;
            }
          }
        } else {    //sino, SI O SI la reserva termina en un año proximo
          $fin=31;
          $hacer=true;
        }
      } else {
        if($fila[1]<$mes){    //si la reserva empezo en un mes anterior (SE DESCARTAN MESES POSTERIORES PORQUE SON RESERVAS QUE NO INFLUYEN EN EL MES ACTUAL)
          $inicio=1;    //marcar desde el 1ro
          if($fila[5]==$anio){    //si la reserva termina este año
            if($fila[4]==$mes){     //si la reserva termina este mes
              $fin=$fila[3];    //marcar hasta el dia indicado
              $hacer=true;
            } else {
              if($fila[4]>$mes){  //si termina en un mes posterior (SE DESCARTAN LOS MESES ANTERIORES PORQUE SON RESERVAS YA FINALIZADAS)
                $fin=31;
                $hacer=true;
              }
            }
          } else {    //si termina en un año posterior
            $fin=31;
            $hacer=true;
          }
        }
      }
    } else {    //si la reserva empiezo en un año anterior (SE DESCARTAN AÑOS POSTERIORES porque la consulta descarta inicios en años posteriores)
      $inicio=1;
      if($fila[5]==$anio){
        if($fila[4]==$mes){     //
          $fin=$fila[4];    //marcar hasta lo indicado
          $hacer=true;
        } else {
          if($fila[4]>$mes){
            $fin=31;    //marcar todo
            $hacer=true;
          }
        }
      } else {
        if($fila[5]>$anio){     //la reserva termina en un año posterior
          $fin=31;
          $hacer=true;
        }
      }
    }
    for ($inicio; $inicio<=$fin ; $inicio++) {
      echo "<input type='hidden' class='dataFechas' value='".$inicio."'>";
    }
  }
  //mysqli_free_result($resultado);
  mysqli_close($conexion);
?>
