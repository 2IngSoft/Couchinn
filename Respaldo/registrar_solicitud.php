<?php
  require("establece_conexion.php");
  establecer_conexion($conexion);
  session_start();
  $inicio=$_POST["inicio"];
  $fin=$_POST["fin"];
  $comentario=$_POST["comentario"];
  //$usuario=$_POST["usuario"];
  //$id=$_POST["publicacion"];
  $email=$_SESSION["usuario"];
  $sqlUsuario="SELECT idUSUARIOS FROM USUARIOS WHERE EMAIL='$email'";
  $resultadoUsuario=mysqli_query($conexion,$sqlUsuario);
  $filaUsuario=mysqli_fetch_row($resultadoUsuario);
  $usuario=$filaUsuario[0];
  $id=$_SESSION["publicacion"];
  $sql="INSERT INTO `solicitudes`(`INICIO_RESERVA`, `LIMITE_RESERVA`, `COMENTARIO`, `idUSUARIOS`, `idPUBLICACIONES`) VALUES ('$inicio', '$fin','$comentario','$usuario',$id)";
  $resultado=mysqli_query($conexion,$sql) or die("SDÑKFLAJÑDSAKFÑSADJFÑAKSJFDÑAKJ");
  mysqli_close($conexion);
?>
