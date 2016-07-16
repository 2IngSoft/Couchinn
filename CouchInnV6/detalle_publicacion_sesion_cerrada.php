<?php
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $publicacion=$_POST["publicacion"];
  $sql="SELECT p.TITULO, prov.NOMBRE, c.NOMBRE, h.NOMBRE, p.CAPACIDAD, p.DESCRIPCION, p.FECHA_ALTA FROM publicaciones p INNER JOIN ciudades c ON(p.idCIUDADES = c.idCIUDADES) INNER JOIN provincias prov ON (prov.idPROVINCIAS = c.idPROVINCIAS) INNER JOIN tipos_de_hospedajes h ON (p.idTIPOS_DE_HOSPEDAJES = h.idTIPOSDEHOSPEDAJES) WHERE idPUBLICACIONES=$publicacion";
  $resultado=mysqli_query($conexion,$sql);
  $fila=mysqli_fetch_row($resultado);
  $sql2 = "SELECT IMAGEN FROM IMAGENES WHERE idPUBLICACIONES='$publicacion'";
  $resultado2=mysqli_query($conexion,$sql2);
  echo "<div id='contenedor_detalle' class='contenedor_detalle'>";
  echo "<div class='titulo_detalle'>" . $fila[0] . "</div>
  <div class='galeria'>
    <div class='seleccion'>";
  $imagenes = mysqli_fetch_row($resultado2);
  echo "<img src='" . $imagenes[0] ."' height='250px' width='450px'/></div>";
  echo "<div class='otras'>";
  while($imagenes = mysqli_fetch_row($resultado2)){
    echo "<img src='" . $imagenes[0] ."' height='100px' width='100px'/>";
  }
  echo "</div></div>";
  echo "<div>" .
    $fila[1] . ", " . $fila[2] . "</div><div>" .
    $fila[3] . ", para " . $fila[4] . " personas.
  </div><div class='descripcion_detalle'>".$fila[5].
  "</div><div>Publicado el dia:".$fila[6]."</div></div>";
?>
