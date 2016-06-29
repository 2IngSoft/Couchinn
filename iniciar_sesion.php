<?php
session_start();
try {
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $email=addslashes($_POST["email"]);
  $contraseña=addslashes($_POST["contraseña"]);
  //$consulta="SELECT EMAIL,CONTRASEÑA,NOMBRE,APELLIDO FROM USUARIOS WHERE EMAIL='$email' AND CONTRASEÑA='$contraseña'";
  $consulta="SELECT EMAIL,CONTRASEÑA,NOMBRE,APELLIDO,Premium FROM USUARIOS WHERE EMAIL='$email'";
  $resultado=mysqli_query($conexion,$consulta);
  $num_filas=mysqli_num_rows($resultado);
  if($num_filas!=0){
    //session_start();
    $fila=mysqli_fetch_row($resultado);
    if($fila[1]==$contraseña){
      $_SESSION["usuario"]=$_POST["email"];
      $_SESSION["nombre"]=$fila[2];
      $_SESSION["apellido"]=$fila[3];
      $_SESSION["premium"]=$fila[4];
      if($_POST["email"]!="angelica.portacelutti@gmail.com"){
        header("location: couchInnIndexSesionIniciada.php");
      
      } else {
        header("location: indexAdmin.php");
      }
    } else { $_SESSION['error']="La contraseña ingresada es incorrecta";
             header("location: $_SESSION[llamada]");}
  } else { $_SESSION['error']="El email ingresado no esta registrado";
           header("location: $_SESSION[llamada]");}
} catch (Exception $e) {
  die("Error: " . $e->getMessage());
}
?>
