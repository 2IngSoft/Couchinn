<?php
session_start();
$usuario=$_SESSION["idUSUARIOS"];
$fecha_i=$_GET["fecha_inicio"];
$fecha_f=$_GET["fecha_final"];
$cap=$_GET["capacidad"];
$desc=$_GET["descripcion"];
$idHospedaje=$_GET["idp"];
$conexion = mysqli_connect('localhost','root')
    or die('No se pudo conectar: ' . mysql_error());
mysqli_select_db($conexion,'couchinn') or die('No se pudo seleccionar la base de datos');
$consulI="SELECT idUSUARIOS FROM `reservas` WHERE '$fecha_i' BETWEEN fecha_inicio AND fecha_final AND idPUBLICACIONES=$idHospedaje";
$reservasI=mysqli_query($conexion,$consulI);
$cantI=mysqli_num_rows($reservasI);
$consulF="SELECT idUSUARIOS FROM `reservas` WHERE '$fecha_f' BETWEEN fecha_inicio AND fecha_final AND idPUBLICACIONES=$idHospedaje ";
$reservasF=mysqli_query($conexion,$consulF);
$cantF=mysqli_num_rows($reservasF);
if($cantI!=0 && $cantF!=0){
  echo '<script type="text/javascript">
                    alert("El dia del inicio y el dia del fin de la estadia se superpone con una reserva.");
                     window.location="http://localhost/realizarReserva.php"
                      </script>';
}else{
  if($cantI!=0){
    echo '<script type="text/javascript">
                      alert("El dia del inicio de la estadia se superpone con una reserva.");
                       window.location="http://localhost/realizarReserva.php"
                        </script>';
  }else{
    if($cantF!=0){
      echo '<script type="text/javascript">
                        alert("El dia del fin de la estadia se superpone con una reserva.");
                         window.location="http://localhost/realizarReserva.php"
                          </script>';
    }else{

$consul="INSERT INTO `reservas`(`idUSUARIOS`, `fecha_inicio`, `fecha_final`, `descripcion`,`idPUBLICACIONES`)
      VALUES ('$usuario','$fecha_i','$fecha_f','$desc','$idHospedaje')";
$datos=mysqli_query($conexion,$consul);
if($datos==false){
   echo "ERROR EN AGREGAR RESERVA";}
   else{
     echo "CONSULTA EXITOSA";
   }
 }
 }
 }
   mysqli_close($conexion);
 ?>
