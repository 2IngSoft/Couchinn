<?php
session_start();
//HospedajeV2
$conn = mysqli_connect("localhost","root","","couchinn");
if (isset($_SESSION['usuario'])) {
  $email=$_SESSION['usuario'];
} else {
  $email='Anonimo';
}
$idHospedaje=$_POST["idHospedaje"];
$pregunta=$_POST["pregunta"];
$sql="INSERT INTO `comentarios`(`Nombre`, `Comentario`, `idHospedaje`) VALUES ('$email','$pregunta','$idHospedaje')";
$resultado=mysqli_query($conn,$sql);
mysqli_close($conn);
?>
