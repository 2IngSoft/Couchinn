<?php
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $id=$_POST["publicacion"];
  $sql="UPDATE `publicaciones` SET `ACTIVA`='0' WHERE idPUBLICACIONES='$id'";
  $resultado=mysqli_query($conexion,$sql);
  mysqli_close($conexion);
?>
