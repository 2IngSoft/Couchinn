<?php
$numTarjeta=$_POST["numTarjeta"];
$contra=$_POST["contraseña"];

$link = mysqli_connect('localhost','root')
      or die('No se pudo conectar: ' . mysql_error());
  mysqli_select_db($link,'couchinn') or die('No se pudo seleccionar la base de datos');
 session_start();
 $EMAIL=$_SESSION["usuario"];
 $consul="SELECT idUSUARIOS FROM usuarios WHERE EMAIL='$EMAIL'";
 $tabla=mysqli_query($link,$consul);
 $id=mysqli_fetch_row($tabla);
 $id1=$id[0];
 $fp = fopen("\Users\Ivana\Desktop\precio.txt", "r");
 if($fp==false){
   echo "error";
 }
 $MONTO=fgets($fp);
 $consul="INSERT INTO `pagos`(`Monto`,`idUSUARIO`) VALUES ('$MONTO','$id1')";
 $resultado=mysqli_query($link,$consul);
 if($resultado==false){
   echo "ERROR EN LA CONSULTA";
 } else{
   $consul="UPDATE usuarios SET Premium=1 WHERE EMAIL='$EMAIL'";
   $resultado=mysqli_query($link,$consul);
   if($resultado==true){
   echo '<script type="text/javascript">
                     alert("Operacion exitosa! Usted ya es un usuario Premiun.");
                      window.location="http://localhost/couchInnIndexSesionIniciada.php"
                       </script>';
   $_SESSION["premium"]=1;
 }else{
   echo "ERROR EN CONSULTA MODI";
 }
 }
mysqli_close($link);
 ?>
