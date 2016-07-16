<?php
  $tipoNuevo=$_GET["tipoNuevo"];
  $tipoNuevo=strtolower($tipoNuevo);
  $link=mysqli_connect('localhost','root') or die('No se pudo seleccionar la base de datos');
  mysqli_select_db($link,'couchinn');
  if(!empty($tipoNuevo)){
    $sql="SELECT * FROM tipos_de_hospedajes";
    $consulta=mysqli_query($link,$sql);
    $Encontrado=false;
    while(!$Encontrado && $fila=mysqli_fetch_row($consulta)){
      if(strtolower($fila[1])==$tipoNuevo)
          $Encontrado=true;
    }
      if(!$Encontrado){
          $insertar="INSERT INTO `tipos_de_hospedajes`(`Nombre`) VALUES ('$tipoNuevo')";
          $aux=mysqli_query($link,$insertar);
          if($aux==false){
            echo "ERROR EN LA CONSULTA";
          }else {
            echo '<script type="text/javascript">
                              alert("Agregado correctamente");
                               window.location="http://localhost/agregarTipoDeHospedaje.php"
                                </script>"';
                              }
      }else {
        echo '<script type="text/javascript">
                          alert("El tipo ya se encuentra en la tabla");
                           window.location="http://localhost/agregarTipoDeHospedaje.php"
                            </script>"';
      }
} else {
  echo'<script type="text/javascript">
                        alert("Se ingreso un campo vacio");
                         window.location="http://localhost/agregarTipoDeHospedaje.php"
                          </script>"';

}
  mysqli_close($link);

?>
