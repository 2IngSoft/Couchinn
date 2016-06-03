<?php
session_start();
$_SESSION["error"]="EL Email ingresado ya esta registrado";

$nombre = $_POST["nombre_usuario"];
$apellido = $_POST["apellido_usuario"];
$nac = $_POST["fecha_nac"];
$email = $_POST["email_usuario"];
$tel = $_POST["telefono"];
$contra = $_POST["contraseña_usuario"];
$confirmacion = $_POST["confirma_contraseña"];
$pregunta = $_POST["pregunta_de_seguridad"];
$res = $_POST["respuesta_de_seguridad"];

if(isset($_POST[$nombre])){
  $_SESSION["nombre"]="$nombre";
}
if(isset($_POST[$apellido])){
  $_SESSION["apellido"]="$apellido";
}
if(isset($_POST[$nac])){
  $_SESSION["nac"]="$nac";
}
if(isset($_POST[$email])){
  $_SESSION["email"]="$email";
}
if(isset($_POST[$tel])){
  $_SESSION["tel"]="$tel";
}
if(isset($_POST[$tel])){
  $_SESSION["tel"]="$tel";
}

if($contra==$confirmacion){

  require("establece_conexion.php");
  establecer_conexion($conexion);

  if(mysqli_connect_errno()){
    echo "Fallo al conectar con la BBDD";
    exit();
  } else {

    mysqli_set_charset($conexion,"utf8");
    $sql="SELECT * FROM USUARIOS WHERE EMAIL='$email'";
    $resultado=mysqli_query($conexion,$sql);
    $fila=mysqli_fetch_array($conexion,MYSQLI_ASSOC);
    $cantColumnas=mysqli_num_rows($resultado);
    if($cantColumnas!=0){
      header("location: couchinnRegistrarse.php");
    } else {

      $sql="SELECT idPREGUNTASDESEGURIDAD FROM PREGUNTASDESEGURIDAD WHERE TEXTO='$pregunta'";
      $resultado=mysqli_query($conexion,$sql);
      $fila=mysqli_fetch_row($resultado);
      echo $fila[0] . "<br>";
      $pregunta=$fila[0];
      $sql="INSERT INTO `usuarios`(`NOMBRE`, `APELLIDO`, `FECHANAC`, `EMAIL`, `TELEFONO`, `CONTRASEÑA`, `RESPUESTASEG`, `idPREGUNTASDESEGURIDAD`)
            VALUES ('$nombre','$apellido','$nac','$email','$tel','$contra','$res','$pregunta')";
      $resultado=mysqli_query($conexion,$sql);
      if($resultado==false){
        echo "ERROR EN LA CONSULTA";
      } else {
        //session_start();
        $_SESSION["usuario"]=$_POST["email_usuario"];
        $_SESSION["nombre"]=$nombre;
        $_SESSION["apellido"]=$apellido;
        header("location:couchInnIndexSesionIniciada.php");
      }
    }
  }
  mysqli_close($conexion);
} else {
  $_SESSION["error"]="La contrasenia y la confirmacion no coinciden";
  header("location: couchinnRegistrarse.php");
}
?>
