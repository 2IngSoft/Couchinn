<?php
  /***EN SOLICITUDES.ACEPTADO, NULL=NO CONFIRMADO, 0=RECHAZADO, 1=ACEPTADO***/
  session_start();
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $email=$_SESSION["usuario"];
  $sql="SELECT idUSUARIOS FROM USUARIOS WHERE EMAIL='$email'";
  $resultado=mysqli_query($conexion,$sql);
  $fila=mysqli_fetch_row($resultado);
  $usuario=$fila[0];
  //$accion=0;
  $accion="";
  if($_POST["accion"]==1){    //ACCION en 1 implica las solicitudes recibidas CONFIRMADAS
    //$accion=1;
    $accion=" NOT";
  }
  $sql="SELECT PUBLICACIONES.TITULO, SOLICITUDES.idUSUARIOS, SOLICITUDES.INICIO_RESERVA, SOLICITUDES.LIMITE_RESERVA, SOLICITUDES.COMENTARIO, SOLICITUDES.idSOLICITUDES, SOLICITUDES.ACEPTADA
        FROM PUBLICACIONES INNER JOIN USUARIOS ON PUBLICACIONES.idUSUARIOS=USUARIOS.idUSUARIOS
                           INNER JOIN SOLICITUDES ON SOLICITUDES.idPUBLICACIONES=PUBLICACIONES.idPUBLICACIONES
        WHERE PUBLICACIONES.idUSUARIOS=$usuario AND SOLICITUDES.FECHA_ACEPTACION IS".$accion." NULL";
  /*$sql="SELECT PUBLICACIONES.TITULO, SOLICITUDES.idUSUARIOS, SOLICITUDES.INICIO_RESERVA, SOLICITUDES.LIMITE_RESERVA, SOLICITUDES.COMENTARIO, SOLICITUDES.idSOLICITUDES
        FROM PUBLICACIONES INNER JOIN USUARIOS ON PUBLICACIONES.idUSUARIOS=USUARIOS.idUSUARIOS
                           INNER JOIN SOLICITUDES ON SOLICITUDES.idPUBLICACIONES=PUBLICACIONES.idPUBLICACIONES
        WHERE PUBLICACIONES.idUSUARIOS=$usuario AND SOLICITUDES.ACEPTADA=$accion";*/
  $resultado=mysqli_query($conexion,$sql);
  if(mysqli_num_rows($resultado)>0){
    $cant=0;
    echo "<div class='contendor_general'>";
    while ($fila=mysqli_fetch_row($resultado)) {
      $hacer=true;
      if($fila[6]!=null){
        if($fila[6]==0){
          $hacer=false;
        }
      }
      if($hacer==true){
        $cant=$cant+1;
      //if($fila[6]!=0){
        echo "<div class='solicitud'>
              <div class='contenedor_cuerpo_y_titulo'>
              <div class='contenedor_titulo'>
              <div class='titulo'>";
        echo $fila[0];
        echo '</div>
              </div>
              <div class="contenedor_cuerpo">
              <div class="cuerpo">
              <div class="email">';
        $sql2="SELECT USUARIOS.EMAIL FROM USUARIOS INNER JOIN SOLICITUDES ON USUARIOS.idUSUARIOS=SOLICITUDES.idUSUARIOS WHERE SOLICITUDES.idUSUARIOS=$fila[1]";
        $resultado2=mysqli_query($conexion,$sql2);
        $fila2=mysqli_fetch_row($resultado2);
        echo $fila2[0];
        echo '</div>
              <div class="fechas_desde_hasta">
              <div class="desde">';
        echo "Desde ";
        $fecha=date_create($fila[2]);
        echo date_format($fecha,"d/m/Y");
        echo '</div>
              <div class="hasta">';
        echo "Hasta: ";
        $fecha=date_create($fila[3]);
        echo date_format($fecha,"d/m/Y");
        echo '</div>
            </div>
            <div class="contenedor_comentario">
            <div class="comentario"><p>';
        echo $fila[4]."";
        echo '</p></div>
              </div>
              </div>
              </div>
              </div>';
        if($fila[6]==null){
          echo '<div class="contenedor_aceptar_rechazar">
                <div class="envuelve_aceptar_rechazar">
                <div id="'.$fila[5].'" class="aceptar" onclick="aceptar_solicitud(this.id)">
                Aceptar
                </div>
                <div class="rechazar" id="-'.$fila[5].'"onclick="rechazar_solicitud(this.id)">
                Rechazar
                </div>
                </div>
                </div>';
        }
        echo '</div>';
      }
    }
    if($cant==0){
      echo "<div id=cartel_sin_publicaciones class='cartel_sin_publicaciones'>";
      echo "PARECE QUE NO TENES SOLICITUDES PENDIENTES";
      echo "</div>";
    }
  } else {
    echo "<div id=cartel_sin_publicaciones class='cartel_sin_publicaciones'>";
    echo "PARECE QUE NO TENES SOLICITUDES PENDIENTES";
    echo "</div>";
  }
echo "</div>";
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
