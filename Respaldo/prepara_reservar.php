<?php
  session_start();
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $_SESSION["publicacion"]=$_POST["id"];
  $email=$_SESSION["usuario"];
  $publicacion=$_POST["id"];
  //PARA TRAER AL USUARIO DUEÑO DE LA PUBLICACION
  $sql="SELECT p.idPUBLICACIONES FROM usuarios u NATURAL JOIN publicaciones p WHERE p.idPUBLICACIONES=$publicacion AND u.EMAIL='$email'";
  $resultado=mysqli_query($conexion,$sql);
  mysqli_close($conexion);
  if(mysqli_num_rows($resultado)!=0){
    echo "Si";
  } else {
    echo "No";
  }
?>
