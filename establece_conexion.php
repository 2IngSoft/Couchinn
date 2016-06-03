<?php
function establecer_conexion(&$conexion){
  $db_host="localhost";   //<- direccion de la base de datos
  $db_nombre="couchinn";   //<- nombre de la base de datos
  $db_usuario="root";     //<- nombre del usuario
  $db_contra="";          //<- contraseña de la base datos. Por defecto esta vacia
  $conexion=mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);
  mysqli_set_charset($conexion,"utf8");
}
?>
