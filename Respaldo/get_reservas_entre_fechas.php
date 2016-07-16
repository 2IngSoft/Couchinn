<?php
require("establece_conexion.php");
establecer_conexion($conexion);
session_start();
$publicacion=$_SESSION["publicacion"];
$inicioAnio=$_POST["inicioAnio"];
$inicioMes=$_POST["inicioMes"];
$inicioDia=$_POST["inicioDia"];
$finAnio=$_POST["finAnio"];
$finMes=$_POST["finMes"];
$finDia=$_POST["finDia"];

$sql="SELECT EXTRACT(DAY FROM INICIO_RESERVA), EXTRACT(MONTH FROM INICIO_RESERVA), EXTRACT(YEAR FROM INICIO_RESERVA), EXTRACT(DAY FROM LIMITE_RESERVA), EXTRACT(MONTH FROM LIMITE_RESERVA), EXTRACT(YEAR FROM LIMITE_RESERVA)
      FROM solicitudes
      WHERE idPUBLICACIONES=$publicacion
        AND FECHA_ACEPTACION IS NOT NULL
        AND (($inicioAnio BETWEEN EXTRACT(YEAR FROM INICIO_RESERVA) AND EXTRACT(YEAR FROM LIMITE_RESERVA))
        OR ($finAnio BETWEEN EXTRACT(YEAR FROM INICIO_RESERVA) AND EXTRACT(YEAR FROM LIMITE_RESERVA)))";
/**LA CONSULTA TRAE SOLO LAS RESERVAS QUE PUEDAN AFECTAR AL CALENDARIO (OSEA, NI LAS QUE TERMINAROR O EMPIEZAN EN UN AÑO DISTINTO AL ACTUAL)**/
$resultado=mysqli_query($conexion,$sql);
$seguir = true;
while (($fila=mysqli_fetch_row($resultado)) && $seguir ) {
  if($fila[5]==$inicioAnio){    //si la reserva TERMINA en el MISMO AÑO
    if($fila[4]==$inicioMes){     //si la reserva TERMINA en el MISMO AÑO y en el MISMO MES
      if($fila[3]>$inicioDia){     //si la reserva TERMINA en el MISMO AÑO y en el MISMO MES y unos DIAS DESPUES QUE el INICIO
        /**FALTA CONSIDERAR ALGUNOS CASOS... tecnicamente**/
        if($fila[0]<$finDia){   //sirve SOLO PARA EL MISMO MES
          $seguir=false;
        }
        //echo $fila[0]."/".$fila[1]."/".$fila[2]."---".$fila[3]."/".$fila[4]."/".$fila[5];
      }
    } else {
      if($fila[4]>$inicioMes){     //si la reserva TERMINA en el MISMO AÑO y MESES DESPUES QUE el INICIO
        if($fila[1]<$finMes){
          $seguir=false;
        } else {
          if($fila[1]==$finMes){
            if($fila[0]<$finDia){
              $seguir=false;
            }
          }
        }
      }
    }
  } else {
    if($fila[5]>$inicioAnio){     //si la reserva TERMINA AÑOS DESPUES (si termina años antes, no lo trae la consulta)
      if($fila[2]<$finAnio){    //si la reserva TERMINA AÑOS DESPUES y EMPIEZA AÑOS ANTES
        $seguir=false;
      } else {
        if($fila[2]==$finAnio){
          if($fila[1]<$finMes){
            $seguir=false;
          } else {
            if($fila[1]==$finMes){
              if($fila[0]<$finDia){
                $seguir=false;
              }
            }
          }
        }
      }
    }
  }
}
if($seguir==false){
  echo "false";
} else {
  echo "true";
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
