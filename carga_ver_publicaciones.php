<?php
  session_start();
  if(isset($_POST["operar"])){
    $publicaciones_activas=$_POST["operar"];
    unset($_POST["operar"]);
    require("establece_conexion.php");
    establecer_conexion($conexion);
    $usuario=$_SESSION["usuario"];
    $sql="SELECT idUSUARIOS FROM USUARIOS WHERE EMAIL='$usuario'";
    $resultado=mysqli_query($conexion,$sql);
    $fila=mysqli_fetch_row($resultado);
    $usuario = $fila[0];
    $sql="SELECT idPUBLICACIONES,TITULO FROM PUBLICACIONES WHERE idUSUARIOS='$usuario' AND ACTIVA='$publicaciones_activas'";
    $resultado=mysqli_query($conexion,$sql);
    if(mysqli_num_rows($resultado)>0){
      while($fila=mysqli_fetch_row($resultado)){
        //echo "<a href='detalle_publicacion.php'>";
        echo "<div id='",$fila[0],"' class='publicacion' onclick='cargar(this.id); var id = this.id;'>";
        echo "<div class='img_portada'>";
        echo "<img src='CouchInnLogo.png' height='50px' width='150px'/>";
        echo "</div>";
        echo "<div class='titulo'>";
        echo $fila[1];
        echo "</div>";
        echo "<div class='solicitudes'>";
        echo "<div  class='literal_solicitudes'>Solicitudes:</div>";
        echo "<div class='cant_solicitudes'>100</div>";
        echo "</div></div>";
        //echo "</a>";
        echo "<div class='contenedor_despublicar'>";
        if($publicaciones_activas==0){
          echo "<input type='button' id='",$fila[0],"' class='despublicar' value='Publicar' onclick='publicar(this.id)'>";
        } else {
          echo "<input type='button' id='",$fila[0],"' class='despublicar' value='Despublicar' onclick='despublicar(this.id)'>";
        }
        echo "</div>";
      }
    } else {
      echo "<div class='contenedor_cartel'>";
      echo "<span class='cartel_sin_publicaciones'>PARECE QUE NO TENÉS PUBLICACIONES...</span><br/>";
      echo "<span class='carita'>:/</span></div>";
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
  } else {
    header("location: index.php");
  }
?>
