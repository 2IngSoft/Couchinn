<?php
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $solicitud=$_POST["solicitud"];
  $sql="UPDATE `solicitudes` SET `ACEPTADA`=1 WHERE idSOLICITUDES=$solicitud";
  mysqli_query($conexion,$sql);
  mysqli_close($conexion);
?>
