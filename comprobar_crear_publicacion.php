<?php
session_start();

$titulo=$_POST["titulo"];
//$imagenes=$_FILES["imagenes"];
$ciudad=$_POST["ciudad"];
$hospedaje=$_POST["tipo_hospedaje"];
$capacidad=$_POST["capacidad"];
$descripcion=$_POST["descripcion"];

unset($_POST["titulo"]); unset($_POST["ciudad"]);
unset($_POST["tipo_hospedaje"]); unset($_POST["capacidad"]); unset($_POST["descripcion"]);

$email=$_SESSION["usuario"];

require("establece_conexion.php");
establecer_conexion($conexion);

$sql = "SELECT idUSUARIOS FROM `usuarios` WHERE `EMAIL`='$email'";
$resultado=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_row($resultado);
$idUSUARIO=$fila[0];

$sql="INSERT INTO `publicaciones`(`TITULO`, `CAPACIDAD`, `DESCRIPCION`, `idUSUARIOS`, `idCIUDADES`, `idTIPOS_DE_HOSPEDAJES`)
      VALUES ('$titulo','$capacidad','$descripcion','$fila[0]','$ciudad','$hospedaje')";
$resultado=mysqli_query($conexion,$sql);

$sql="SELECT idPUBLICACIONES FROM publicaciones WHERE FECHA_ALTA=(SELECT MAX(FECHA_ALTA) FROM PUBLICACIONES WHERE idUSUARIOS='$idUSUARIO')";
$resultado=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_row($resultado);

foreach ($_FILES["imagenes"]["tmp_name"] as $key => $value) {
  $target_dir = "imagenes_usuarios/";

  $rest=substr($_FILES["imagenes"]["tmp_name"][$key], -4);

  $nombreReal=explode($rest,basename($_FILES["imagenes"]["tmp_name"][$key]));
  $nombreReal = $nombreReal[0];

  $nuevo_nombre=$nombreReal . "_" . basename($_FILES["imagenes"]["name"][$key]);

  $_FILES["imagenes"]["name"][$key] = $nuevo_nombre;

  $target_file = $target_dir . $nuevo_nombre;

  move_uploaded_file($_FILES["imagenes"]["tmp_name"][$key], $target_file);
  $sql="INSERT INTO `imagenes`(`IMAGEN`, `idPUBLICACIONES`) VALUES ('$target_file','$fila[0]')";
  $resultado=mysqli_query($conexion,$sql);
}

header("location: ver_publicaciones.php");

?>
