<?php
  /*session_start();
  $email=$_SESSION["usuario"];*/
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $publicacion=$_POST["publicacion"];
  //PARA TRAER AL USUARIO DUEÑO DE LA PUBLICACION
  /*$sql="SELECT * FROM USUARIOS WHERE EMAIL='$email'";
  $resultado=mysqli_query($conexion,$sql);
  $fila=mysqli_fetch_row($resultado);
  $id=$fila[0];*/
  $sql="SELECT p.TITULO, prov.NOMBRE, c.NOMBRE, h.NOMBRE, p.CAPACIDAD, p.DESCRIPCION, p.FECHA_ALTA FROM publicaciones p INNER JOIN ciudades c ON(p.idCIUDADES = c.idCIUDADES) INNER JOIN provincias prov ON (prov.idPROVINCIAS = c.idPROVINCIAS) INNER JOIN tipos_de_hospedajes h ON (p.idTIPOS_DE_HOSPEDAJES = h.idTIPOSDEHOSPEDAJES) WHERE idPUBLICACIONES=$publicacion";
  $resultado=mysqli_query($conexion,$sql);
  $fila=mysqli_fetch_row($resultado);
  $sql2 = "SELECT IMAGEN FROM IMAGENES WHERE idPUBLICACIONES='$publicacion'";
  $resultado2=mysqli_query($conexion,$sql2);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Estilos_Detalle_Publicacion.css" media="screen" title="no title" charset="utf-8">
    <script src="jquery-3.0.0.min.js"></script>
  </head>
  <body>
    <div class="contenedor_publicacion_detalle">
      <div class="titulo_detalle">
        <?php echo $fila[0]; ?>
      </div>
      <div class="galeria">
        <div class="seleccion">
          <?php
            $imagenes = mysqli_fetch_row($resultado2);
            echo "<img src='" . $imagenes[0] ."' height='250px' width='450px'/>";
          ?>
        </div>
        <div class="otras">
          <?php
            while($imagenes = mysqli_fetch_row($resultado2)){
              echo "<img src='" . $imagenes[0] ."' height='100px' width='100px'/>";
            }
          ?>
        </div>
      </div>
      <div class="">
        <?php echo $fila[1] . ", " . $fila[2] . "."; ?>
      </div>
      <div class="">
        <?php echo $fila[3] . ", para " . $fila[4] . " personas." ?>
      </div>
      <div class="descripcion_detalle">
        <?php echo $fila[5]; ?>
      </div>
      <div class="">
        Publicado el dia:
        <?php echo $fila[6]; ?>
      </div>
    </div>
  </body>
</html>
