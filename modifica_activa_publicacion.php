<?php
  session_start();
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $id=$_POST["publicacion"];
  $accion=$_POST["accion"];
  $sql="UPDATE `publicaciones` SET `ACTIVA`=$accion WHERE idPUBLICACIONES='$id'";
  mysqli_query($conexion,$sql);
  mysqli_close($conexion);
?>
