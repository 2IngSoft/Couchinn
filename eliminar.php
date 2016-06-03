<?php
 $tipoAEliminar=$_GET["tipoaEliminar"];
 $tipoAEliminar=strtolower($tipoAEliminar);
 $link=mysqli_connect('localhost','root') or die('No se pudo seleccionar la base de datos');
 mysqli_select_db($link,'couchinn');
if($tipoAEliminar==false){
  echo '<script type="text/javascript">
                    alert("El campo del tipo a eliminar esta vacio");
                     window.location="http://localhost/agregarTipoDeHospedaje.php"
                      </script>"';
} else {
  $sql="DELETE FROM `tipos_de_hospedajes` WHERE `tipos_de_hospedajes`.`Nombre` = '$tipoAEliminar'";
  mysqli_query($link,$sql) or die ('<script type="text/javascript">
                    alert("No se puede eliminar eldato ya que hay tablas que poseen esedato");
                     window.location="http://localhost/agregarTipoDeHospedaje.php"
                      </script>"');
  echo '<script type="text/javascript">
                    alert("Eliminacion exitosa");
                     window.location="http://localhost/agregarTipoDeHospedaje.php"
                      </script>"';
}?>
